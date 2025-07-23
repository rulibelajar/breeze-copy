<template>
    <div
        class="min-h-screen bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 p-6"
    >
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">
                        Game Worlds
                    </h1>

                    <h3 class="text-2xl font-bold text-white">
                        {{ formattedNow }}
                    </h3>
                    <p class="text-blue-200">Manage your fantasy worlds</p>
                </div>
                <button
                    @click="showCreateModal = true"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors flex items-center gap-2"
                >
                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        ></path>
                    </svg>
                    Create New World
                </button>
            </div>

            <!-- Worlds Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="world in worlds"
                    :key="world.id"
                    class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 shadow-2xl border border-white/20 hover:bg-white/15 transition-all duration-300"
                >
                    <!-- World Header -->
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-white">
                            {{ world.name }}
                        </h3>
                        <div class="flex items-center gap-2">
                            <span
                                class="px-2 py-1 text-xs rounded-full"
                                :class="
                                    world.is_completed
                                        ? 'bg-green-500 text-white'
                                        : 'bg-blue-500 text-white'
                                "
                            >
                                {{
                                    world.is_completed ? "Completed" : "Active"
                                }}
                            </span>
                        </div>
                    </div>

                    <!-- Current Date -->
                    <div class="mb-4">
                        <div class="text-center bg-white/10 rounded-lg p-4">
                            <div class="text-2xl font-bold text-white mb-1">
                                {{ world.fantasy_date.day }}
                            </div>
                            <div class="text-sm text-blue-200">
                                {{ world.fantasy_date.month }}
                                {{ world.fantasy_date.year }}
                            </div>
                            <div class="text-xs text-blue-300">
                                {{ world.fantasy_date.day_name }}
                            </div>
                        </div>
                    </div>

                    <!-- Game Progress -->
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-white">Progress</span>
                            <span class="text-sm text-blue-200"
                                >Day {{ world.day_game }}/90</span
                            >
                        </div>
                        <div class="w-full bg-white/20 rounded-full h-2">
                            <div
                                class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-300"
                                :style="{ width: world.progress + '%' }"
                            ></div>
                        </div>
                        <div class="text-xs text-blue-200 mt-1">
                            {{ world.progress.toFixed(1) }}% Complete
                        </div>
                    </div>

                    <!-- Next Change Timer -->
                    <div class="mb-4 text-center">
                        <div class="text-xs text-blue-200">Next change in:</div>
                        <div class="text-lg font-mono text-white">
                            {{
                                formatTime(
                                    world.fantasy_date.next_change_in_seconds
                                )
                            }}
                        </div>
                    </div>

                    <!-- Last Update -->
                    <div class="mb-4">
                        <div class="text-xs text-blue-300">
                            Last updated:
                            {{ formatDateTime(world.last_day_change) }}
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <button
                            @click="viewWorld(world.id)"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors"
                        >
                            View
                        </button>
                        <button
                            @click="resetWorld(world.id)"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors"
                            :disabled="resettingWorld === world.id"
                        >
                            {{
                                resettingWorld === world.id
                                    ? "Resetting..."
                                    : "Reset"
                            }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="worlds.length === 0" class="text-center py-12">
                <div class="text-6xl mb-4">🌍</div>
                <h3 class="text-2xl font-bold text-white mb-2">
                    No Worlds Yet
                </h3>
                <p class="text-blue-200 mb-6">
                    Create your first fantasy world to get started!
                </p>
                <button
                    @click="showCreateModal = true"
                    class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors"
                >
                    Create New World
                </button>
            </div>
        </div>

        <!-- Create World Modal -->
        <div
            v-if="showCreateModal"
            class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50"
        >
            <div class="bg-white rounded-2xl p-8 max-w-md w-full">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">
                    Create New World
                </h3>

                <form @submit.prevent="createWorld">
                    <div class="mb-6">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            World Name
                        </label>
                        <input
                            v-model="newWorldName"
                            type="text"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            placeholder="Enter world name..."
                            required
                        />
                    </div>

                    <div class="flex gap-4">
                        <button
                            type="button"
                            @click="showCreateModal = false"
                            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors"
                            :disabled="creating"
                        >
                            {{ creating ? "Creating..." : "Create World" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from "vue";
import { router } from "@inertiajs/vue3";

export default {
    props: {
        worlds: Array,
        now: String,
    },

    setup(props) {
        const showCreateModal = ref(false);
        const newWorldName = ref("");
        const creating = ref(false);
        const resettingWorld = ref(null);
        const worldsData = ref([...props.worlds]);

        // =========================
        // JAM SERVER DINAMIS
        // =========================
        const formattedNow = ref("");
        let serverDate = new Date(props.now);
        let nowInterval = null;

        const updateFormattedNow = () => {
            formattedNow.value = serverDate.toLocaleString("id-ID", {
                timeZone: "Asia/Jakarta",
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
            });
        };

        const tickServerTime = () => {
            serverDate.setSeconds(serverDate.getSeconds() + 1);
            updateFormattedNow();
        };

        // =========================
        // Refresh countdown worlds
        // =========================
        let refreshInterval = null;

        const formatTime = (seconds) => {
            if (seconds <= 0) return "00:00";
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes.toString().padStart(2, "0")}:${remainingSeconds
                .toString()
                .padStart(2, "0")}`;
        };

        const formatDateTime = (dateString) => {
            const date = new Date(dateString);
            return date.toLocaleString("id-ID", {
                timeZone: "Asia/Jakarta",
            });
        };

        const viewWorld = (id) => {
            router.get(`/admin/worlds/${id}`);
        };

        const createWorld = () => {
            if (!newWorldName.value.trim()) return;

            creating.value = true;

            router.post(
                "/admin/worlds",
                {
                    name: newWorldName.value.trim(),
                },
                {
                    onSuccess: () => {
                        creating.value = false;
                        showCreateModal.value = false;
                        newWorldName.value = "";
                    },
                    onError: () => {
                        creating.value = false;
                    },
                }
            );
        };

        const resetWorld = (id) => {
            if (!confirm("Reset this world to day 1?")) return;

            resettingWorld.value = id;

            router.post(
                `/worlds/${id}/reset`,
                {},
                {
                    onSuccess: () => {
                        resettingWorld.value = null;
                        router.reload({ only: ["worlds"] });
                    },
                    onError: () => {
                        resettingWorld.value = null;
                    },
                }
            );
        };

        const refreshWorldsData = () => {
            worldsData.value = worldsData.value.map((world) => ({
                ...world,
                fantasy_date: {
                    ...world.fantasy_date,
                    next_change_in_seconds: Math.max(
                        0,
                        world.fantasy_date.next_change_in_seconds - 1
                    ),
                },
            }));

            const needsRefresh = worldsData.value.some(
                (world) => world.fantasy_date.next_change_in_seconds <= 0
            );

            if (needsRefresh) {
                router.reload({ only: ["worlds"] });
            }
        };

        // =========================
        // Lifecycle
        // =========================
        onMounted(() => {
            updateFormattedNow();
            nowInterval = setInterval(tickServerTime, 1000);
            refreshInterval = setInterval(refreshWorldsData, 1000);
        });

        onUnmounted(() => {
            clearInterval(nowInterval);
            clearInterval(refreshInterval);
        });

        return {
            showCreateModal,
            newWorldName,
            creating,
            resettingWorld,
            worlds: worldsData,
            formattedNow,
            formatTime,
            formatDateTime,
            viewWorld,
            createWorld,
            resetWorld,
        };
    },
};
</script>
