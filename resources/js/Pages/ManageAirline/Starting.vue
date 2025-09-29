<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    aircrafts: Array,
    airports: Array,
    worldId: [String, Number], // Add this prop
});

// State untuk simpan pilihan
const selectedAircraft = ref(null);
const selectedAirport = ref(null);

// State pencarian bandara
const searchQuery = ref("");

// State untuk loading dan error
const isLoading = ref(false);
const errorMessage = ref("");

// Computed untuk filter airport
const filteredAirports = computed(() => {
    if (!searchQuery.value) return [];
    return props.airports.filter(
        (a) =>
            a.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            a.iata_code.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

// Aksi klik tombol
const startOperational = () => {
    if (!selectedAircraft.value || !selectedAirport.value) {
        errorMessage.value = "Pilih pesawat dan bandara terlebih dahulu";
        return;
    }

    isLoading.value = true;
    errorMessage.value = "";

    router.post(
        "/manage-airline-start/" + props.worldId,
        {
            aircraft: selectedAircraft.value,
            airport: selectedAirport.value,
        },
        {
            onSuccess: () => {
                // misalnya redirect otomatis
                console.log("Berhasil memulai operasi");
            },
            onError: (errors) => {
                errorMessage.value =
                    Object.values(errors)[0] || "Terjadi kesalahan";
                isLoading.value = false;
            },
            onFinish: () => {
                isLoading.value = false;
            },
        }
    );
};
</script>

<template>
    <div class="p-6 space-y-6">
        <!-- Error Message -->
        <div
            v-if="errorMessage"
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
        >
            {{ errorMessage }}
        </div>

        <!-- Pesawat -->
        <div>
            <h2 class="text-xl font-bold mb-4">Pilih Pesawat Awal</h2>
            <table
                class="table-auto border-collapse border border-gray-300 w-full"
            >
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-2 py-1 text-left">
                            Choose
                        </th>
                        <th class="border border-gray-300 px-2 py-1 text-left">
                            Nama Pesawat
                        </th>
                        <th class="border border-gray-300 px-2 py-1 text-left">
                            Manufacturer
                        </th>
                        <th class="border border-gray-300 px-2 py-1 text-left">
                            Kapasitas
                        </th>
                        <th class="border border-gray-300 px-2 py-1 text-left">
                            Range (km)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="aircraft in props.aircrafts" :key="aircraft.id">
                        <td
                            class="border border-gray-300 px-2 py-1 text-center"
                        >
                            <input
                                type="radio"
                                name="selected_aircraft"
                                :value="aircraft.id"
                                v-model="selectedAircraft"
                            />
                        </td>
                        <td class="border border-gray-300 px-2 py-1">
                            {{ aircraft.aircraft_name }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1">
                            {{ aircraft.manufacturer }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1">
                            {{ aircraft.capacity }}
                        </td>
                        <td class="border border-gray-300 px-2 py-1">
                            {{ aircraft.range_km }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Bandara -->
        <div>
            <h2 class="text-xl font-bold mb-4">Pilih Bandara Awal</h2>

            <input
                type="text"
                v-model="searchQuery"
                placeholder="Cari bandara (nama atau IATA)"
                class="border p-2 w-full mb-3"
            />

            <ul class="border rounded max-h-48 overflow-y-auto">
                <li
                    v-for="airport in filteredAirports"
                    :key="airport.id"
                    class="flex items-center p-2 hover:bg-gray-100 cursor-pointer"
                    @click="selectedAirport = airport.id"
                >
                    <input
                        type="radio"
                        name="selected_airport"
                        :value="airport.id"
                        v-model="selectedAirport"
                        class="mr-2"
                    />
                    <span>{{ airport.name }} ({{ airport.iata_code }})</span>
                </li>
            </ul>
        </div>

        <!-- Tombol -->
        <div>
            <button
                class="bg-blue-600 text-white px-4 py-2 rounded disabled:bg-gray-400 disabled:cursor-not-allowed"
                :disabled="!selectedAircraft || !selectedAirport || isLoading"
                @click="startOperational"
            >
                {{ isLoading ? "Loading..." : "Start Operational" }}
            </button>
        </div>
    </div>
</template>
