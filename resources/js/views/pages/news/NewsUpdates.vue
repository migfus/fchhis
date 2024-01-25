<script setup lang="ts">
import { usePostPublicStore } from '@/store/post/PostPublicStore'
import moment from 'moment'

import DataTransition from '@/components/transitions/DataTransition.vue'

const $postSummary = usePostPublicStore()
</script>

<template>
  <div class="relative bg-gray-50 px-6 pt-16 pb-20 lg:px-8 lg:pt-24 lg:pb-28">
    <div class="absolute inset-0">
      <div class="h-1/3 bg-white sm:h-2/3" />
    </div>
    <div class="relative mx-auto max-w-7xl">
      <div class="text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
          From the News & Updates
        </h2>
        <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa libero
          labore natus atque, ducimus sed.
        </p>
      </div>
      <div
        class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3"
      >
        <DataTransition>
          <div
            v-for="post in $postSummary.content"
            :key="post.title"
            class="flex flex-col overflow-hidden rounded-lg shadow-lg"
          >
            <div class="flex-shrink-0">
              <img class="h-48 w-full object-cover" :src="post.cover" alt="" />
            </div>
            <div class="flex flex-1 flex-col justify-between bg-white p-6">
              <div class="flex-1">
                <p class="text-sm font-medium text-indigo-600">
                  <a href="#" class="hover:underline">{{
                    post.category.name
                  }}</a>
                </p>
                <RouterLink
                  :to="{ name: 'post', params: { id: post.id } }"
                  class="mt-2 block"
                >
                  <p class="text-xl font-semibold text-gray-900">
                    {{ post.title }}
                  </p>
                  <p class="mt-3 text-base text-gray-500">{{ post.content }}</p>
                </RouterLink>
              </div>
              <div class="mt-6 flex items-center">
                <div class="flex-shrink-0">
                  <a :href="`${post.user.id}`">
                    <span class="sr-only">{{ post.user.email }}</span>
                    <img
                      class="h-10 w-10 rounded-full"
                      :src="post.user.avatar"
                      alt=""
                    />
                  </a>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-900">
                    <a href="#" class="hover:underline">{{
                      post.user.email
                    }}</a>
                  </p>
                  <div class="flex space-x-1 text-sm text-gray-500">
                    <time :datetime="post.created_at">{{
                      moment(post.created_at).format('MMM DD, YYYY')
                    }}</time>
                    <span aria-hidden="true">&middot;</span>
                    <!-- <span>{{ post.readingTime }} read</span> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </DataTransition>
      </div>
    </div>
  </div>
</template>
