<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";

defineProps({
    users: Array,
});
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
                                    <th class="border px-4 py-2">Nama</th>
                                    <th class="border px-4 py-2">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td class="border px-4 py-2">
                                        {{ user.id }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ user.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ user.email }}
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
