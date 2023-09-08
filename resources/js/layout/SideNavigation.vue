<template>
  <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-gray-100">
    <body class="h-full">
    ```
  -->
  <div>
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog as="div" class="relative z-40 md:hidden" @close="sidebarOpen = false">
        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
        </TransitionChild>

        <div class="fixed inset-0 z-40 flex">
          <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
            <DialogPanel class="relative flex w-full max-w-xs flex-1 flex-col bg-gray-800 pt-5 pb-4">
              <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                  <button type="button" class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                    <span class="sr-only">Close sidebar</span>
                    <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                  </button>
                </div>
              </TransitionChild>
              <div class="flex flex-shrink-0 items-center px-4">
                <img class="h-8 w-auto" src="http://127.0.0.1:8000/images/logo.png" alt="FCHHIS" />
              </div>
              <div class="mt-5 h-0 flex-1 overflow-y-auto">
                <nav class="space-y-1 px-2">
                  <RouterLink v-for="item in navigation" :key="item.name" :to="{name: item.link}"
                    @click="sidebarOpen = false"
                    :class="[$route.name == item.link ? 'bg-gray-700 text-gray-50' : 'text-gray-300 hover:bg-gray-600 hover:text-gray-50', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']"
                  >
                    <div v-if="item.line" class="relative">
                      <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-white" />
                      </div>
                    </div>
                    <component v-else :is="item.icon"
                      :class="[$route.name == item.link ? 'text-gray-100' : 'text-gray-400 group-hover:text-gray-300', 'mr-4 flex-shrink-0 h-6 w-6']" aria-hidden="true"
                    />
                    {{ item.name }}
                    <div v-if="item.count" :class="[item.count.color, 'relative inline-flex items-center justify-center w-6 h-6 text-xs font-bold rounded-full -top-2 _right-1']">{{ item.count.number }}</div>
                  </RouterLink>
                </nav>
              </div>
            </DialogPanel>
          </TransitionChild>
          <div class="w-14 flex-shrink-0" aria-hidden="true">
            <!-- Dummy element to force sidebar to shrink to fit close icon -->
          </div>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex flex-grow flex-col overflow-y-auto border-gray-200 bg-gray-800 pt-5">
        <RouterLink :to="{name: 'home'}" class="flex flex-shrink-0 items-center px-4">
          <img class="h-8 w-auto" src="http://127.0.0.1:8000/images/logo.png" alt="Your Company" />
          <p class="ml-4 font-semibold text-white">FCHHIS</p>
        </RouterLink>
        <div class="mt-5 flex flex-grow flex-col">
          <nav class="flex-1 space-y-1 px-2 pb-4">
            <RouterLink v-for="item in navigation" :key="item.name" :to="{name:item.link}" :class="[$route.name == item.link ? 'bg-gray-700 text-gray-50' : 'text-gray-300 hover:bg-gray-600 hover:text-gray-50', 'group flex items-center px-2 py-2 text-sm font-medium rounded-md']">

              <div v-if="item.line" class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                  <div class="w-full border-t border-white" />
                </div>
              </div>
              <component v-else :is="item.icon" :class="[$route.name == item.link ? 'text-gray-100' : 'text-gray-400 group-hover:text-gray-300', 'mr-3 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
              {{ item.name }}
              <div v-if="item.count" :class="[item.count.color, 'relative inline-flex items-center justify-center w-6 h-6 text-xs font-bold rounded-full -top-2 _right-1']">{{ item.count.number }}</div>
            </RouterLink>


          </nav>
        </div>
      </div>
    </div>
    <div class="flex flex-1 flex-col md:pl-64">
      <HeaderBanner />
      <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 bg-white shadow">
        <button type="button" class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 md:hidden" @click="sidebarOpen = true">
          <span class="sr-only">Open sidebar</span>
          <Bars3BottomLeftIcon class="h-6 w-6" aria-hidden="true" />
        </button>
        <div class="flex flex-1 justify-between px-4">
          <div class="flex flex-1">
            <form class="flex w-full md:ml-0" action="#" method="GET">
              <label for="search-field" class="sr-only">Search</label>
              <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center">
                  <MagnifyingGlassIcon class="h-5 w-5" aria-hidden="true" />
                </div>
                <input id="search-field" class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:border-transparent focus:placeholder-gray-400 focus:outline-none focus:ring-0 sm:text-sm" placeholder="Search" type="search" name="search" />
              </div>
            </form>
          </div>
          <div class="ml-4 flex items-center md:ml-6">
            <!-- Profile dropdown -->
            <ProfileDropdown />
          </div>
        </div>
      </div>

      <main class="flex-1">
        <BreadCrumbs />
        <div class="py-6">
          <div class="mx-auto max-w-full px-4 sm:px-6 md:px-8">

            <PreLoader v-if="$preLoader.config.loading"/>
            <RouterView v-else></RouterView>



          </div>
        </div>

        <FooterLayout :sideBar="true"/>
      </main>
    </div>


  </div>

</template>

<script setup lang='ts'>
import { useRoute } from 'vue-router'
import { ref } from 'vue'
import {
  Dialog,
  DialogPanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import {
  Bars3BottomLeftIcon,
  BellIcon,
  CalendarIcon,
  FolderIcon,
  HomeIcon,
  InboxIcon,
  UsersIcon,
  XMarkIcon,
  InformationCircleIcon,
  QueueListIcon,
  CheckCircleIcon,
  MegaphoneIcon,
  SquaresPlusIcon,
  WindowIcon
} from '@heroicons/vue/24/outline'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { usePreLoader } from '@/store/system/PreLoader'
import { useEventPublicStore } from '@/store/event/EventPublicStore';

import BreadCrumbs from '@/layout/BreadCrumbs.vue';
import HeaderBanner from '@/layout/HeaderBanner.vue';
import PreLoader from '@/layout/preloader/@PreLoader.vue';
import ProfileDropdown from './ProfileDropdown.vue'
import FooterLayout from './Footer.vue'

const $preLoader = usePreLoader();
const $route = useRoute();
const $event = useEventPublicStore();

const navigation = [
  {
    name: 'Dashboard',
    link: 'dashboard',
    icon: WindowIcon,
    count: null,
  },
  {
    name: 'Account Settings',
    link: 'account-settings',
    icon: SquaresPlusIcon,
    count: null,
  },
  // {
  //   name: 'Documents',
  //   link: 'documents',
  //   icon: FolderIcon,
  //   count: null
  // },
  // {
  //   name: 'Users',
  //   link: 'users',
  //   icon: UsersIcon,
  //   count: null
  // },

  {
    name: 'Pages',
    line: true,
    count: null
  },
  {
    name: 'Home',
    link: 'home',
    icon: HomeIcon,
    count: null
  },
  {
    name: 'About',
    link: 'about',
    icon: InformationCircleIcon,
    count: null
  },
  {
    name: 'Calendar',
    link: 'calendar',
    icon: CalendarIcon,
    count: {
      number: $event.eventCount,
      color: 'text-black bg-gradient-to-r from-primary-500 to-amber-200'
    }
  },
  {
    name: 'FAQs',
    link: 'faqs',
    icon: CheckCircleIcon,
    count: null,
  },
  {
    name: 'News & Update',
    link: 'news',
    icon: MegaphoneIcon,
    count: null,
  },
]

const userNavigation = [
  { name: 'Your Profile', href: '#' },
  { name: 'Settings', href: '#' },
  { name: 'Sign out', href: '#' },
]

const sidebarOpen = ref(false);
</script>
