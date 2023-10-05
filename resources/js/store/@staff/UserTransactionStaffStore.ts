import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive, ref } from 'vue'
import type { TGPayType, TGQuery, TGPlanDetail } from '@/store/GlobalType'
import { useRoute } from 'vue-router'
import { useUserStaffStore } from './UserStaffStore'
import { PlanToAmount } from '@/helpers/Converter'
import { notify } from 'notiwind'

type TConfig = {
    loading: boolean
    form?: 'add' | 'edit'
}

type TParams = {
    id: number
    or: string
    amount: number
    plan_detail_id: number | bigint
    pay_type_id: number | bigint
}

const title = '@staff/UserTransactionStaffStore'
const url = '/api/transaction'
export const useUserTransactionStaffStore = defineStore(title, () => {
    const $user = useUserStaffStore()
    const $route = useRoute()
    const CancelToken = axios.CancelToken;
    let cancel;

    const content = useStorage(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TConfig>({
        loading: false,
        form: null
    })
    const query = reactive<TGQuery>({
        search: '',
        filter: 'name',
        sort: 'DESC'
    })
    const params = reactive<TParams>(InitParams())
    const dueAt = ref(null)

    // SECTION API
    function CancelAPI() {
        cancel()
        content.value = null
    }

    async function GetAPI() {
        config.loading = true
        try {
            let { data } = await axios.get(`${url}/${$route.params.id}`, {
                cancelToken: new CancelToken(function executor(c) { cancel = c; }),
                params: query
            })
            content.value = data.data
            dueAt.value = data.due_at
        }
        catch(e) {
            console.log(`${title} GetAPI Error`, {e})
        }
        config.loading = false
    }

    async function PostAPI() {
        try {
            let { data: { data }} = await axios.post(`${url}`, { ...params, client_id: $route.params.id, agent_id: $user.content.info.agent_id })

            if(data === true) {
                notify({
                    group: "success",
                    title: "Success",
                    text: 'New transaction has been added'
                }, 5000)
            }

            ChangeForm()
            GetAPI()
        }
        catch(e) {
            console.log(`${title} PostAPI Error`, {e})
        }
    }

    async function UpdateAPI() {
        try {
            let { data: { data }} = await axios.put(
                `${url}/${params.id}`,
                { ...params, client_id: $route.params.id, agent_id: $user.content.info.agent_id }
            )

            if(data === true) {
                notify({
                    group: "success",
                    title: "Success",
                    text: 'The transaction has been updated'
                }, 5000)
            }

            ChangeForm()
            GetAPI()
        }
        catch(e) {
            console.log(`${title} PostAPI Error`, {e})
        }
    }

    async function DestroyAPI() {
        try {
            let { data: { data }} = await axios.delete(`${url}/${params.id}`)

            if(data === true) {
                notify({
                    group: "success",
                    title: "Success",
                    text: 'The transaction has been removed'
                }, 5000)
            }

            ChangeForm()
            GetAPI()
        }
        catch(e) {
            console.log(`${title} PostAPI Error`, {e})
        }
    }

    function ChangeForm(form = null) {
        if(form == null) {
            Object.assign(params, InitParams())
        }
        config.form = form
    }

    function InitParams() {
        console.log
        return {
            id: null,
            or: null,
            amount: PlanToAmount($user.content.info.pay_type, $user.content.info.plan_detail),
            plan_detail_id: $user.content.info.plan_detail_id,
            pay_type_id: $user.content.info.pay_type_id
        }
    }

    function ScrollUp() {
        window.scrollTo({ top: 400, behavior: 'smooth' });
    }

    function Update(row) {
        Object.assign(params, {
            id: row.id,
            or: row.or,
            amount: row.amount,
            plan_detail_id: row.plan_detail_id,
            pay_type_id: row.pay_type_id
        })
        ScrollUp()
        config.form = 'edit'
    }

    return {
        content,
        config,
        query,
        params,
        dueAt,

        GetAPI,
        CancelAPI,
        PostAPI,
        UpdateAPI,
        DestroyAPI,

        Update,
        ChangeForm,
    }
})
