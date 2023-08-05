<template>
  <div class="bg-white px-4 pt-4 sm:px-6 rounded-xl mb-4 shadow">
    <div class="grid grid-cols-3 gap-x-4">

      <div class="col-span-3 lg:col-span-1 mb-4">
        <TextInputComp v-model="$user.params.search" placeholder="Search"/>
      </div>

      <div class="col-span-3 lg:col-span-1 mb-4">
        <SelectInputComp v-model="$user.params.filter">
          <option value="Name">Name</option>
          <option value="Email">Email</option>
          <option value="Role">Role</option>
        </SelectInputComp>
      </div>

      <div class="col-span-3 lg:col-span-1 mb-4">
        <VueDatePicker v-model="$user.params.dateRange" range model-type="MM/dd/yyyy" date-picker :hide-navigation="['time']" placeholder="Date Range">
        </VueDatePicker>
      </div>

      <div class="flex justify-end col-span-3 mb-4">
        <span class="isolate inline-flex rounded-md shadow-sm">
          <ButtonComp v-if="$user.config.loading" :icon="ArrowPathIcon" injectIconClass="animate-spin" disabled/>
          <ButtonComp v-else-if="!$user.config.open" @click="$user.toggleOpen" :icon="StopIcon">
            Detail View
          </ButtonComp>
          <ButtonComp v-else @click="$user.toggleOpen" :icon="QueueListIcon">
            Summary View
          </ButtonComp>

          <ButtonComp v-if="$user.config.loading" :icon="ArrowPathIcon" injectIconClass="animate-spin" disabled/>
          <ButtonComp v-else :icon="PrinterIcon">
            Report
          </ButtonComp>

          <ButtonComp v-if="$user.config.loading" :icon="ArrowPathIcon" injectIconClass="animate-spin" disabled/>
          <ButtonComp v-else :icon="$user.config.loading ? ArrowPathIcon : PlusIcon">
            Add User
          </ButtonComp>
        </span>
      </div>
    </div>
  </div>
</template>

<script setup lang='ts'>
import { PlusIcon, PrinterIcon, ArrowPathIcon, StopIcon, QueueListIcon } from '@heroicons/vue/20/solid'
import { useUserStore } from '@/store/users/UserStore'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { watch, ref } from 'vue'
import { throttle } from 'lodash'

import ButtonComp from '@/components/form/ButtonComp.vue'
import TextInputComp from '@/components/form/TextInputComp.vue';
import SelectInputComp from '@/components/form/SelectInputComp.vue';

const $user = useUserStore();

watch($user.params, throttle(() => {
  $user.GetAPI()
}, 1000))
</script>
