<template>
    <nav class="flex shadow bg-white" aria-label="Breadcrumb">
        <ol role="list" class="mx-auto flex w-full max-w-full space-x-4 px-4 sm:px-6 lg:px-8">
            <li class="flex">
                <div class="flex items-center">
                <RouterLink :to="{ name: 'dashboard'}" class="text-gray-400 hover:text-gray-500">
                    <WindowIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true" />
                    <span class="sr-only">Home</span>
                </RouterLink>
                </div>
            </li>
            <li class="flex">
                <div class="flex items-center">
                    <svg class="h-full w-6 flex-shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                    </svg>
                    <RouterLink v-if="$route.name != 'dashboard'" :to="{name: $route.name}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <!-- {{ $route.name.toString().charAt(0).toUpperCase() + $route.name.toString().slice(1) }} -->
                        {{ $route.meta.title }}
                    </RouterLink>
                </div>
            </li>
        </ol>
    </nav>
</template>

<script setup lang="ts">
import { WindowIcon } from '@heroicons/vue/20/solid'
import { useRoute } from 'vue-router'

const $route = useRoute();
</script>
