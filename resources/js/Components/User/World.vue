<script setup>
import { ref } from "vue";
import axios from "axios";

// Airline name per-world supaya tidak campur
const airlineName = ref({});
// State untuk error messages per world
const errorMessages = ref({});
// State untuk loading per world
const isLoading = ref({});

// Fungsi untuk menyimpan world baru
const saveWorld = async (world) => {
    try {
        // Reset error message untuk world ini
        errorMessages.value[world.id] = "";
        isLoading.value[world.id] = true;

        // Validasi input kosong di frontend
        if (
            !airlineName.value[world.id] ||
            airlineName.value[world.id].trim() === ""
        ) {
            errorMessages.value[world.id] = "Nama airline wajib diisi.";
            isLoading.value[world.id] = false;
            return;
        }

        // bikin alamat dinamis dari nama world, misalnya "Game World 1" -> "/world1"
        const worldNumber = world.name.split(" ").pop(); // ambil angka terakhir dari nama
        const url = `/world${worldNumber}`;

        let response = await axios.post(url, {
            airline_name: airlineName.value[world.id].trim(),
        });

        console.log("World saved:", response.data);

        // redirect ke halaman airline di world tsb
        window.location.href = `/world${worldNumber}/airline/${response.data.id}`;

        // reset input untuk world ini saja
        airlineName.value[world.id] = "";

        // Refresh halaman atau update state world jika diperlukan
        // window.location.reload(); // atau emit event ke parent component
    } catch (error) {
        console.error("Error:", error);

        // Handle validation errors dari Laravel
        if (error.response && error.response.status === 422) {
            const validationErrors = error.response.data.errors;
            if (validationErrors.airline_name) {
                errorMessages.value[world.id] =
                    validationErrors.airline_name[0];
            }
        } else if (error.response && error.response.status === 500) {
            errorMessages.value[world.id] =
                "Terjadi kesalahan server. Silakan coba lagi.";
        } else {
            errorMessages.value[world.id] =
                "Terjadi kesalahan. Silakan coba lagi.";
        }
    } finally {
        isLoading.value[world.id] = false;
    }
};

// Fungsi untuk clear error saat user mulai mengetik
const clearError = (worldId) => {
    errorMessages.value[worldId] = "";
};

// props dari controller
defineProps({
    worlds: Array,
    title: String,
});

// untuk enter ke world yang dimaksud
const enterWorld = (world) => {
    const worldNumber = world.name.split(" ").pop();
    window.location.href = `/world${worldNumber}/airline/${world.id}`;
};
</script>

<template>
    <div
        class="min-h-screen bg-gradient-to-br from-blue-100 via-indigo-100 to-blue-200 p-6"
    >
        <h1 class="text-3xl font-bold mb-6 text-gray-800">{{ title }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
                v-for="world in worlds"
                :key="world.id"
                class="bg-white p-6 border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow"
            >
                <h2 class="font-semibold text-xl mb-2 text-gray-800">
                    {{ world.name }}
                </h2>
                <p class="text-gray-600 mb-1">Day Game: {{ world.game_day }}</p>
                <p class="text-gray-600 mb-4">
                    Day Date: {{ world.game_date }}
                </p>

                <form
                    v-if="!world.airline_name"
                    @submit.prevent="saveWorld(world)"
                    class="space-y-4"
                >
                    <div>
                        <label class="block mb-2 font-semibold text-teal-600"
                            >You Don't Have an Airline</label
                        >
                        <input
                            v-model="airlineName[world.id]"
                            @input="clearError(world.id)"
                            type="text"
                            class="border border-gray-300 px-3 py-2 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter Your Airline Name (max 20 characters)"
                            maxlength="20"
                            :disabled="isLoading[world.id]"
                        />

                        <!-- Error Message -->
                        <div
                            v-if="errorMessages[world.id]"
                            class="mt-2 text-sm text-red-600 bg-red-50 p-2 rounded border border-red-200"
                        >
                            {{ errorMessages[world.id] }}
                        </div>

                        <!-- Character counter -->
                        <div class="mt-1 text-xs text-gray-500">
                            {{ (airlineName[world.id] || "").length }}/20
                            characters
                        </div>
                    </div>

                    <button
                        type="submit"
                        :disabled="
                            isLoading[world.id] ||
                            !airlineName[world.id]?.trim()
                        "
                        class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 disabled:bg-gray-400 disabled:cursor-not-allowed text-white rounded-md font-medium transition-colors"
                    >
                        <span v-if="isLoading[world.id]">Creating...</span>
                        <span v-else>Start Airline</span>
                    </button>
                </form>

                <!-- Kalau airline_name sudah ada -->
                <div v-else class="mt-4">
                    <div
                        class="p-3 bg-green-50 border border-green-200 rounded-md mb-3"
                    >
                        <p class="text-sm text-green-700 font-medium">
                            Your Airline:
                        </p>
                        <p class="text-lg font-bold text-green-800">
                            {{ world.airline_name }}
                        </p>
                    </div>

                    <button
                        type="button"
                        class="w-full px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md font-medium transition-colors"
                        @click="enterWorld(world)"
                    >
                        Enter Game
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
