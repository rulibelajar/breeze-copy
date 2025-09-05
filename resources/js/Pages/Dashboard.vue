<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
    user: Number,
    username: String,
    title: String,
    worlds: Array,
    have_airline: Boolean,
});

// form inertia
const form = useForm({
    airline_name: "",
    world_id: "1",
});

const submit = () => {
    form.post(route("airline.store")); // sesuaikan route name / endpoint backend kamu
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
            <h1 class="text-2xl font-bold mb-4">{{ title }}</h1>
            <p class="mb-6">User ID: {{ user }}</p>
            <p class="mb-6">Username: {{ username }}</p>
            <h2 class="mb-6">{{ title }}</h2>

            <!-- kalau belum punya airlines -->
            <div v-if="!have_airline" class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Create Your Airline</h3>
                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Airline Name
                        </label>
                        <input
                            v-model="form.airline_name"
                            type="text"
                            id="airline_name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        />
                        <div
                            v-if="form.errors.airline_name"
                            class="text-red-500 text-sm"
                        >
                            {{ form.errors.airline_name }}
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md"
                        :disabled="form.processing"
                    >
                        Save
                    </button>
                </form>
            </div>
            <!-- kalau sudah punya airline -->
            <div v-else class="mt-6">
                <button
                    @click="$inertia.visit(route('worlds.index'))"
                    class="px-4 py-2 bg-green-600 text-white rounded-md"
                >
                    Enter World
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
