<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import { router, Head } from "@inertiajs/vue3";

defineProps({
    users: Array,
});

function toggleBan(user) {
    router.put(`/admin/users/${user.id}/ban`, {
        banned: !user.banned,
    });
}
</script>

<template>
    <Head title="Users Management" />

    <AdminAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Users Management
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Users Lists</div>
                    <div class="p-4">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Name</th>
                                    <th class="border px-4 py-2">Email</th>
                                    <th class="border px-4 py-2">Banned</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="user in users"
                                    :key="user.id"
                                    class="hover:bg-gray-50"
                                >
                                    <td class="border px-4 py-2 text-center">
                                        {{ user.id }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ user.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ user.email }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <div
                                            class="flex items-center justify-center space-x-2"
                                        >
                                            <!-- Status Badge -->
                                            <span
                                                :class="
                                                    user.banned
                                                        ? 'bg-red-100 text-red-800'
                                                        : 'bg-green-100 text-green-800'
                                                "
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                            >
                                                {{
                                                    user.banned
                                                        ? "Banned"
                                                        : "Active"
                                                }}
                                            </span>

                                            <!-- Ban/Unban Button -->
                                            <button
                                                @click="toggleBan(user)"
                                                :class="[
                                                    user.banned
                                                        ? 'bg-green-600 hover:bg-green-700 focus:ring-green-500'
                                                        : 'bg-red-600 hover:bg-red-700 focus:ring-red-500',
                                                    'inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2',
                                                ]"
                                                :disabled="user.processing"
                                            >
                                                <svg
                                                    v-if="user.processing"
                                                    class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <circle
                                                        class="opacity-25"
                                                        cx="12"
                                                        cy="12"
                                                        r="10"
                                                        stroke="currentColor"
                                                        stroke-width="4"
                                                    ></circle>
                                                    <path
                                                        class="opacity-75"
                                                        fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                                    ></path>
                                                </svg>

                                                <svg
                                                    v-else-if="user.banned"
                                                    class="w-4 h-4 mr-1"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"
                                                    ></path>
                                                </svg>

                                                <svg
                                                    v-else
                                                    class="w-4 h-4 mr-1"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"
                                                    ></path>
                                                </svg>

                                                {{
                                                    user.banned
                                                        ? "Unban"
                                                        : "Ban"
                                                }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>
