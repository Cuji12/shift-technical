<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Reset Your Password</h2>

            <form @submit.prevent="submit" class="space-y-5">
                <input type="hidden" v-model="form.token" />

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        id="email"
                        v-model="form.email"
                        required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input
                        type="password"
                        id="password"
                        v-model="form.password"
                        required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <div v-if="error" class="text-red-600 text-sm">
                    {{ error }}
                </div>
                <div v-if="success" class="text-green-600 text-sm">
                    {{ success }}
                </div>

                <button
                    type="submit"
                    :disabled="loading"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 disabled:opacity-50"
                >
                    {{ loading ? 'Resetting...' : 'Reset Password' }}
                </button>
            </form>

            <div class="mt-6 text-center">
                <RouterLink
                    to="/login"
                    class="text-sm text-blue-600 hover:underline hover:text-blue-800 transition"
                >
                    Back to login
                </RouterLink>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const router = useRouter()

const form = ref({
    email: '',
    password: '',
    password_confirmation: '',
    token: '',
})

const error = ref('')
const success = ref('')
const loading = ref(false)

onMounted(() => {
    form.value.token = route.params.token || ''
    form.value.email = route.query.email || ''
})

const submit = async () => {
    error.value = ''
    success.value = ''
    loading.value = true

    try {
        await axios.get('/sanctum/csrf-cookie')
        await axios.post('/reset-password', form.value)

        success.value = 'Password reset successful. Redirecting to login...'
        setTimeout(() => {
            router.push({ name: 'login' })
        }, 1500)
    } catch (err) {
        error.value = err.response?.data?.message || 'Password reset failed.'
    } finally {
        loading.value = false
    }
}
</script>
