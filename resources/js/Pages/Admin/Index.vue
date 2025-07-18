<template>
    <div
        class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-100"
    >
        <!-- Header -->
        <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center"
                        >
                            <svg
                                class="w-5 h-5 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                />
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-white">
                            Airline Tycoon Admin
                        </h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-blue-100"
                            >Welcome, Admin</span
                        >
                        <button
                            class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200"
                        >
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Page Title -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-blue-900">
                    Dashboard Overview
                </h2>
                <p class="text-blue-700">
                    Manage your airline empire from here
                </p>
            </div>

            <!-- Admin Cards Grid -->
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                <Card
                    v-for="item in dashboardItems"
                    :key="item.title"
                    :title="item.title"
                    :description="item.description"
                    :icon="item.icon"
                    :value="item.value"
                    :color="item.color"
                    :route="item.route"
                    @click="navigateTo(item.route)"
                />
            </div>
        </main>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import Card from "./Card.vue";

export default {
    components: {
        Head,
        Card,
    },
    props: {
        stats: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            dashboardItems: [
                {
                    title: "Users",
                    description: "Manage players and accounts",
                    icon: "users",
                    value: "1,234",
                    color: "blue",
                    route: "/admin/users",
                },
                {
                    title: "Analytics",
                    description: "Game statistics & metrics",
                    icon: "chart-bar",
                    value: "98%",
                    color: "indigo",
                    route: "/admin/analytics",
                },
                {
                    title: "Aircraft",
                    description: "Manage fleet & aircraft types",
                    icon: "paper-airplane",
                    value: "456",
                    color: "sky",
                    route: "/admin/aircraft",
                },
                {
                    title: "Routes",
                    description: "Flight routes & destinations",
                    icon: "location-marker",
                    value: "89",
                    color: "blue",
                    route: "/admin/routes",
                },
                {
                    title: "Airports",
                    description: "Airport data & terminals",
                    icon: "office-building",
                    value: "234",
                    color: "indigo",
                    route: "/admin/airports",
                },
                {
                    title: "Finance",
                    description: "Revenue & financial reports",
                    icon: "currency-dollar",
                    value: "$1.2M",
                    color: "cyan",
                    route: "/admin/finance",
                },
                {
                    title: "Settings",
                    description: "Game configuration & rules",
                    icon: "cog",
                    value: "12",
                    color: "slate",
                    route: "/admin/settings",
                },
                {
                    title: "Leaderboard",
                    description: "Player rankings & scores",
                    icon: "star",
                    value: "TOP",
                    color: "amber",
                    route: "/admin/leaderboard",
                },
                {
                    title: "Events",
                    description: "Game events & announcements",
                    icon: "newspaper",
                    value: "8",
                    color: "rose",
                    route: "/admin/events",
                },
                {
                    title: "Support",
                    description: "Help desk & system logs",
                    icon: "support",
                    value: "24/7",
                    color: "teal",
                    route: "/admin/support",
                },
            ],
        };
    },
    methods: {
        navigateTo(route) {
            this.$inertia.visit(route);
        },
    },
    mounted() {
        console.log("Admin Dashboard loaded");
    },
};
</script>

<style scoped></style>
