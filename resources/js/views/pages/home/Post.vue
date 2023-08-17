<template>
  <!-- <div v-if="$post.content" class="relative px-6 pt-16 pb-20 lg:px-8 lg:pt-24 lg:pb-28" style="background: url('/images/background1.jpg') no-repeat center center; background-size: cover;"> -->
  <div v-if="$post.content" class="relative px-6 pt-16 pb-20 lg:px-8 lg:pt-24 lg:pb-28 bg-neutral-200">
    <div class="absolute inset-0">
      <div class="h-1/3 bg-white/20 sm:h-2/3" />
    </div>
    <div class="relative mx-auto max-w-7xl">
      <div class="text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the news/updates</h2>
        <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa libero labore natus atque, ducimus sed.</p>
      </div>
      <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
        <div v-for="row in $post.content" :key="row.title" class="flex flex-col overflow-hidden rounded-lg shadow-lg backdrop-blur-md">
          <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" :src="row.cover" alt="" />
          </div>
          <div class="flex flex-1 flex-col justify-between bg-white/90 backdrop-blur-lg p-6">
            <div class="flex-1">
              <p class="text-sm font-medium text-primary-600">
                <a :href="`${row.id}`" class="hover:underline">{{ row.category.name }}</a>
              </p>
              <RouterLink :to="{name: 'post', params: {id: row.id}}" href="row.id" class="mt-2 block">
                <p class="text-xl font-semibold text-gray-900">{{ row.title }}</p>
                <p class="mt-3 text-base text-gray-500">{{ row.content }}</p>
              </RouterLink>
            </div>
            <div class="mt-6 flex items-center">
              <div class="flex-shrink-0">
                <a :href="`${row.id}`">
                  <span class="sr-only">{{ row.user.email }}</span>
                  <img class="h-10 w-10 rounded-full" :src="row.user.avatar" alt="" />
                </a>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                  <a :href="`${row.id}`" class="hover:underline">{{ row.user.email }}</a>
                </p>
                <div class="flex space-x-1 text-sm text-gray-500">
                  <time :datetime="row.created_at">{{ moment(row.created_at).format('MMM DD YYYY') }}</time>
                  <span aria-hidden="true">&middot;</span>
                  <span>{{ moment(row.created_at).fromNow(true) }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { usePostPublicStore } from '@/store/post/PostPublicStore';
import moment from 'moment';

const $post = usePostPublicStore();

onMounted(() => {
  $post.params.search = ''
  $post.GetAPI();
});
</script>
