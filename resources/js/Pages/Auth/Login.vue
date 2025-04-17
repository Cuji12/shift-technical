<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-700">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login to Your Account</h2>

            <form @submit.prevent="submitLogin" class="space-y-5">
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
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input
                        type="password"
                        id="password"
                        v-model="form.password"
                        required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />

                    <div class="flex justify-end">
                        <RouterLink
                            to="/forgot-password"
                            class="text-sm text-blue-600 hover:underline hover:text-blue-800 transition"
                        >
                            Forgot your password?
                        </RouterLink>
                    </div>
                </div>

                <div class="flex gap-x-2">
                    <label for="remember_me" class="block text-sm font-medium text-gray-700">Remember Me</label>
                    <input
                        type="checkbox"
                        id="remember_me"
                        v-model="form.remember_me"
                        class="cursor-pointer px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>

                <div v-if="error" class="text-red-600 text-sm">
                    {{ error }}
                </div>

                <button
                    type="submit"
                    :disabled="loading"
                    class="cursor-pointer w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 disabled:opacity-50"
                >
                    {{ loading ? 'Logging in...' : 'Login' }}
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don’t have an account?
                    <RouterLink
                        to="/register"
                        class="text-blue-600 hover:underline hover:text-blue-800 transition"
                    >
                        Create one
                    </RouterLink>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { reactive } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = ref({
    email: '',
    password: '',
    remember_me: false
})

const error = ref('')
const loading = ref(false)

const submitLogin = async () => {
    loading.value = true
    error.value = ''

    try {
        await axios.get('/sanctum/csrf-cookie') // Ensure CSRF token is set

        await axios.post('/login', form.value)

        router.push({ name: 'home' })
    } catch (err) {
        error.value = err.response?.data?.message || 'Login failed'
    } finally {
        loading.value = false
    }
}
</script>

<style scoped>

</style>
