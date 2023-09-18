<template>
    <div>
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">


            <div class="flex flex-1 flex-col text-center">
                <img class="mx-auto h-32 w-32 flex-shrink-0 rounded-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSrdB8rRgA1qgkw0ckcTrhIa0kpV2ILvbMWg&usqp=CAU" alt="" />
                <h3 class="mt-6 text-sm font-medium text-gray-900">{{  $auth.content.auth.name }}</h3>
                <dl class="mt-1 flex flex-grow flex-col justify-between">
                    <dd class="text-sm text-gray-500">{{  $auth.content.auth.email }}</dd>
                    <dd class="mt-3">
                        <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800">{{ $auth.content.auth.roles[0].name}}</span>
                    </dd>
                </dl>
            </div>

            <div>
            <div class="-mt-px flex divide-x divide-gray-200">
                <div class="flex w-0 flex-1">
                    <a :href="`mailto:`" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center rounded-bl-lg border border-transparent py-4 text-sm font-medium text-gray-700 hover:text-gray-500">
                        {{ $auth.content.auth.info.plan_detail }}
                    </a>
                </div>
                <div class="-ml-px flex w-0 flex-1">
                    <a :href="`tel:`" class="relative inline-flex w-0 flex-1 items-center justify-center rounded-br-lg border border-transparent py-4 text-sm font-medium text-gray-700 hover:text-gray-500">
                    Plan
                    </a>
                </div>
            </div>
        </div>

        </div>
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/auth/AuthStore'

const $auth = useAuthStore()
</script>
