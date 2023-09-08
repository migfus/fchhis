import { ref, reactive, toRaw } from "vue";
import { defineStore } from "pinia";
import axios from "axios";
import { $Err, $DebugInfo } from '@/helpers/Debug'
import { notify } from 'notiwind'
import { useStorage, StorageSerializers } from '@vueuse/core'
import ability from '@/Ability';

interface contentInt {
  auth: {
    id: number,
    avatar: string,
    email: string,
    created_at: string,
    roles: Array<{
      name: string
    }>
    person: {
      addres: string,
      address_id: number,
      birth_day: string,
      birth_place_id: number,
      blood_type_id: number,
      civil_status_id: number,
      created_at: string,
      ext_name: string,
      last_name: string,
      first_name: string,
      mid_name: string,
      gsis_id: string,
      height: number,
      id: number,
      pagibig_id: string,
      sex: boolean,
      tin_id: string,
      weight: string,
    },
  },
  ip: string,
  permissions: Array<string>,
  token: string,
}
interface configInt {
  loading: boolean;
  status: string;
  confirm: string;
}
interface InputInt {
  email: string;
  password: string;
}

export const useAuthStore = defineStore("auth/AuthStore", () => {
  $DebugInfo('AuthStore');

  const _token = useStorage<String>('auth/AuthStore/token', null, localStorage);
  const _content = useStorage<contentInt>('auth/AuthStore/content', null, localStorage, {serializer: StorageSerializers.object});

  const token = ref(toRaw(_token));
  const content = ref(toRaw(_content));
  const config = reactive<configInt>({
    loading: false,
    status: '',
    confirm: '',
  })

  // SECTION API
  async function LoginAPI(input: InputInt) {
    config.loading = true
    try{
      let { data: { data }} = await axios.post('/api/login', input)
      UpdateData(data)
      _token.value = data.token
      token.value = data.token

      //@ts-ignore
      this.router.push({ name: 'dashboard'})
    }
    catch(e) {
      if(e.response.data.message != 'Invalid Input') {
        notify({
          group: "error",
          title: "Invalid Credentials",
          text: 'Mistyped? Please try again.'
        }, 5000)
      }
    }
    config.loading = false
  }

  async function RecoveryAPI(input: InputInt) {
    config.loading = true
    try {
      let { data: { data }} = await axios.post('/api/recovery', input)
      config.status = data
    }
    catch(e) {
      $Err('RecoveryAPI Error', '')
    }
    config.loading = false
  }

  async function ConfirmRecoveryAPI(input: InputInt) {
    try {
      let { data: { data }} = await axios.post('/api/recovery-confirm', input)
      config.confirm = data
    }
    catch(e) {
      $Err('ConfirmRecoveryAPI Error', '')
    }
  }

  async function ChangePasswordAPI(input: InputInt) {
    try {
      let { data: { data }} = await axios.post('/api/change-password-recovery', input)
      if(data) {
        //@ts-ignore
        this.router.push({name: 'login'})
      }
    }
    catch(e) {
      $Err('ChangePasswordAPI Error', '')
    }
  }

  // SECTION FUNC
  function Logout() {
    content.value = null
    localStorage.removeItem('auth')
    //@ts-ignore
    this.router.push({ name: 'login'})
  }

  function UpdateData(data:any) {
    content.value = data
    _content.value = data
  }

  function UpdateAbility() {
    if(content.value) {
      ability.update([
        ...content.value.permissions.map((str) => {
          return {
            action: str.split(' ')[0],
            subject: str.split(' ')[1],
          }
        })
      ])
    }
    else {
      ability.update([
        {
          action: 'show',
          subject: 'login',
        }
      ])
    }
  }

  return {
    content,
    config,
    token,

    ConfirmRecoveryAPI,
    ChangePasswordAPI,
    LoginAPI,
    RecoveryAPI,
    Logout,
    UpdateData,
    UpdateAbility,
  }
});
