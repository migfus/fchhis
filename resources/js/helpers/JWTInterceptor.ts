import axios from 'axios'
import { useAuthStore } from '@/store/auth/AuthStore'
import { notify } from 'notiwind'

export default function JWTInterceptor() {
  const $auth = useAuthStore()

  axios.interceptors.request.use((config) => {
    if ($auth.token) config.headers.Authorization = `Bearer ${$auth.token}`

    return config
  })

  axios.interceptors.response.use(
    (response) => {
      if (response.data.auth) {
        $auth.UpdateData(response.data.auth)
      }
      return response
    },
    (error) => {
      if (axios.isCancel(error)) {
        console.log('Interceptor', 'Cancelled')
        return true
      } else {
        const { status } = error.response
        const { data } = error.response
        if (status === 401 && data.message == 'Logout') $auth.Logout()
        if (status === 401 && data.message == 'Unauthenticated.') $auth.Logout()
        if (status === 401 && data.message == 'Invalid Input') {
          let content = ''
          Object.entries(data.errors).forEach((element) => {
            content += `<div><span class="font-semibold">${element[0]}</span>: ${element[1]}</div>`
          })

          notify(
            {
              group: 'error',
              title: 'Invalid Input',
              text: content,
            },
            5000,
          )
        }
        if (status === 429) {
          notify(
            {
              group: 'error',
              title: 'Server Error!',
              text: 'Too Many Requests! Please try again later.',
            },
            5000,
          )
        }
      }

      return Promise.reject(error)
    },
  )
}
