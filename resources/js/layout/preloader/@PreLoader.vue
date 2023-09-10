<template>
    <div>
        <HomePage v-if="$preLoader.config.to == 'home'"/>
        <AboutPage v-if="$preLoader.config.to == 'about'"/>
        <ContactPage v-if="$preLoader.config.to == 'contact'"/>
        <AuthPage v-if="
            $preLoader.config.to == 'login' ||
            $preLoader.config.to == 'forgot' ||
            $preLoader.config.to == 'register'
        "/>
        <CalendarPage v-if="$preLoader.config.to == 'calendar'"/>
        <FAQPage v-if="$preLoader.config.to == 'faqs'"/>
        <DashboardPageLoader v-if="$preLoader.config.to == 'dashboard'" />
    </div>
</template>

<script setup lang="ts">
import { usePreLoader } from '@/store/system/PreLoader'

import HomePage from './HomePageLoader.vue';
import AboutPage from './AboutPageLoader.vue';
import ContactPage from './ContactPageLoader.vue';
import AuthPage from './AuthPageLoader.vue';
import CalendarPage from './CalendarPageLoader.vue';
import FAQPage from './FAQPageLoader.vue';
import DashboardPageLoader from './DashboardPageLoader.vue';

const $preLoader = usePreLoader();
</script>
