<template>
    <div class="mt-2">
        <div class="mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-full lg:px-8">
            <div class="flex items-center space-x-5">
                <div class="flex-shrink-0">
                    <div class="relative">
                        <img class="h-16 w-16 rounded-full" :src="$auth.content.auth.avatar" alt="" />
                        <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true" />
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{  $auth.content.auth.name }}</h1>
                    <p class="text-sm font-medium text-gray-500">{{  $auth.content.auth.email }}</p>
                    <p class="text-sm font-medium text-gray-500">Registered on
                        <time datetime="2020-08-25" class="text-gray-900">
                            {{ moment($auth.content.auth.created_at.toString()).format('MMM D, YYYY') }}
                        </time>
                    </p>
                </div>
            </div>
            <div class="justify-stretch mt-6 flex flex-col-reverse space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-y-0 sm:space-x-3 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
                <div class="text-gray-500 my-1 mr-2">{{ $auth.content.auth.roles[0].name }}</div>
                <AppButton size="sm">Change Avatar</AppButton>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/auth/AuthStore'
import moment from 'moment'

import AppButton from '@/components/AppButton.vue';

const $auth = useAuthStore()

</script>
