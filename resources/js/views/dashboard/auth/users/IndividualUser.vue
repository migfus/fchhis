<template>
  <li>
    <div :to="`/users/${data.id}`" class="block ">
      <div @click="data.open = !data.open" class="flex items-center px-4 py-4 sm:px-6 cursor-pointer hover:bg-gray-50">

        <div class="flex min-w-0 flex-1 items-center">

          <!-- NOTE ROW 1 -->
          <div class="flex-shrink-0">
            <img class="h-12 w-12 rounded-full" :src="data.avatar" alt="" />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:gap-4 px-4 justify-between">
            <div>
              <p class="truncate text-sm font-medium text-primary-600">{{ convertName(data.person) }}</p>
              <p class="mt-2 flex items-center text-sm text-gray-500 truncate">{{ data.roles[0].name }}</p>
            </div>

            <!-- NOTE ROW 2 -->
            <div class="hidden md:block">
              <p class="truncate text-sm font-medium text-gray-500">{{ data.email }}</p>
              <p class="truncate mt-2 flex items-center text-sm text-gray-500">{{ data.person.civil_status.name }}</p>
            </div>

            <!-- NOTE ROW 3 -->
            <div class="hidden lg:block">
              <p class="truncate flex text-sm font-medium text-gray-500 items-center">
                <CalendarIcon class="mr-2 h-5 w-5 flex-shrink-0 inline" aria-hidden="true" />
                <span class="inline">{{ moment(data.person.birth_day).format('MMM DD, YYYY') }}</span>
              </p>
              <p class="mt-2 flex items-center text-sm text-gray-500 truncate">{{ sexIDToText(data.person.sex) }}</p>
            </div>

            <!-- NOTE ROW 4 -->
            <div class="hidden lg:block">
              <p class="truncate text-sm font-medium text-gray-500">{{ moment(data.created_at).format('MMM DD, YYYY') }}</p>
              <p class="mt-2 flex items-center text-sm text-gray-500 truncate">{{ data.person.address }} {{ addressIDToFull(data.person.address_id) }}</p>
            </div>
          </div>

        </div>

        <div class="">
          <ChevronUpIcon v-if="data.open" class="h-5 w-5 text-gray-400" aria-hidden="true" />
          <ChevronRightIcon v-else class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </div>

      </div>





      <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">

        <div v-if="data.open" class="flex items-end px-4 py-4 sm:px-6 ">

          <div class="flex flex-1 items-center">
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 px-4 justify-between">
              <!-- NOTE ROW 1 -->
              <div class="hidden lg:block">
                <p class="truncate text-sm font-medium text-gray-500">TIN: {{ data.person.tin_id }}</p>
                <p class="truncate text-sm font-medium text-gray-500">PAG-IBIG: {{ data.person.pagibig_id }}</p>
                <p class="truncate text-sm font-medium text-gray-500">GSIS: {{ data.person.gsis_id }}</p>
              </div>

              <!-- NOTE ROW 2 -->
              <div class="hidden lg:block">
                <p class="truncate text-sm font-medium text-gray-500">W/H: {{ data.person.weight }} KL / {{  data.person.height }} M</p>
                <p class="truncate text-sm font-medium text-gray-500">Blood Type: {{ data.person.blood_type.name }}</p>
                <p class="truncate text-sm font-medium text-gray-500">Created: {{ moment(data.created_at).fromNow(true) }}</p>
              </div>

            </div>
          </div>

          <div>
            <RouterLink :to="`/user/${data.id}`">
              <ButtonComp :icon="InformationCircleIcon">Details</ButtonComp>
            </RouterLink>
            <ButtonComp :icon="PencilSquareIcon">Edit</ButtonComp>
            <ButtonComp v-if="data.id != $auth.content.auth.id" @click="$user.config.deleteID = data.id" :icon="XMarkIcon" injectClass="bg-red-400 hover:bg-red-500 text-red-50">Remove</ButtonComp>
          </div>

        </div>
      </transition>




    </div>



  </li>
</template>

<script setup lang="ts">
import { toRefs, ref } from 'vue'
import moment from 'moment'
import { convertName } from '@/helpers/Converter'
import { XMarkIcon, ChevronRightIcon, ChevronUpIcon, PencilSquareIcon, CalendarIcon, InformationCircleIcon } from '@heroicons/vue/20/solid'
import { sexIDToText, addressIDToFull } from '@/helpers/Converter'
import { useAuthStore } from '@/store/auth/AuthStore'
import { useUserStore } from '@/store/users/UserStore'

import ButtonComp from '@/components/form/ButtonComp.vue'

const $auth = useAuthStore();
const $user = useUserStore();
const $props = defineProps<{
  data?: {
    open: boolean
    id: number
    email: string
    avatar: string
    person: {
      last_name: string
      first_name: string
      mid_name: string
      ext_name: string
      birth_day: string
      sex: boolean
      address: string
      address_id: number
      height: number
      weight: number
      civil_status: {
        name: string
      }
      blood_type: {
        name: string
      }
      tin_id: string
      gsis_id: string
      pagibig_id: string
    }
    roles: Array<{
      name: string
    }>
    created_at: string
  }
}>()
const { data } = toRefs($props)
</script>
