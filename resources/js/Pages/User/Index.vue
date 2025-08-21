<script setup>
import Head from "@/Components/User/Head.vue";
import Modal from "@/Components/User/Modal.vue";
import { ref } from "vue";

const isOpen = ref(false);

defineProps({
    worlds: Array, // sesuai props dari controller
    title: String,
});
</script>

<template>
    <Head
        text="User Experience"
        color="text-slate-300"
        size="text-6xl"
        bg-color="bg-sky-500"
    />
    <div>
        <h1 class="text-3xl font-bold mb-4">{{ title }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                v-for="world in worlds"
                :key="world.id"
                class="p-4 border rounded shadow"
            >
                <h2 class="font-semibold text-lg">{{ world.name }}</h2>
                <p>Name: {{ world.name }}</p>
                <p>Day Game: {{ world.game_day }}</p>
                <p>Day Date: {{ world.game_date }}</p>
                <div class="p-6">
                    <button
                        @click="isOpen = true"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Enter
                    </button>

                    <Modal
                        :show="isOpen"
                        title="Halo dari Modal"
                        @close="isOpen = false"
                    >
                        <p>Ini isi body modal, bisa apa saja 🚀</p>
                    </Modal>
                </div>
            </div>
        </div>
    </div>
</template>
