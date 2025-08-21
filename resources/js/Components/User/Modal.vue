<template>
    <div
        v-if="show"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
    >
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">{{ title }}</h2>
                <button @click="close" class="text-gray-500 hover:text-red-500">
                    ✖
                </button>
            </div>

            <!-- Body -->
            <div>
                <slot />
            </div>

            <!-- Footer -->
            <div class="flex justify-end mt-4">
                <button
                    @click="close"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    show: Boolean,
    title: String,
});

const emit = defineEmits(["close"]);

const close = () => {
    emit("close");
};
</script>
