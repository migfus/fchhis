<script setup lang="ts">
import { NotificationGroup, Notification } from 'notiwind'
import {
  ExclamationCircleIcon,
  CheckCircleIcon,
} from '@heroicons/vue/24/outline'
import { XMarkIcon } from '@heroicons/vue/20/solid'
</script>

<template>
  <NotificationGroup group="error">
    <div
      class="fixed inset-0 flex items-start justify-end p-6 px-4 py-6 pointer-events-none z-50"
    >
      <div class="w-full max-w-sm">
        <Notification
          v-slot="{ notifications, close }"
          enter="transform ease-out duration-300 transition"
          enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
          enter-to="translate-y-0 opacity-100 sm:translate-x-0"
          leave="transition ease-in duration-500"
          leave-from="opacity-100"
          leave-to="opacity-0"
          move="transition duration-500"
          move-delay="delay-300"
        >
          <div
            v-for="(row, idx) in notifications"
            :key="row.id"
            class="flex w-full max-w-sm mx-auto mt-4 overflow-hidden bg-white/80 backdrop-blur-lg rounded-lg shadow-md"
          >
            <div
              class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5"
            >
              <div class="p-4">
                <div class="flex items-start">
                  <div class="flex-shrink-0">
                    <ExclamationCircleIcon
                      class="h-6 w-6 text-red-400"
                      aria-hidden="true"
                    />
                  </div>
                  <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900">
                      {{ row.title }}
                    </p>
                    <p class="mt-1 text-sm text-gray-500" v-html="row.text"></p>
                  </div>
                  <div class="ml-4 flex flex-shrink-0">
                    <button
                      @click="close(row.id)"
                      type="button"
                      class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2"
                    >
                      <span class="sr-only">Close</span>
                      <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Notification>
      </div>
    </div>
  </NotificationGroup>

  <NotificationGroup group="success">
    <div
      class="fixed inset-0 flex items-start justify-end p-6 px-4 py-6 pointer-events-none z-50"
    >
      <div class="w-full max-w-sm">
        <Notification
          v-slot="{ notifications, close }"
          enter="transform ease-out duration-300 transition"
          enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
          enter-to="translate-y-0 opacity-100 sm:translate-x-0"
          leave="transition ease-in duration-500"
          leave-from="opacity-100"
          leave-to="opacity-0"
          move="transition duration-500"
          move-delay="delay-300"
        >
          <div
            v-for="(row, idx) in notifications"
            :key="row.id"
            class="flex w-full max-w-sm mx-auto mt-4 overflow-hidden bg-white/80 backdrop-blur-lg rounded-lg shadow-md"
          >
            <div
              class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5"
            >
              <div class="p-4">
                <div class="flex items-start">
                  <div class="flex-shrink-0">
                    <CheckCircleIcon
                      class="h-6 w-6 text-green-400"
                      aria-hidden="true"
                    />
                  </div>
                  <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900">
                      {{ row.title }}
                    </p>
                    <p class="mt-1 text-sm text-gray-500" v-html="row.text"></p>
                  </div>
                  <div class="ml-4 flex flex-shrink-0">
                    <button
                      @click="close(row.id)"
                      type="button"
                      class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2"
                    >
                      <span class="sr-only">Close</span>
                      <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Notification>
      </div>
    </div>
  </NotificationGroup>
</template>
