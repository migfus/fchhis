import { reactive } from 'vue';
import { defineStore } from 'pinia'
import axios from 'axios'
import moment from 'moment'
import { notify } from 'notiwind'
import { useRoute, useRouter } from 'vue-router'

type TParams = {
    email: string
    password: string
    confirmPassword: string
}
type TConfig = {
    loading: boolean
    approved?: Date
    errorMessage?: string
}

const title = 'auth/ForgotPassword'
const url = '/api/email/recovery'
export const useForgotPassword = defineStore(title, () => {
    const $route = useRoute()
    const $router = useRouter()

    const params = reactive<TParams>({
        email: '',
        password: '',
        confirmPassword: '',
    })
    const config = reactive<TConfig>({
        loading: false,
        approved: null,
        errorMessage: null
    })

    async function RecoveryAPI() {
        config.loading = true
        try {
            let { data: {data} } = await axios.post(url, params)
            if(data == true) {
                config.approved = moment().toDate()
                // @ts-ignore
                // this.router.push({ name: 'forgot-recovery', params: { code: }})
            }
        }
        catch(err) {
            config.errorMessage = err.response
            notify({
                group: "error",
                title: "Invalid Email",
                text: 'Email does not exists.'
            }, 5000)
        }
        config.loading = false
    }

    async function ConfirmAPI() {
        config.loading = true
        try {
            let { data: {data} } = await axios.post(url, { confirm: true, code: $route.query.code })
            if(!data) {
                // @ts-ignore
                $router.push({ name: 'forgot', params: { message: 'Invalid Code'}})
            }
        }
        catch(err) {
            console.log(err)
        }
        config.loading = false
    }

    async function ChangePasswordAPI() {
        config.loading = true
        try {
            let { data: {data} } = await axios.post(url, { confirmPass: true, code: $route.query.code, ...params })
            if(data) {
                notify({
                    group: "success",
                    title: "Success!",
                    text: 'Password successully updated!'
                }, 5000)
                // @ts-ignore
                $router.push({ name: 'forgot', params: { message: 'Success', email: params.email }})
            }
        }
        catch(err) {
            console.log(err)
        }
        config.loading = false
    }

    function ResetParams() {
        Object.assign(params, {
            email: '',
            password: '',
            confirmPassword: '',
        })
        Object.assign(config, {
            approved: null,
            errorMessage: null
        })
    }

    return {
        params,
        config,

        RecoveryAPI,
        ConfirmAPI,
        ChangePasswordAPI,

        ResetParams
    }
})
