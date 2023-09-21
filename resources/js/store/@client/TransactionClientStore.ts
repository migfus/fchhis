import { defineStore } from 'pinia'
import axios from 'axios'
import { useStorage, StorageSerializers } from '@vueuse/core'
import { reactive } from 'vue'
import type { TGConfig, TGQuery, TGPlanDetail, TGPayType } from '../GlobalType'

type IContent = {
    id: number
    or: string
    amount: number
    plan_details: TGPlanDetail
    pay_type: TGPayType
    created_at: Date
    staff: {
        name: string
    }
    agent: {
        name: string
    }
}

const title = '@client/TransactionsStore'
const url = '/api/transaction'
export const useTransactionStore = defineStore(title, () => {
    const CancelToken = axios.CancelToken;
    let cancel;

    const content = useStorage<Array<IContent>>(`${title}/content` , null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TGConfig>({
        loading: false,
    })
    const query = reactive<TGQuery>({
        search: '',
        sort: 'ASC',
    })

    // SECTION API
    function CancelAPI() {
        cancel()
        content.value = null
    }

    async function GetAPI(page = 1) {
        config.loading = true
        try {
            let { data: {data}} = await axios.get(url, {
                cancelToken: new CancelToken(function executor(c) { cancel = c; }),
                params: { ...query, page: page}
            })
            content.value = data
        }
        catch(e) {
            console.log('StatisticStore GetAPI Error', {e})
        }
        config.loading = false
    }

    // SECTION FUNCTIONS
    return {
        content,
        config,
        query,

        GetAPI,
        CancelAPI,
    }
})
