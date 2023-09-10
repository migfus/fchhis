<template>
    <div class='h-full'>
        <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 col-start-1 col-span-3 lg:col-span-1 lg:col-start-2">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <img class="mx-auto h-24 w-auto" src="http://127.0.0.1:8000/images/logo.png" alt="Your Company" />
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Recover your account</h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <form class="space-y-6" action="#" method="POST" @submit.prevent="">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input v-model="input.email" id="email" name="email" type="email" autocomplete="email" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-sm">
                                <RouterLink :to="{name: 'login'}" class="font-medium text-primary-600 hover:text-primary-500">Back to Login</RouterLink>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">Send Recovery Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue';

interface inputInt {
    email: string
}

const input = reactive<inputInt>({
    email: '',
});
</script>
