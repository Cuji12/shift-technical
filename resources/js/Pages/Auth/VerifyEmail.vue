<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Email Verification Required</h2>

            <p class="text-gray-700 mb-4">
                Thanks for signing up! Before getting started, please verify your email address by clicking
                on the link we just emailed to you. If you didn’t receive the email, we’ll gladly send you another.
            </p>

            <div v-if="message" class="text-green-600 text-sm font-medium mb-4">
                {{ message }}
            </div>
            <div v-if="error" class="text-red-600 text-sm font-medium mb-4">
                {{ error }}
            </div>

            <form @submit.prevent="resend">
                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition disabled:opacity-50"
                    :disabled="loading"
                >
                    {{ loading ? 'Sending...' : 'Resend Verification Email' }}
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const loading = ref(false)
const message = ref('')
const error = ref('')
const router = useRouter()

const resend = async () => {
    loading.value = true
    message.value = ''
    error.value = ''

    try {
        await axios.post('/email/verification-notification')
        message.value = 'A new verification link has been sent to your email address.'
    } catch (err) {
        error.value = 'Unable to send verification email. Please try again later.'
    } finally {
        loading.value = false
    }
}
</script>
