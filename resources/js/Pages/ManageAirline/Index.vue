<script setup>
defineProps({
    worldId: String,
    userId: String,
});
</script>

<template>
    <div>
        <h1>World ID: {{ worldId }}</h1>
        <h3>User ID: {{ userId }}</h3>
    </div>
</template>
