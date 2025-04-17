<template>
    <router-view v-slot="{ Component, route }">
        <Header />
        <div :key="route.name">
            <Component :is="Component" />
        </div>
    </router-view>
</template>

<script setup>
import Header from './Components/Header.vue'
</script>
