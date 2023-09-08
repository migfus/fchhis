<template>
  <footer class="bg-white" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div :class="[$props.sideBar ? 'max-w-full' : 'max-w-7xl ', 'mx-auto px-6 pb-8 pt-4 sm:pt-24 lg:px-8 lg:pt-32']">
      <div class="xl:grid xl:grid-cols-3 xl:gap-8">
        <div class="space-y-6">
          <img class="h-48" src="http://127.0.0.1:8000/images/logo.png" alt="Company name" />
          <p class="text-sm leading-6 text-gray-600 mt-0 font-bold">2nd Floor, Facoma Building, P-12 Poblacion, Valencia City, Bukidnon</p>
          <p class="text-sm leading-6 text-gray-600 mt-0" style="margin-top: 0px">Email: <a href="mailto:contact@fchhis.com" class="font-bold">contact@fchhis.com</a></p>
          <p class="text-sm leading-6 text-gray-600 mt-0" style="margin-top: 0px">Contact: <a class="font-bold">0916-859-8192</a></p>
          <div class="flex space-x-6">
            <a v-for="item in $nav.social" :key="item.name" :href="item.href" class="text-gray-400 hover:text-gray-500">
              <span class="sr-only">{{ item.name }}</span>
              <component :is="item.icon" class="h-8 w-8" aria-hidden="true" />
            </a>
          </div>
        </div>
        <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
          <div class="md:grid md:grid-cols-2 md:gap-8">
            <div>
              <h3 class="text-sm font-semibold leading-6 text-gray-900">Pages</h3>
              <ul role="list" class="mt-6 space-y-4">
                <li v-for="item in navigation.pages" :key="`${item.name}`">
                  <RouterLink :to="`${item.link}`" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</RouterLink>
                </li>
              </ul>
            </div>
            <div class="mt-10 md:mt-0">
              <h3 class="text-sm font-semibold leading-6 text-gray-900">FAQs</h3>
              <ul role="list" class="mt-6 space-y-4">
                <li v-for="item in $nav.faqs" :key="`${item.name}`">
                  <RouterLink :to="`${item.link}`" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</RouterLink>
                </li>
              </ul>
            </div>
          </div>
          <div class="md:grid md:grid-cols-2 md:gap-8">
            <div>
              <h3 class="text-sm font-semibold leading-6 text-gray-900">Posts</h3>
              <ul role="list" class="mt-6 space-y-4">
                <li v-for="item in $nav.posts" :key="`${item.name}`">
                  <RouterLink :to="`${item.link}`" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</RouterLink>
                </li>
              </ul>
            </div>
            <div class="mt-10 md:mt-0">
              <h3 class="text-sm font-semibold leading-6 text-gray-900">Legal</h3>
              <ul role="list" class="mt-6 space-y-4">
                <li v-for="item in navigation.legal" :key="item.name">
                  <a :href="item.href" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-24">
        <p class="text-xs leading-5 text-gray-500">&copy; 2023 Future Care and Helping Hands.</p>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { useNavigationStore } from '@/store/system/NavigationStore';

const $nav = useNavigationStore();
const $props = defineProps({
  sideBar: {
    default: false,
    type: Boolean,
  }
})

const navigation = {
  pages: $nav.pages,
  support: [
    { name: 'Pricing', href: '#' },
    { name: 'Documentation', href: '#' },
    { name: 'Guides', href: '#' },
    { name: 'API Status', href: '#' },
  ],
  company: [
    { name: 'About', href: '#' },
    { name: 'Blog', href: '#' },
    { name: 'Jobs', href: '#' },
    { name: 'Press', href: '#' },
    { name: 'Partners', href: '#' },
  ],
  legal: [
    { name: 'Claim', href: '#' },
    { name: 'Privacy', href: '#' },
    { name: 'Terms', href: '#' },
  ],
};
</script>
