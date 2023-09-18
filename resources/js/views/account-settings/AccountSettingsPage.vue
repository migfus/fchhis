<template>
    <div class="min-h-full">
        <main class="">
            <!-- Page header -->
            <HeaderAccountSettings />

            <div class="mx-auto mt-8 grid grid-cols-1 gap-6 sm:px-6 lg:grid-flow-col-dense lg:grid-cols-3">
                <ChangePasswordAccountSettings />
                <TimelineAccountSettings />
            </div>
        </main>
    </div>
</template>

<script setup lang="ts">
import HeaderAccountSettings from '@/views/account-settings/cards/HeaderAccountSettings.vue'
import ChangePasswordAccountSettings from './cards/ChangePasswordAccountSettings.vue'
import TimelineAccountSettings from './cards/TimelineAccountSettings.vue'
</script>
