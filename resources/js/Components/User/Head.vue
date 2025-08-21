<script setup>
const props = defineProps({
    text: {
        type: String,
        default: "User Experience",
    },
    color: {
        type: String,
        default: "text-slate-800", // tailwind class
    },
    size: {
        type: String,
        default: "text-6xl", // tailwind class
    },
    align: {
        type: String,
        default: "text-center", // bisa text-left, text-right, dsb
    },
    bgColor: {
        type: String,
        default: "bg-slate-200", // tailwind class
    },
});
</script>

<template>
    <header :class="`py-10 shadow-md ${bgColor}`">
        <h1 :class="`${size} ${color} font-extrabold ${align}`">
            {{ text }}
        </h1>
    </header>
</template>
