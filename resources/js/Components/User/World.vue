<script setup>
import { ref } from "vue";
import axios from "axios";

// Airline name per-world supaya tidak campur
const airlineNames = ref({});

// Fungsi untuk menyimpan world baru
const saveWorld = async (world) => {
    try {
        // bikin alamat dinamis dari nama world, misalnya "Game World 1" -> "/world1"
        const worldNumber = world.name.split(" ").pop(); // ambil angka terakhir dari nama
        const url = `/world${worldNumber}`;

        let response = await axios.post(url, {
            airline_name: airlineNames.value[world.id] || "",
        });

        console.log("World saved:", response.data);

        // reset input untuk world ini saja
        airlineNames.value[world.id] = "";
    } catch (error) {
        console.error("Error:", error);
    }
};

// props dari controller
defineProps({
    worlds: Array,
    title: String,
});
</script>

<template>
    <div
        class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-100"
    >
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

                <form @submit.prevent="saveWorld(world)" class="space-y-4">
                    <div>
                        <label class="block mb-1 font-semibold"
                            >Airline Name</label
                        >
                        <input
                            v-model="airlineNames[world.id]"
                            type="text"
                            class="border px-3 py-2 rounded w-full"
                            placeholder="Enter Your Airline Name"
                        />
                    </div>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded"
                    >
                        Start Airline
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
