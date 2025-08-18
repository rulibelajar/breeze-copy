<script setup>
import { ref, onMounted, onUnmounted } from "vue";

const props = defineProps({
    targetTime: String, // format "YYYY-MM-DD HH:mm:ss" dari backend
});

const countdown = ref("");

let timer = null;

function updateCountdown() {
    const now = new Date();
    const target = new Date(props.targetTime.replace(" ", "T")); // biar valid ISO
    let diff = Math.floor((target - now) / 1000);

    if (diff <= 0) {
        countdown.value = "Waktu sudah lewat";
        clearInterval(timer);
        window.location.reload();
        return;
    }

    const h = String(Math.floor(diff / 3600)).padStart(2, "0");
    const m = String(Math.floor((diff % 3600) / 60)).padStart(2, "0");
    const s = String(diff % 60).padStart(2, "0");

    countdown.value = `${h}:${m}:${s}`;
}

onMounted(() => {
    updateCountdown();
    timer = setInterval(updateCountdown, 1000);
});

onUnmounted(() => {
    clearInterval(timer);
});
</script>

<template>
    <span>{{ countdown }}</span>
</template>
