<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import { router, Head } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    users: Object,
});

const selectedUser = ref(null);
const showModal = ref(false);

function openUserModal(user) {
    selectedUser.value = user;
    showModal.value = true;
}

function closeModal() {
    selectedUser.value = null;
    showModal.value = false;
}

function toggleBan(user) {
    router.put(
        `/admin/users/${user.id}/ban`,
        {
            banned: !user.banned,
        },
        {
            onFinish: () => {
                // close modal optional
            },
        }
    );
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
                                    <th class="border px-4 py-2">#</th>
                                    <th class="border px-4 py-2">Username</th>
                                    <th class="border px-4 py-2">Email</th>
                                    <th class="border px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(user, index) in users.data"
                                    :key="user.id"
                                    class="hover:bg-gray-50"
                                >
                                    <td class="border px-4 py-2 text-center">
                                        {{ users.from + index }}
                                    </td>
                                    <td
                                        class="border px-4 py-2 text-blue-600 cursor-pointer hover:underline"
                                        @click="openUserModal(user)"
                                    >
                                        {{ user.username }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ user.email }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                            :class="
                                                user.banned
                                                    ? 'bg-red-100 text-red-800'
                                                    : 'bg-green-100 text-green-800'
                                            "
                                        >
                                            {{
                                                user.banned
                                                    ? "Banned"
                                                    : "Active"
                                            }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-4 flex gap-1 justify-center">
                            <button
                                v-for="(link, index) in users.links"
                                :key="index"
                                @click="link.url && router.visit(link.url)"
                                v-html="link.label"
                                :disabled="!link.url"
                                class="px-3 py-1 rounded border text-sm"
                                :class="{
                                    'bg-blue-600 text-white': link.active,
                                    'bg-white hover:bg-gray-100': !link.active,
                                }"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            v-if="showModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-4">
                    {{ selectedUser.name }}
                </h3>
                <div class="space-y-2">
                    <p><strong>ID:</strong> {{ selectedUser.id }}</p>

                    <p>
                        <strong>Username:</strong> {{ selectedUser.username }}
                    </p>
                    <p><strong>Email:</strong> {{ selectedUser.email }}</p>
                    <p>
                        <strong>Status: </strong>
                        <span
                            :class="
                                selectedUser.banned
                                    ? 'text-red-600'
                                    : 'text-green-600'
                            "
                        >
                            {{ selectedUser.banned ? "Banned" : "Active" }}
                        </span>
                    </p>
                    <p>
                        <strong>Email Verified:</strong>
                        {{ selectedUser.email_verified_at }}
                    </p>
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <button
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
                        @click="closeModal"
                    >
                        Close
                    </button>
                    <button
                        :class="
                            selectedUser.banned
                                ? 'bg-green-600 hover:bg-green-700'
                                : 'bg-red-600 hover:bg-red-700'
                        "
                        class="text-white px-4 py-2 rounded"
                        @click="toggleBan(selectedUser)"
                    >
                        {{ selectedUser.banned ? "Unban" : "Ban" }}
                    </button>
                </div>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>
