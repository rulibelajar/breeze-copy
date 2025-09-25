<script setup>
defineProps({
    worldId: String,
    userId: String,
    airline: Object,
});
</script>

<template>
    <div>
        <h1>World ID: {{ worldId }}</h1>
        <h3>User ID: {{ userId }}</h3>
        <h3>Airline: {{ airline.airline_name }}</h3>
    </div>
</template>
