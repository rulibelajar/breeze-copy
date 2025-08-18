<template>
    <div class="countdown-timer">
        <!-- Basic Countdown Display -->
        <div
            class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-6 text-white shadow-lg"
        >
            <h3 class="text-lg font-semibold mb-4 text-center">
                Next Day Change In:
            </h3>

            <!-- Time Display -->
            <div class="flex justify-center items-center space-x-4">
                <!-- Hours -->
                <div class="text-center">
                    <div
                        class="bg-white bg-opacity-20 rounded-lg p-3 min-w-[60px]"
                    >
                        <div class="text-2xl font-bold">
                            {{ formatTime(timeLeft.hours) }}
                        </div>
                        <div
                            class="text-xs uppercase tracking-wider opacity-80"
                        >
                            Hours
                        </div>
                    </div>
                </div>

                <div class="text-2xl font-bold opacity-60">:</div>

                <!-- Minutes -->
                <div class="text-center">
                    <div
                        class="bg-white bg-opacity-20 rounded-lg p-3 min-w-[60px]"
                    >
                        <div class="text-2xl font-bold">
                            {{ formatTime(timeLeft.minutes) }}
                        </div>
                        <div
                            class="text-xs uppercase tracking-wider opacity-80"
                        >
                            Minutes
                        </div>
                    </div>
                </div>

                <div class="text-2xl font-bold opacity-60">:</div>

                <!-- Seconds -->
                <div class="text-center">
                    <div
                        class="bg-white bg-opacity-20 rounded-lg p-3 min-w-[60px]"
                    >
                        <div class="text-2xl font-bold">
                            {{ formatTime(timeLeft.seconds) }}
                        </div>
                        <div
                            class="text-xs uppercase tracking-wider opacity-80"
                        >
                            Seconds
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="mt-6">
                <div class="bg-white bg-opacity-20 rounded-full h-2">
                    <div
                        class="bg-white h-2 rounded-full transition-all duration-1000 ease-out"
                        :style="{ width: progressPercentage + '%' }"
                    ></div>
                </div>
                <div class="text-center mt-2 text-sm opacity-80">
                    {{ Math.round(progressPercentage) }}% completed
                </div>
            </div>

            <!-- Status -->
            <div class="text-center mt-4">
                <span
                    v-if="!isExpired"
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800"
                >
                    <svg
                        class="w-3 h-3 mr-1"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Active
                </span>
                <span
                    v-else
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800"
                >
                    <svg
                        class="w-3 h-3 mr-1"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Expired
                </span>
            </div>

            <!-- Expired Message -->
            <div
                v-if="isExpired"
                class="mt-4 p-3 bg-red-100 border border-red-200 rounded-lg"
            >
                <p class="text-red-800 text-sm text-center">
                    ⏰ Time's up! The next day change should have occurred.
                </p>
            </div>
        </div>

        <!-- Debug Info (Optional - remove in production) -->
        <div
            v-if="showDebug"
            class="mt-4 p-3 bg-gray-100 rounded-lg text-xs text-gray-600"
        >
            <div><strong>Target Time:</strong> {{ targetTime }}</div>
            <div><strong>Current Time:</strong> {{ currentTime }}</div>
            <div>
                <strong>Total Milliseconds Left:</strong>
                {{ totalMillisecondsLeft }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";

// Props
const props = defineProps({
    nextDayChange: {
        type: String,
        required: true,
        default: "2025-08-16 16:40:00",
    },
    showDebug: {
        type: Boolean,
        default: false,
    },
});

// Reactive data
const currentTime = ref(new Date());
const interval = ref(null);

// Computed properties
const targetTime = computed(() => {
    return new Date(props.nextDayChange);
});

const totalMillisecondsLeft = computed(() => {
    const diff = targetTime.value.getTime() - currentTime.value.getTime();
    return Math.max(0, diff);
});

const isExpired = computed(() => {
    return totalMillisecondsLeft.value <= 0;
});

const timeLeft = computed(() => {
    const totalSeconds = Math.floor(totalMillisecondsLeft.value / 1000);

    const hours = Math.floor(totalSeconds / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;

    return {
        hours: Math.max(0, hours),
        minutes: Math.max(0, minutes),
        seconds: Math.max(0, seconds),
    };
});

const progressPercentage = computed(() => {
    // Assuming the countdown started from 10 minutes (600,000 ms)
    const totalDuration = 10 * 60 * 1000; // 10 minutes in milliseconds
    const elapsed = totalDuration - totalMillisecondsLeft.value;
    const percentage = (elapsed / totalDuration) * 100;
    return Math.min(100, Math.max(0, percentage));
});

// Methods
const formatTime = (time) => {
    return time.toString().padStart(2, "0");
};

const startTimer = () => {
    interval.value = setInterval(() => {
        currentTime.value = new Date();
    }, 1000);
};

const stopTimer = () => {
    if (interval.value) {
        clearInterval(interval.value);
        interval.value = null;
    }
};

// Lifecycle hooks
onMounted(() => {
    startTimer();
});

onUnmounted(() => {
    stopTimer();
});

// Watch for when timer expires
const handleExpired = () => {
    if (isExpired.value) {
        console.log("Countdown expired! Next day change should occur now.");
        // Emit event or call callback if needed
        // emit('expired')
    }
};

// Check expiration every second
setInterval(handleExpired, 1000);
</script>

<style scoped>
.countdown-timer {
    max-width: 400px;
    margin: 0 auto;
}

/* Animation for when numbers change */
.countdown-timer .text-2xl {
    transition: all 0.3s ease;
}

/* Pulse animation for the last 10 seconds */
.countdown-timer.urgent .text-2xl {
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}
</style>
