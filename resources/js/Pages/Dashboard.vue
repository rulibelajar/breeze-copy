<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { defineProps, ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    user: String,
    username: String,
    worlds: Array,
});

// State untuk mengontrol form mana yang sedang aktif
const activeForm = ref(null);

// Form untuk setiap world
const forms = {
    1: useForm({
        airline_name: "",
        world_id: "1",
    }),
    2: useForm({
        airline_name: "",
        world_id: "2",
    }),
    3: useForm({
        airline_name: "",
        world_id: "3",
    }),
};

const submit = (worldId) => {
    forms[worldId].post(route("airline.store"), {
        onSuccess: () => {
            activeForm.value = null;
        },
    });
};

const showForm = (worldId) => {
    activeForm.value = worldId;
};

const hideForm = () => {
    activeForm.value = null;
};

const enterWorld = (worldId) => {
    // Sesuaikan dengan route Anda
    router.visit(`/manage-airline/${worldId}`);
};
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
            <div class="mb-6">
                <h1 class="text-2xl font-bold mb-2">
                    Welcome, {{ username }}!
                </h1>
                <p class="text-gray-600">User ID: {{ user }}</p>
            </div>

            <!-- Grid untuk 3 worlds -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="world in worlds"
                    :key="world.id"
                    class="bg-white rounded-lg shadow-lg p-6 border border-gray-200"
                >
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">
                            {{ world.title }}
                        </h2>
                        <div class="text-sm text-gray-500">
                            ID: {{ world.id }}
                        </div>
                    </div>

                    <!-- Jika sudah punya airline -->
                    <div v-if="world.have_airline" class="space-y-4">
                        <div
                            class="bg-green-50 border border-green-200 rounded-lg p-4"
                        >
                            <div class="flex items-center mb-2">
                                <svg
                                    class="w-5 h-5 text-green-500 mr-2"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                <span
                                    class="text-sm font-medium text-green-800"
                                >
                                    Airline Active
                                </span>
                            </div>
                            <p class="text-sm text-green-700 mb-3">
                                <strong>{{ world.airline_name }}</strong>
                            </p>
                            <button
                                @click="enterWorld(world.id)"
                                class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition-colors duration-200"
                            >
                                Enter World
                            </button>
                        </div>
                    </div>

                    <!-- Jika belum punya airline -->
                    <div v-else class="space-y-4">
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-lg p-4"
                        >
                            <div class="flex items-center mb-2">
                                <svg
                                    class="w-5 h-5 text-gray-400 mr-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-600">
                                    No Airline
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mb-3">
                                Create your airline to start playing in this
                                world.
                            </p>

                            <!-- Form create airline (hidden by default) -->
                            <div
                                v-if="activeForm === world.id"
                                class="space-y-3"
                            >
                                <form
                                    @submit.prevent="submit(world.id)"
                                    class="space-y-3"
                                >
                                    <div>
                                        <label
                                            :for="'airline_name_' + world.id"
                                            class="block text-sm font-medium text-gray-700 mb-1"
                                        >
                                            Airline Name
                                        </label>
                                        <input
                                            v-model="
                                                forms[world.id].airline_name
                                            "
                                            :id="'airline_name_' + world.id"
                                            type="text"
                                            placeholder="Enter your airline name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            required
                                        />
                                        <div
                                            v-if="
                                                forms[world.id].errors
                                                    .airline_name
                                            "
                                            class="text-red-500 text-sm mt-1"
                                        >
                                            {{
                                                forms[world.id].errors
                                                    .airline_name
                                            }}
                                        </div>
                                    </div>

                                    <div class="flex space-x-2">
                                        <button
                                            type="submit"
                                            class="flex-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200"
                                            :disabled="
                                                forms[world.id].processing
                                            "
                                        >
                                            <span
                                                v-if="
                                                    !forms[world.id].processing
                                                "
                                                >Create</span
                                            >
                                            <span v-else>Creating...</span>
                                        </button>
                                        <button
                                            type="button"
                                            @click="hideForm"
                                            class="px-3 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-md transition-colors duration-200"
                                        >
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Button untuk show form -->
                            <button
                                v-else
                                @click="showForm(world.id)"
                                class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200"
                            >
                                Create Airline
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Custom styling jika diperlukan */
</style>
