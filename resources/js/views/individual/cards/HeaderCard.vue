<template>
    <div class="pb-4 mb-2 shadow bg-white rounded-xl">
        <div>
            <img class="h-32 w-full object-cover lg:h-48 rounded-t-xl" src='https://images.unsplash.com/photo-1444628838545-ac4016a5418a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80' alt="" />
            <AppButton color="white" class="cursor-default absolute top-[150px] right-[18px] sm:right-[48px] md:right-[55px] opacity-75 backdrop-blur-xl">
                <ClockIcon class="h-6 w-5 mr-2 text-black"/>
                {{ moment(String($user.content.created_at)).format('MMM D, YYYY hh:mm A') }}
            </AppButton>
            <RouterLink :to="{ name: 'user', params: { id: $user.content.info.agent.id }}">
                <AppButton color="white" class="absolute top-[200px] right-[18px] sm:right-[48px] md:right-[55px] opacity-75 backdrop-blur-xl">
                    <UsersIcon class="h-6 w-5 mr-2 text-black"/>
                    {{ $user.content.info.agent.name }}
                </AppButton>
            </RouterLink>
            <AppButton color="white" class="cursor-default absolute top-[150px] left-[15px] sm:left-[50px] md:left-[310px] opacity-75 backdrop-blur-xl">
                <CheckBadgeIcon class="h-6 w-5 mr-2 text-blue-500"/>
                {{ $user.content.roles[0].name }}
            </AppButton>

        </div>
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
                <div class="flex">
                    <img
                        :class="[
                            'h-24 w-24 rounded-full ring-4 sm:h-32 sm:w-32 ring-white',
                            DueStatusColor($user.content.info.due_at, 'ring')
                        ]"
                        :src="$user.content.avatar ?? 'https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg'"
                        alt=""
                    />
                </div>
                <div class="mt-6 sm:flex sm:min-w-0 sm:flex-1 sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="mt-6 min-w-0 flex-1 sm:hidden md:block">
                        <h1 class="truncate text-2xl font-bold text-gray-900">{{ $user.content.name }}</h1>
                        <p class="truncate font-bold text-gray-400">{{ $user.content.email }}</p>
                    </div>
                    <div class="justify-stretch mt-6 flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <!-- <button type="button" class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                            <EnvelopeIcon class="-ml-1 mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                            <span>Message</span>
                        </button> -->

                        <AppButton @click="show = true" color="white" size="sm">
                            Change Avatar
                        </AppButton>
                    </div>
                </div>
            </div>
            <div class="mt-6 hidden min-w-0 flex-1 sm:block md:hidden">
                <h1 class="truncate text-2xl font-bold text-gray-900">{{ $user.content.name }}</h1>
                <p class="truncate font-bold text-gray-400">{{ $user.content.email }}</p>
            </div>
        </div>
    </div>
    <AvatarUpload v-model="$user.content.avatar" v-model:show="show"/>
</template>

<script setup lang="ts">
import { useUserStaffStore } from '@/store/@staff/UserStaffStore'
import { ref } from 'vue'
import moment from 'moment'
import { DueStatusColor } from '@/helpers/Converter'

import AppButton from '@/components/AppButton.vue'
import AvatarUpload from '@/components/modals/AvatarUpload.vue'
import { UsersIcon, ClockIcon, CheckBadgeIcon } from '@heroicons/vue/24/outline'


const $user = useUserStaffStore()

const profile = {
    name: 'Ricardo Cooper',
    email: 'ricardo.cooper@example.com',
    avatar:
        'https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    fields: [
        ['Phone', '(555) 123-4567'],
        ['Email', 'ricardocooper@example.com'],
        ['Title', 'Senior Front-End Developer'],
        ['Team', 'Product Development'],
        ['Location', 'San Francisco'],
        ['Sits', 'Oasis, 4th floor'],
        ['Salary', '$145,000'],
        ['Birthday', 'June 8, 1990'],
    ],
}
const show = ref(false)

</script>
