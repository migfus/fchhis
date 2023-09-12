import { reactive } from 'vue';
import { defineStore } from 'pinia'
import axios from 'axios'
import moment from 'moment'

type TParams = {
    email: string
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
        email: ''
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
        }
        config.loading = false
    }

    async function ConfirmAPI() {
        config.loading = true
        try {
            let { data: {data} } = await axios.post(url, params)
            if(data.status == true) {
                config.approved = moment().toDate()
            }
        }
        catch(err) {
            console.log(err)
        }
        config.loading = false
    }

    return {
        params,
        config,

        StoreAPI,
        ConfirmAPI
    }
})
