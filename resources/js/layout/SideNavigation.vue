<template>
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
                                <nav class="space-y-1 px-2" @click="sidebarOpen = false">

                                    <!-- SECTION MOBILE NAV -->
                                    <AppSidebarNav linkName="dashboard" :icon="WindowIcon"> Dashboard </AppSidebarNav>
                                    <AppSidebarNav linkName="account-settings" :icon="WindowIcon"> Account Settings </AppSidebarNav>

                                    <h3 class="mb-1 px-3 text-sm font-medium text-gray-100 mt-4" id="projects-headline">Pages</h3>

                                    <AppSidebarNav linkName="home" :icon="HomeIcon"> Home </AppSidebarNav>
                                    <AppSidebarNav linkName="about" :icon="InformationCircleIcon"> About </AppSidebarNav>
                                    <AppSidebarNav linkName="calendar" :icon="CalendarIcon" :span="Number($event.countEvent)"> Calendar </AppSidebarNav>
                                    <AppSidebarNav linkName="faqs" :icon="CheckCircleIcon"> FAQs </AppSidebarNav>
                                    <AppSidebarNav linkName="news" :icon="MegaphoneIcon"> News & Updates </AppSidebarNav>

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
                    <nav class="flex-1 px-2 pb-4">
                        <!-- SECTION DESKTOP NAV -->
                        <AppSidebarNav linkName="dashboard" :icon="WindowIcon" :disabled="!can('dashboard', 'auth')"> Dashboard </AppSidebarNav>
                        <AppSidebarNav linkName="account-settings" :icon="Cog6ToothIcon" :disabled="!can('index', 'auth')"> Account Settings </AppSidebarNav>

                        <h3 class="mb-1 px-3 text-sm font-medium text-gray-100 mt-4" id="projects-headline">Pages</h3>

                        <AppSidebarNav linkName="home" :icon="HomeIcon"> Home </AppSidebarNav>
                        <AppSidebarNav linkName="about" :icon="InformationCircleIcon"> About </AppSidebarNav>
                        <AppSidebarNav linkName="calendar" :icon="CalendarIcon" :span="Number($event.countEvent)"> Calendar </AppSidebarNav>
                        <AppSidebarNav linkName="faqs" :icon="CheckCircleIcon"> FAQs </AppSidebarNav>
                        <AppSidebarNav linkName="news" :icon="MegaphoneIcon"> News & Updates </AppSidebarNav>
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
                    <div class="mx-auto max-w-full sm:px-6 md:px-8">
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
import { ref } from 'vue'
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {
    Bars3BottomLeftIcon,
    CalendarIcon,
    HomeIcon,
    XMarkIcon,
    InformationCircleIcon,
    CheckCircleIcon,
    MegaphoneIcon,
    WindowIcon,
    Cog6ToothIcon
} from '@heroicons/vue/24/outline'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { usePreLoader } from '@/store/system/PreLoader'
import { useEventPublicStore } from '@/store/event/EventPublicStore';
import { useAbility } from '@casl/vue'

import BreadCrumbs from '@/layout/BreadCrumbs.vue'
import HeaderBanner from '@/layout/HeaderBanner.vue'
import PreLoader from '@/layout/preloader/@PreLoader.vue'
import ProfileDropdown from './ProfileDropdown.vue'
import FooterLayout from './Footer.vue'
import AppSidebarNav from '@/components/AppSidebarNav.vue'

const $preLoader = usePreLoader();
const $event = useEventPublicStore();
const { can } =  useAbility();

const sidebarOpen = ref(false);
</script>
