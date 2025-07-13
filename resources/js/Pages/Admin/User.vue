<script setup>
defineProps({
    users: Array,
});
</script>

<template>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Daftar User</h1>

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
                    <td class="border px-4 py-2">{{ user.id }}</td>
                    <td class="border px-4 py-2">{{ user.name }}</td>
                    <td class="border px-4 py-2">{{ user.email }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
