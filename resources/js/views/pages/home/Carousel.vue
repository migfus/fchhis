<template>
  <div class="relative bg-primary-950">
    <div class="relative h-80 overflow-hidden bg-primary-600 md:absolute md:left-0 md:h-full md:w-1/3 lg:w-1/2">
      <img class="h-full w-full object-cover bg-primary-500" src="https://images.unsplash.com/photo-1525130413817-d45c1d127c42?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1920&q=60&&sat=-100" alt="" />
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 926 676" aria-hidden="true" class="absolute left-24 -bottom-24 w-[57.875rem] transform-gpu blur-[118px]">
        <path fill="url(#60c3c621-93e0-4a09-a0e6-4c228a0116d8)" fill-opacity=".4" d="m254.325 516.708-90.89 158.331L0 436.427l254.325 80.281 163.691-285.15c1.048 131.759 36.144 345.144 168.149 144.613C751.171 125.508 707.17-93.823 826.603 41.15c95.546 107.978 104.766 294.048 97.432 373.585L685.481 297.694l16.974 360.474-448.13-141.46Z" />
        <defs>
          <linearGradient id="60c3c621-93e0-4a09-a0e6-4c228a0116d8" x1="926.392" x2="-109.635" y1=".176" y2="321.024" gradientUnits="userSpaceOnUse">
            <stop stop-color="#776FFF" />
            <stop offset="1" stop-color="#FF4694" />
          </linearGradient>
        </defs>

      </svg>
    </div>
    <div class="relative mx-auto max-w-7xl py-24 sm:py-32 lg:py-40 lg:px-8">
      <div class="pr-6 pl-6 md:ml-auto md:w-2/3 md:pl-16 lg:w-1/2 lg:pl-24 lg:pr-0 xl:pl-32">
        <p class="mt-2 text-4xl font-bold tracking-tight text-white">We’re making easy</p>
        <p class="mt-6 text-base leading-7 text-gray-300">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et, egestas tempus tellus etiam sed. Quam a scelerisque amet ullamcorper eu enim et fermentum, augue. Aliquet amet volutpat quisque ut interdum tincidunt duis.</p>
        <div class="mt-8">

          <RouterLink :to="{name: 'login'}">
            <ButtonComp
              :icon="HandThumbUpIcon"
              injectClass="ml-0 bg-white/10 text-base font-semibold leading-7 text-white shadow-sm hover:bg-white/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white border-none"
            >
              Sign Up
            </ButtonComp>
          </RouterLink>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang='ts'>
import { useJobPublicStore } from '@/store/job/JobPublicStore';
import { HandThumbUpIcon } from '@heroicons/vue/24/outline'

import ButtonComp from '@/components/form/ButtonComp.vue';

const $job = useJobPublicStore();
</script>
