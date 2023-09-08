<template>

  <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
    <HeaderBanner />
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button -->
          <DisclosureButton class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500">
            <span class="sr-only">Open main menu</span>
            <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
          <img class="block h-10 w-auto lg:hidden" src="http://127.0.0.1:8000/images/logo.png" alt="Future Care Helping Hands" />
        </div>
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <img class="hidden h-10 w-auto sm:block sm:ml-5" src="http://127.0.0.1:8000/images/logo.png" alt="Future Care Helping Hands" />
            <!-- <object class="block h-10 w-auto lg:hidden" data="/images/logo.svg" alt="Your Company" /> -->
            <span class="ml-3 font-semibold lg:block hidden xs:block">FCHHIS</span>
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">

            <RouterLink :to="{ name: 'home'}" :class="[$route.name == 'home' ?
              'border-primary-700 text-gray-900' :
              'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
              'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium'
              ]"
            >
              Home
            </RouterLink>

            <RouterLink :to="{ name: 'about'}" :class="[$route.name == 'about' ?
              'border-primary-700 text-gray-900' :
              'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
              'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium'
              ]"
            >
              About
            </RouterLink>

            <RouterLink :to="{ name: 'calendar'}" :class="[$route.name == 'calendar' ?
              'border-primary-700 text-gray-900' :
              'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
              'lg:inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium hidden'
              ]"
            >
              Calendar
              <div class="relative inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-black bg-gradient-to-r from-primary-500 to-secondary-200 rounded-full -top-2 right-1">{{ $event.eventCount }}</div>
            </RouterLink>

            <RouterLink :to="{ name: 'faqs'}" :class="[$route.name == 'faqs' ?
              'border-primary-700 text-gray-900' :
              'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
              'hidden lg:inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium'
              ]"
            >
              FAQs
            </RouterLink>

            <RouterLink :to="{ name: 'news'}" :class="[$route.name == 'news' ?
              'border-primary-700 text-gray-900' :
              'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
              'hidden xl:inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium'
              ]"
            >
              News & Updates
            </RouterLink>

            <Popover class="block xl:hidden relative border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 mt-5" v-slot="{ open }">
              <PopoverButton :class="[
                open ?
                'text-gray-900' :
                'text-gray-500',
                'inline-flex items-center ']"
              >
                <span>More</span>
                <ChevronDownIcon :class="[open ? 'text-gray-600' : 'text-gray-400', 'ml-2 h-5 w-5 group-hover:text-gray-500']" aria-hidden="true" />
                <div class="absolute hidden md:inline-flex lg:hidden items-center justify-center w-6 h-6 text-xs font-bold text-black bg-gradient-to-r from-primary-500 to-amber-200 rounded-full -top-2 -right-3">{{  $event.eventCount }}</div>
              </PopoverButton>

              <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                <PopoverPanel class="absolute left-1/2 z-10 mt-5 w-screen max-w-md -translate-x-1/2 transform">
                  <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="relative grid bg-white gap-4 p-4">

                      <RouterLink :to="{name: 'calendar'}" class="lg:hidden -m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                        <span class="text-base font-medium text-gray-900">Calendar</span>
                        <div class="relative inline-flex items-center justify-center w-7 h-6 text-xs font-bold text-black bg-gradient-to-r from-primary-500 to-amber-200 rounded-full -top-2 right-1">{{ $event.eventCount }}</div>
                      </RouterLink>

                      <RouterLink :to="{name: 'faqs'}" class="lg:hidden -m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                        <span class="text-base font-medium text-gray-900">FAQs</span>
                      </RouterLink>

                      <RouterLink :to="{name: 'news'}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                        <span class="text-base font-medium text-gray-900">News & Updates</span>
                      </RouterLink>
                    </div>
                  </div>
                </PopoverPanel>
              </transition>
            </Popover>
          </div>
        </div>


        <ProfileDropdown />

      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="space-y-1 pt-2 pb-4">

        <RouterLink
            v-for="row in $nav.pages"
            :key="`${row.name}`"
            :to="`${row.link}`"
            @click="open"
            :class="[row.link.name == $route.name ?
              'block border-l-4 border-primary-500 bg-primary-50 py-2 pl-3 pr-4 text-base font-medium text-primary-700' :
              'block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700',
              'flex-nowrap']
            ">
            <DisclosureButton style="width: 100%; text-align: left;">
              {{ row.name }}
              <div v-if="row.link.name == 'calendar'" class="relative inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-black bg-gradient-to-r from-primary-500 to-amber-200 rounded-full -top-2 right-1">20</div>
            </DisclosureButton>

        </RouterLink>
      </div>
    </DisclosurePanel>
  </Disclosure>

  <PreLoader v-if="$preLoader.config.loading"/>
  <RouterView v-else></RouterView>

  <FooterLayout />
</template>

<script setup lang='ts'>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverPanel, PopoverButton } from '@headlessui/vue'
import { Bars3Icon, BellIcon, XMarkIcon, ChevronDownIcon } from '@heroicons/vue/24/outline'
import { useNavigationStore } from '@/store/system/NavigationStore'
import { useRoute } from 'vue-router';
import { useAuthStore } from '@/store/auth/AuthStore'
import { usePreLoader } from '@/store/system/PreLoader';
import { useEventPublicStore } from '@/store/event/EventPublicStore';

import HeaderBanner from '@/layout/HeaderBanner.vue';
import PreLoader from '@/layout/preloader/@PreLoader.vue';
import ProfileDropdown from './ProfileDropdown.vue';
import FooterLayout from './Footer.vue'

const $nav = useNavigationStore();
const $route = useRoute();
const $preLoader = usePreLoader();
const $event = useEventPublicStore();
</script>
