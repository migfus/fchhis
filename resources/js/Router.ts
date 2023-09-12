import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "@/store/auth/AuthStore";
import { usePreLoader } from "@/store/system/PreLoader";
import ability from '@/Ability';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        // NOTE PAGES
        {
            path: "/",
            name: 'home',
            component: () => import('@/views/pages/home/@HomePage.vue'),
            meta: {
                title: 'Home',
            }
        },
        {
            path: "/about",
            name: 'about',
            component: () => import('@/views/pages/about/@AboutPage.vue'),
            meta: {
                title: 'About',
            }
        },
        {
            path: '/calendar',
            name: 'calendar',
            component: () => import('@/views/pages/calendar/CalendarPage.vue'),
            meta: {
                title: 'Calendar'
            }
        },
        {
            path: '/faqs',
            name: 'faqs',
                component: () => import('@/views/pages/faqs/FaqsPage.vue'),
                meta: {
                    title: 'FAQs'
                }
        },
        {
            path: '/news',
            name: 'news',
            component: () => import('@/views/pages/news/NewsUpdates.vue'),
            meta: {
                title: 'News & Updates'
            }
        },
        {
            path: '/news/:id',
            name: 'post',
            component: () => import('@/views/pages/news/PostPage.vue'),
            meta: {
                title: 'Post'
            }
        },

        // NOTE AUTH =================================================================
        {
            path: "/login",
            name: "login",
            component: () => import("@/views/auth/LoginPage.vue"),
            meta: {
                title: "Login",
            },
        },
        {
            path: "/register",
            name: "register",
            component: () => import("@/views/auth/RegisterPage.vue"),
            meta: {
                title: "Register",
            },
        },
        {
            path: "/forgot",
            name: "forgot",
            component: () => import("@/views/auth/ForgotPage.vue"),
            meta: {
                title: "Forgot Password",
            },
        },
        {
            path: "/forgot/fill",
            name: "forgot-recovery",
            component: () => import("@/views/auth/RecoveryPage.vue"),
            meta: {
                title: "Recovery",
            },
        },
        // NOTE DASHBOARD
        {
            path: "/dashboard",
            name: "dashboard",
            component: () => import("@/views/dashboard/DashboardPage.vue"),
            meta: {
                sideBar: true,
                title: "Dashboard",
                auth: true,
                resource: 'auth'
            },
        },

        // NOTE AUTH
        {
            path: "/account-settings",
            name: "account-settings",
            component: () => import("@/views/account-settings/AccountSettingsPage.vue"),
            meta: {
                sideBar: true,
                title: "Account Settings",
                auth: true,
                resource: 'auth'
            },
        },


        // NOTE SPECIAL
        {
            path: "/:pathMatch(.*)*",
            name: 'error',
            component: () => import("@/views/pages/ErrorPage.vue"),
            meta: {
                title: "Page not Found!",
            },
        },
    ],
});
const TITLE = "FCHHIS";

router.beforeEach(async (to, from, next) => {
    const $load = usePreLoader();
    const $auth = useAuthStore();

    $load.config.loading = true
    $load.config.to = to.name

    $auth.UpdateAbility()

    const canNavigate = to.matched.some(row => {
        if(row.meta.resource) {
            // @ts-ignore
            return ability.can(row.meta.action || 'index', row.meta.resource)
        }
        return true;
    })

  // const $auth = useAuthStore();

  // if ($auth.token == "" && to.name !== "login") {
  //   return { name: "login" };
  // }

  // if(to.meta.auth && $auth.token == '' && to.meta.name != 'login') {
  //   return { name: 'login'};
  //   // return false
  // }

  // if(to.meta.role) {
  //   if($auth.content.auth.role == 2) {

  //   }
  //   else if(to.meta.role != $auth.content.auth.role && to.meta.name != 'error') {
  //     // return { name: 'error'}
  //     return false
  //   }
  // }
    if(!canNavigate) {
        next(new Error('Route Disabled (no permission)'))
    }

    next()
});

router.afterEach((to) => {
    const $load = usePreLoader()
    $load.config.loading = false

    document.title = to.meta.title ? `${to.meta.title} | ${TITLE}` : "";
});

export default router;
