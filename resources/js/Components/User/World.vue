<script setup>
import Modal from "@/Components/User/Modal.vue";
import { ref } from "vue";

const isOpen = ref(false);
const selectedWorld = ref(null);

const closeModal = () => {
    isOpen.value = false;
};

defineProps({
    worlds: Array,
    title: String,
});
</script>

<template>
    <div
        class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-100"
    >
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
                        @click="
                            () => {
                                selectedWorld = world;
                                isOpen = true;
                            }
                        "
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Enter
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Global -->
        <Modal
            :show="isOpen"
            :title="selectedWorld ? `Halo dari ${selectedWorld.name}` : ''"
            @close="isOpen = false"
        >
            <p v-if="selectedWorld">
                Isi body modal untuk <b>{{ selectedWorld.name }}</b> 🚀
            </p>
        </Modal>
    </div>
</template>
