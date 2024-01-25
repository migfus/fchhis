import { defineAbility } from '@casl/ability'
import { useStorage, StorageSerializers } from '@vueuse/core'
import { toRaw } from 'vue'

interface authInt {
  auth: {
    id: number
    avatar: string
    created_at: string
    email: string
    person: {
      id: number
      last_name: string
      first_name: string
      mid_name: string
      ext_name: string
    }
    roles: Array<{
      name: string
    }>
  }
  ip: string
  permissions: Array<string>
  token: string
}

export default defineAbility((can, cannot) => {
  const auth = toRaw(
    useStorage<authInt>('auth/AuthStore/content', null, localStorage, {
      serializer: StorageSerializers.object,
    }),
  )
  const token = toRaw(
    useStorage<string>('auth/AuthStore/token', null, localStorage),
  )

  if (token.value && auth.value) {
    auth.value.permissions.map((str: string) => {
      can(str.split(' ')[0], str.split(' ')[1])
      return {
        str,
      }
    })
  } else {
    can('show', 'login')
  }
})
