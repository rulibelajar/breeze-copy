<template>
    <div
        class="min-h-screen bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 p-6"
    >
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">
                    {{ world.name }}
                </h1>
                <p class="text-blue-200">Fantasy World Calendar</p>
            </div>

            <!-- Main Calendar Card -->
            <div
                class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/20"
            >
                <!-- Current Date Display -->
                <div class="text-center mb-8">
                    <div class="text-6xl font-bold text-white mb-2">
                        {{ currentDate.day }}
                    </div>
                    <div class="text-2xl text-blue-200 mb-1">
                        {{ currentDate.month }} {{ currentDate.year }}
                    </div>
                    <div class="text-xl text-blue-300">
                        {{ currentDate.day_name }}
                    </div>
                </div>

                <!-- Game Progress -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-white font-semibold"
                            >Game Progress</span
                        >
                        <span class="text-blue-200"
                            >Day {{ currentDate.day_game }} of 90</span
                        >
                    </div>
                    <div class="w-full bg-white/20 rounded-full h-4">
                        <div
                            class="bg-gradient-to-r from-blue-500 to-purple-500 h-4 rounded-full transition-all duration-1000"
                            :style="{ width: world.progress + '%' }"
                        ></div>
                    </div>
                    <div class="text-center text-blue-200 mt-2">
                        {{ world.progress.toFixed(1) }}% Complete
                    </div>
                </div>

                <!-- Countdown Timer -->
                <div class="text-center mb-8">
                    <div class="text-lg text-blue-200 mb-2">
                        Next Day Change In:
                    </div>
                    <div class="text-3xl font-bold text-white font-mono">
                        {{ formatTime(countdown) }}
                    </div>
                </div>

                <!-- Game Status -->
                <div class="text-center mb-6">
                    <div
                        v-if="world.is_completed"
                        class="text-green-400 text-xl font-bold"
                    >
                        🎉 Game Completed! 🎉
                    </div>
                    <div v-else class="text-blue-200">
                        {{ currentDate.remaining_days }} days remaining
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-center space-x-4">
                    <button
                        @click="refreshData"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors"
                    >
                        Refresh
                    </button>
                    <button
                        @click="resetWorld"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors"
                        :disabled="resetting"
                    >
                        {{ resetting ? "Resetting..." : "Reset World" }}
                    </button>
                </div>
            </div>

            <!-- Mini Calendar Preview -->
            <div
                class="mt-8 bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20"
            >
                <h3 class="text-xl font-bold text-white mb-4">
                    Calendar Preview
                </h3>
                <div class="grid grid-cols-7 gap-2 text-center">
                    <!-- Calendar header -->
                    <div
                        v-for="day in [
                            'Sun',
                            'Mon',
                            'Tue',
                            'Wed',
                            'Thu',
                            'Fri',
                            'Sat',
                        ]"
                        :key="day"
                        class="text-blue-200 font-semibold p-2"
                    >
                        {{ day }}
                    </div>

                    <!-- Calendar days (simplified) -->
                    <div
                        v-for="day in calendarDays"
                        :key="day.date"
                        class="p-2 text-white rounded-lg"
                        :class="{
                            'bg-blue-600': day.isToday,
                            'bg-white/10': !day.isToday,
                            'text-blue-200': day.isOtherMonth,
                        }"
                    >
                        {{ day.day }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from "vue";
import { router } from "@inertiajs/vue3";

export default {
    props: {
        world: Object,
    },

    setup(props) {
        const currentDate = ref(props.world.fantasy_date);
        const countdown = ref(props.world.fantasy_date.next_change_in_seconds);
        const resetting = ref(false);
        const calendarDays = ref([]);
        let countdownInterval = null;
        let refreshInterval = null;

        // Format waktu countdown
        const formatTime = (seconds) => {
            if (seconds <= 0) return "00:00";
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes.toString().padStart(2, "0")}:${remainingSeconds
                .toString()
                .padStart(2, "0")}`;
        };

        // Generate calendar days
        const generateCalendarDays = () => {
            const today = new Date();
            const year = today.getFullYear();
            const month = today.getMonth();
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);

            const days = [];

            // Add empty cells for days before first day of month
            for (let i = 0; i < firstDay.getDay(); i++) {
                const prevDate = new Date(
                    year,
                    month,
                    -firstDay.getDay() + i + 1
                );
                days.push({
                    date: prevDate.toISOString(),
                    day: prevDate.getDate(),
                    isToday: false,
                    isOtherMonth: true,
                });
            }

            // Add days of current month
            for (let day = 1; day <= lastDay.getDate(); day++) {
                const date = new Date(year, month, day);
                days.push({
                    date: date.toISOString(),
                    day: day,
                    isToday: day === parseInt(currentDate.value.day),
                    isOtherMonth: false,
                });
            }

            // Fill remaining cells
            const remainingCells = 42 - days.length;
            for (let day = 1; day <= remainingCells; day++) {
                const nextDate = new Date(year, month + 1, day);
                days.push({
                    date: nextDate.toISOString(),
                    day: day,
                    isToday: false,
                    isOtherMonth: true,
                });
            }

            calendarDays.value = days.slice(0, 42);
        };

        // Refresh data dari server
        const refreshData = async () => {
            try {
                const response = await fetch(
                    `/api/worlds/${props.world.id}/data`
                );
                const data = await response.json();

                currentDate.value = data.fantasy_date;
                countdown.value = data.fantasy_date.next_change_in_seconds;

                // Update reactive world data
                Object.assign(props.world, data);

                generateCalendarDays();
            } catch (error) {
                console.error("Error refreshing data:", error);
            }
        };

        // Reset world
        const resetWorld = () => {
            if (
                confirm("Are you sure you want to reset this world to day 1?")
            ) {
                resetting.value = true;
                router.post(
                    `/worlds/${props.world.id}/reset`,
                    {},
                    {
                        onSuccess: () => {
                            resetting.value = false;
                        },
                        onError: () => {
                            resetting.value = false;
                        },
                    }
                );
            }
        };

        // Start countdown timer
        const startCountdown = () => {
            countdownInterval = setInterval(() => {
                if (countdown.value > 0) {
                    countdown.value--;
                } else {
                    // Waktu habis, refresh data
                    refreshData();
                }
            }, 1000);
        };

        // Start auto refresh
        const startAutoRefresh = () => {
            refreshInterval = setInterval(() => {
                refreshData();
            }, 60000); // Refresh setiap 1 menit
        };

        onMounted(() => {
            generateCalendarDays();
            startCountdown();
            startAutoRefresh();
        });

        onUnmounted(() => {
            if (countdownInterval) clearInterval(countdownInterval);
            if (refreshInterval) clearInterval(refreshInterval);
        });

        return {
            currentDate,
            countdown,
            resetting,
            calendarDays,
            formatTime,
            refreshData,
            resetWorld,
        };
    },
};
</script>
