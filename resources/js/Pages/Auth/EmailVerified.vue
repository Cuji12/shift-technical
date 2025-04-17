<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white p-8 rounded-xl shadow text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Email Verification</h2>

            <div v-if="loading" class="text-gray-600">Verifying your email, please wait...</div>

            <div v-if="success" class="text-green-600 text-lg font-semibold">
                {{ success }}
            </div>

            <div v-if="error" class="text-red-600 text-lg font-semibold">
                {{ error }}
            </div>

            <div v-if="success || error" class="mt-6">
                <RouterLink to="/login" class="text-blue-600 hover:underline hover:text-blue-800">
                    Go to Login
                </RouterLink>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()

const success = ref('')
const error = ref('')
const loading = ref(true)

onMounted(async () => {
    const { id, hash } = route.params

    try {
        await axios.get(`/email/verify/${id}/${hash}`, {
            params: route.query, // include signature, expires, etc.
        })
        success.value = 'Your email has been successfully verified!'
    } catch (err) {
        console.error(err)
        error.value =
            err.response?.data?.message ||
            'Verification link is invalid or has expired. Please try resending the email.'
    } finally {
        loading.value = false
    }
})
</script>
