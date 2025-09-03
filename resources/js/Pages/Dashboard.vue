<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import World from "@/Components/User/World.vue";

import { defineProps } from "vue";

const props = defineProps({
    user: Number,
    username: String,
    title: String,
    worlds: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">{{ title }}</h1>
            <p class="mb-6">User ID: {{ user }}</p>
            <p class="mb-6">Username: {{ username }}</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    v-for="world in worlds"
                    :key="world.id"
                    class="p-4 border rounded shadow"
                >
                    <h2 class="text-lg font-semibold mb-2">{{ world.name }}</h2>
                    <p>Game Day: {{ world.game_day }}</p>
                    <p>Game Date: {{ world.game_date }}</p>
                    <p v-if="world.airline_name">
                        Airline: {{ world.airline_name }}
                    </p>
                    <p v-else class="text-gray-500 italic">Belum ada airline</p>

                    <div class="mt-4">
                        <button
                            v-if="world.exists"
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
                        >
                            Enter World
                        </button>
                        <button
                            v-else
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                        >
                            Start New World
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
