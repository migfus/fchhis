<script setup lang="ts">
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'

import { useEventPublicStore } from '@/store/event/EventPublicStore'
import { useAddressStore } from './store/system/AddressStore'

import NotificationsSection from './components/Notifications.vue'
import TopNavigation from '@/layout/TopNavigation.vue'
import SideNavigation from '@/layout/SideNavigation.vue'

const $route = useRoute()
const $event = useEventPublicStore()
const $address = useAddressStore()

onMounted(() => {
  $event.GetCountAPI()
  $address.GetAPI()
})
</script>

<template>
  <div style="background-color: #f3f4f6">
    <NotificationsSection />
    <SideNavigation v-if="$route.meta.sideBar" />
    <TopNavigation v-else />
  </div>
</template>
