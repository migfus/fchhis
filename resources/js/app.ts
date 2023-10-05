import '@/bootstrap';
import '../css/app.css'

import { createApp, markRaw } from 'vue';
import { createPinia } from "pinia";
import router from "@/Router";
import { abilitiesPlugin } from '@casl/vue';
import ability from './Ability';
import type { Router } from 'vue-router';
import 'pinia';
import moment from 'moment'

// moment.locale('en', {
//     relativeTime : {
//         future: "in %s",
//         past:   "%s ago",
//         s:  "s",
//         m:  "1 min",
//         mm: "%d min",
//         h:  "1 h",
//         hh: "%d h",
//         d:  "1d",
//         dd: "%dd",
//         M:  "1 mth",
//         MM: "%d mth",
//         y:  "1 y",
//         yy: "%d y"
//     }
// })

declare module 'pinia' {
    export interface PiniaCustomProperties {
        router: Router;
    }
}

import Notifications from 'notiwind'
import App from "@/App.vue";

const app = createApp(App);
const pinia = createPinia();


pinia.use(({ store }) => {
    store.router = markRaw(router);
});

app.use(Notifications);
app.use(pinia);
app.use(router);
app.use(abilitiesPlugin, ability, {
    useGlobalProperties: true,
});

import JWTInterceptor from "@/helpers/JWTInterceptor";
JWTInterceptor();

app.mount("#app");
