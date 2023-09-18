<template>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
        <AvatarCard />
        <AvatarCard class="col-span-2"/>
    </div>
</template>

<script setup lang="ts">
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/20/solid'
import { useAuthStore } from '@/store/auth/AuthStore'
import { ref } from 'vue'

import AppButton from '@/components/AppButton.vue'
import AvatarCard from '@/views/account-settings/cards/AvatarCard.vue'

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
