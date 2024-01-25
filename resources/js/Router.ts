import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/store/auth/AuthStore'
import { usePreLoader } from '@/store/system/PreLoader'
import ability from '@/Ability'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    // NOTE PAGES
    {
      path: '/',
      children: [
        {
          path: '',
          name: 'home',
          component: () => import('@/views/home/page.vue'),
          meta: {
            title: 'Home',
          },
        },
        {
          path: 'about',
          name: 'about',
          component: () => import('@/views/about/page.vue'),
          meta: {
            title: 'About',
          },
        },
        {
          path: 'calendar',
          name: 'calendar',
          component: () => import('@/views/calendar/page.vue'),
          meta: {
            title: 'Calendar',
          },
        },
        {
          path: 'faqs',
          name: 'faqs',
          component: () => import('@/views/faqs/page.vue'),
          meta: {
            title: 'FAQs',
          },
        },

        {
          path: 'news',
          children: [
            {
              path: '',
              name: 'news',
              component: () => import('@/views/news/page.vue'),
              meta: {
                title: 'News & Updates',
              },
            },
            {
              path: ':id',
              name: 'post-id',
              component: () => import('@/views/news/[id].vue'),
              meta: {
                title: 'Post',
              },
            },
          ],
        },
      ],
    },

    // NOTE AUTH =================================================================
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/login/page.vue'),
      meta: {
        title: 'Login',
      },
    },
    {
      path: '/forgot',
      children: [
        {
          path: '',
          name: 'forgot',
          component: () => import('@/views/forgot/page.vue'),
          meta: {
            title: 'Forgot Password',
          },
        },
        {
          path: 'fill',
          name: 'forgot-recovery',
          component: () => import('@/views/forgot/fill.vue'),
          meta: {
            title: 'Recovery',
          },
        },
      ],
    },

    // NOTE DASHBOARD
    {
      path: '/dashboard',
      children: [
        {
          path: '',
          name: 'dashboard',
          component: () => import('@/views/dashboard/page.vue'),
          meta: {
            sideBar: true,
            title: 'Dashboard',
            auth: true,
            resource: 'auth',
          },
        },
        {
          path: 'users',
          children: [
            {
              path: 'client',
              name: 'clients',
              component: () =>
                import('@/views/dashboard/users/client/page.vue'),
              meta: {
                sideBar: true,
                title: 'Clients',
                auth: true,
                resource: 'client',
              },
            },
          ],
        },
        {
          path: 'agent',
          name: 'agents',
          component: () => import('@/views/dashboard/users/agent/page.vue'),
          meta: {
            sideBar: true,
            title: 'Agents',
            auth: true,
            resource: 'agent',
          },
        },
        {
          path: ':id',
          name: 'user',
          component: () => import('@/views/individual/UserPage.vue'),
          meta: {
            sideBar: true,
            title: 'User',
            auth: true,
            resource: 'client',
          },
        },

        // NOTE AUTH
        {
          path: 'account-settings',
          name: 'account-settings',
          component: () =>
            import('@/views/dashboard/account-settings/page.vue'),
          meta: {
            sideBar: true,
            title: 'Account Settings',
            auth: true,
            resource: 'auth',
          },
        },
      ],
    },

    // NOTE SPECIAL
    {
      path: '/:pathMatch(.*)*',
      name: 'error',
      component: () => import('@/views/[error].vue'),
      meta: {
        title: 'Page not Found!',
      },
    },
  ],
})

const TITLE = 'FCHHIS'
router.beforeEach(async (to, from, next) => {
  const $load = usePreLoader()
  const $auth = useAuthStore()

  $load.config.loading = true
  $load.config.to = to.name

  $auth.UpdateAbility()

  const canNavigate = to.matched.some((row) => {
    if (row.meta.resource) {
      // @ts-ignore
      return ability.can(row.meta.action || 'index', row.meta.resource)
    }
    return true
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
  if (!canNavigate) {
    next(new Error('Route Disabled (no permission)'))
  }

  next()
})

router.afterEach((to) => {
  const $load = usePreLoader()
  $load.config.loading = false

  document.title = to.meta.title ? `${to.meta.title} | ${TITLE}` : ''
})

export default router
