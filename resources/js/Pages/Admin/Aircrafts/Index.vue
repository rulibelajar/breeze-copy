<script setup>
import { Head } from "@inertiajs/vue3";

defineProps({
    aircrafts: Array,
});
</script>

<template>
    <Head title="Aircrafts" />

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Aircrafts</h1>

        <div class="overflow-x-auto">
            <table
                class="table-auto border-collapse border border-gray-300 w-full text-left"
            >
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Family</th>
                        <th class="border border-gray-300 px-4 py-2">
                            Manufacturer
                        </th>
                        <th class="border border-gray-300 px-4 py-2">Speed</th>
                        <th class="border border-gray-300 px-4 py-2">
                            Capacity
                        </th>
                        <th class="border border-gray-300 px-4 py-2">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="aircraft in aircrafts" :key="aircraft.id">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ aircraft.id }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ aircraft.name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ aircraft.family }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ aircraft.manufacturer }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ aircraft.speed }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ aircraft.capacity }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ aircraft.price }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
