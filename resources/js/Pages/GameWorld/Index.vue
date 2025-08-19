<script setup>
import CountdownTimer from "@/Components/CountdownTimer.vue";

defineProps({
    worlds: Array, // sesuai props dari controller
    title: String,
});
</script>

<template>
    <div>
        <h1 class="text-3xl font-bold mb-4">{{ title }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                v-for="world in worlds"
                :key="world.id"
                class="p-4 border rounded shadow"
            >
                <h2 class="font-semibold text-lg">{{ world.name }}</h2>
                <p>Name: {{ world.name }}</p>
                <p>Day Game: {{ world.game_day }}</p>
                <p>Day Date: {{ world.game_date }}</p>
                <p>
                    Next Day Change:
                    <CountdownTimer :targetTime="world.next_day_change" />
                </p>
            </div>
        </div>
    </div>
</template>
