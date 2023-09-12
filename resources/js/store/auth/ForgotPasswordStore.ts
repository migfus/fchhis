import { reactive } from 'vue';
import { defineStore } from 'pinia'
import axios from 'axios'
import moment from 'moment'
import { notify } from 'notiwind'

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
const url = '/api/email/recovery-code'
export const useForgotPassword = defineStore(title, () => {

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

    async function StoreAPI() {
        config.loading = true
        try {
            let { data: {data} } = await axios.post(url, params)
            if(data == true) {
                config.approved = moment().toDate()
                // @ts-ignore
                this.router.push({ name: 'forgot-recovery'})
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
            let { data: {data} } = await axios.post(url, { confirm: true, ...params })
            if(data.status == true) {
                config.approved = moment().toDate()
            }
        }
        catch(err) {
            console.log(err)
        }
        config.loading = false
    }

    function ResetParams() {
        Object.assign(params, {
            loading: false,
            approved: null,
            errorMessage: null
        })
    }

    return {
        params,
        config,

        StoreAPI,
        ConfirmAPI,

        ResetParams
    }
})
