<script setup>
import axios from "axios";
import { ref } from "vue";

const airlineName = ref("");

const saveWorld = async () => {
    try {
        let response = await axios.post("/world1", {
            airline_name: airlineName.value,
        });
        console.log("World saved:", response.data);
        airlineName.value = ""; // reset form setelah sukses
    } catch (error) {
        console.error("Error:", error);
    }
};
</script>

<template>
    <form @submit.prevent="saveWorld" class="space-y-4">
        <div>
            <label class="block mb-1 font-semibold">Airline Name</label>
            <input
                v-model="airlineName"
                type="text"
                class="border px-3 py-2 rounded w-full"
                placeholder="Masukkan nama airline"
            />
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
            Save World
        </button>
    </form>
</template>
