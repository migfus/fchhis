<template>
    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
            <div class="flex flex-1 flex-col p-8">
                <img class="mx-auto h-32 w-32 flex-shrink-0 rounded-full" :src="$auth.content.auth.avatar" alt="" />
                <h3 class="mt-6 text-sm font-medium text-gray-900">{{ $auth.content.auth.name }}</h3>
                <dl class="mt-1 flex flex-grow flex-col justify-between">
                    <dt class="sr-only">Title</dt>
                    <dd class="text-sm text-gray-500">{{ $auth.content.auth.email }}</dd>
                    <dt class="sr-only">Role</dt>
                    <dd class="mt-3">
                        <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800">{{ $auth.content.auth.roles[0].name }}</span>
                    </dd>
                </dl>
            </div>

            <AppButton @click="open = true">
                Change Avatar
            </AppButton>

        </li>
    </ul>
    <AvatarUpload v-model="open"/>
</template>

<script setup lang="ts">
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/20/solid'
import { useAuthStore } from '@/store/auth/AuthStore'
import { ref } from 'vue'

import AppButton from '@/components/AppButton.vue'
import AvatarUpload from './modals/AvatarUpload.vue'

const $auth = useAuthStore();

const people = [
    {
        name: 'Jane Cooper',
        title: 'Paradigm Representative',
        role: 'Admin',
        email: 'janecooper@example.com',
        telephone: '+1-202-555-0170',
        imageUrl:
        'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    // More people...
]
const open = ref(false)
</script>
