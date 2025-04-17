<template>
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <RouterLink to="/" class="text-xl font-semibold text-gray-800 hover:text-blue-600">
                Home
            </RouterLink>

            <nav class="space-x-4">
                <RouterLink
                    v-if="!isHomePage"
                    to="/login"
                    class="cursor-pointer text-sm text-blue-600 hover:underline hover:text-blue-800"
                >
                    Login
                </RouterLink>

                <button
                    v-else
                    @click="logout"
                    class="cursor-pointer text-sm text-red-600 hover:underline hover:text-red-800"
                >
                    Logout
                </button>
            </nav>
        </div>
    </header>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const isHomePage = computed(() => router.currentRoute._value.name === 'home')

// Logout
const logout = async () => {
    try {
        await axios.post('/logout')
        router.push({ name: 'login' })
    } catch (err) {
        console.error('Logout failed', err)
    }
}
</script>
