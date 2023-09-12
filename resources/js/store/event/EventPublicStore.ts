import { reactive } from 'vue';
import { defineStore } from 'pinia'
import axios from 'axios'
import { useStorage, StorageSerializers } from '@vueuse/core'
import type { TGConfig } from '../GlobalType';

interface paramsInt {
    currentDate: String
}
type TConfig = {
    loading: boolean
    count: number
}
interface contentInt {
    event_category: { name: String }
    title: String
    start: string
    end: String
    display: String
    backgroundColor: String
    textColor: String
    borderColor: String
    eventEnd: Boolean
    eventTime: Boolean
    eventClick: Function
    id: number
}

const title = 'event/EventPublicStore'
const url = '/api/public/event'
export const useEventPublicStore = defineStore(title, () => {
    const CancelToken = axios.CancelToken
    let cancel;

    const countEvent = useStorage<Number>(`${title}/count`, 0, sessionStorage)
    const content = useStorage<Array<contentInt>>('event/EventPublic/content', null, sessionStorage, {serializer: StorageSerializers.object})
    const params = reactive<paramsInt>({
        currentDate: '',
    })
    const config = reactive<TConfig>({
        loading: false,
        count: 0
    })

    async function GetAPI() {
        config.loading = true
        try {
            let { data: { data }} = await axios.get(url, {
                params: params,
                cancelToken: new CancelToken(function executor(c) { cancel = c; })
            })
            content.value = data.map(row => {
                return {
                    title: `${row.event_category.name} - ${row.title}`,
                    start: row.start,
                    end: row.end,
                    display: 'block',
                    backgroundColor: `#${row.event_category.bg_color}`,
                    textColor: `#${row.event_category.text_color}`,
                    borderColor: `#${row.event_category.bg_color}`,
                    eventEnd: true,
                    eventTime: true,
                    eventClick: () => { alert() }
                }
            });
        }
        catch(err) {
            console.log(err)
        }
        config.loading = false
    }

    function CancelAPI() {
        cancel()
        content.value = null
    }

    async function GetCountAPI() {
        try {
            let { data: { count}} = await axios.get(url, { params: { count: 1 }})
            countEvent.value = count
        }
        catch(err) {
            console.log(err)
        }
    }

    return {
        countEvent,
        params,
        config,
        content,

        GetCountAPI,
        CancelAPI,
        GetAPI,
    }
})
