<script setup>
import { router, Head } from "@inertiajs/vue3";
import { ref } from "vue";

// Props dari backend
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
        { banned: !user.banned },
        {
            onFinish: () => {
                // Optionally keep or close modal
            },
        }
    );
}
</script>

<template>
    <Head title="Users Management" />

    <div class="min-h-screen bg-gray-100 p-8">
        <!-- Header and button in one row -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Users Management</h1>
            <a
                href="/admin/"
                class="inline-block bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-blue-700 transition"
            >
                Go to Admin
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">User List</h2>

            <table class="w-full border text-sm">
                <thead class="bg-gray-100 text-left">
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
                        class="hover:bg-gray-50 transition"
                    >
                        <td class="border px-4 py-2 text-left">
                            {{ users.from + index }}
                        </td>
                        <td
                            class="border px-4 py-2 text-blue-600 hover:underline cursor-pointer"
                            @click="openUserModal(user)"
                        >
                            {{ user.username }}
                        </td>
                        <td class="border px-4 py-2">{{ user.email }}</td>
                        <td class="border px-4 py-2 text-left">
                            <span
                                class="inline-block px-2 py-0.5 rounded-full text-xs font-medium"
                                :class="
                                    user.banned
                                        ? 'bg-red-100 text-red-700'
                                        : 'bg-green-100 text-green-700'
                                "
                            >
                                {{ user.banned ? "Banned" : "Active" }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
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
                        'text-gray-400 cursor-not-allowed': !link.url,
                    }"
                />
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
                <div class="space-y-2 text-sm text-gray-700">
                    <p><strong>ID:</strong> {{ selectedUser.id }}</p>
                    <p>
                        <strong>Username:</strong> {{ selectedUser.username }}
                    </p>
                    <p><strong>Email:</strong> {{ selectedUser.email }}</p>
                    <p>
                        <strong>Status:</strong>
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
                        {{ selectedUser.email_verified_at ?? "Not Verified" }}
                    </p>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button
                        class="px-4 py-2 rounded bg-gray-500 hover:bg-gray-600 text-white"
                        @click="closeModal"
                    >
                        Close
                    </button>
                    <button
                        :class="[
                            'px-4 py-2 rounded text-white',
                            selectedUser.banned
                                ? 'bg-green-600 hover:bg-green-700'
                                : 'bg-red-600 hover:bg-red-700',
                        ]"
                        @click="toggleBan(selectedUser)"
                    >
                        {{ selectedUser.banned ? "Unban" : "Ban" }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
