<!-- resources/js/Components/Admin/Card.vue -->
<template>
    <div
        @click="$inertia.visit(route)"
        class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 cursor-pointer border border-blue-200 group hover:border-blue-300 hover:scale-105"
    >
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div
                    class="w-12 h-12 rounded-lg flex items-center justify-center transition-colors"
                    :class="bgColor"
                >
                    <component :is="icon" class="w-6 h-6" :class="textColor" />
                </div>
                <span class="text-2xl font-bold" :class="textColor">{{
                    value
                }}</span>
            </div>
            <h3 class="text-lg font-semibold text-blue-900 mb-2">
                {{ title }}
            </h3>
            <p class="text-blue-600 text-sm">{{ description }}</p>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

defineProps({
    icon: {
        type: Object,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
    value: {
        type: [String, Number],
        required: true,
    },
    bgColor: {
        type: String,
        default: "bg-blue-100 group-hover:bg-blue-200",
    },
    textColor: {
        type: String,
        default: "text-blue-600",
    },
    route: {
        type: String,
        required: true,
    },
});
</script>
