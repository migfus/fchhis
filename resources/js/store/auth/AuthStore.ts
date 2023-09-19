import { ref, reactive, toRaw } from "vue";
import { defineStore } from "pinia";
import axios from "axios";
import { notify } from 'notiwind'
import { useStorage, StorageSerializers } from '@vueuse/core'
import ability from '@/Ability';
import type { TGAuthContent, TGConfig } from "../GlobalType";

interface TContent {
    auth: TGAuthContent
    permissions: Array<string>,
    token: string,
}
interface TInput {
    email: string;
    password: string;
}

type TChangePassword = {
    currentPassword: string
    newPassword: string
    confirmPassword: string
}

export const useAuthStore = defineStore("auth/AuthStore", () => {
    const _token = useStorage<String>('auth/AuthStore/token', null, localStorage);
    const _content = useStorage<TContent>('auth/AuthStore/content', null, localStorage, {serializer: StorageSerializers.object});

    const token = ref(toRaw(_token));
    const content = ref(toRaw(_content));
    const config = reactive<TGConfig>({
        loading: false,
    })
    const changePassword = reactive<TChangePassword>({
        currentPassword: '',
        newPassword: '',
        confirmPassword: ''
    })
    const errors = ref(null)

    // SECTION API
    async function LoginAPI(input: TInput) {
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

    async function ChangePasswordAPI() {
        try {
            let { data: { data }} = await axios.post('/api/auth/change-password', changePassword)
            if(data) {
                Object.assign(changePassword, {
                    currentPassword: '',
                    newPassword: '',
                    confirmPassword: ''
                })
                notify({
                    group: "success",
                    title: "Success",
                    text: 'Successfuly Updated'
                }, 5000)
                //@ts-ignore
                this.router.push({name: 'dashboard'})
            }
        }
        catch(e) {
            notify({
                group: "error",
                title: "Incorrect Password",
                text: 'Please retype again.'
            }, 5000)
            errors.value = e.response.data.errors
            console.log('ChangePasswordAPI Error', {e})
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
            ability.update([{
                action: 'show',
                subject: 'login',
            }])
        }
    }

    return {
        content,
        config,
        token,
        changePassword,
        errors,

        ChangePasswordAPI,
        LoginAPI,
        Logout,
        UpdateData,
        UpdateAbility,
    }
});
