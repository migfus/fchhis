import { ref, reactive } from 'vue';
import { defineStore } from 'pinia'
import axios from 'axios'
import { useSessionStorage, useStorage, StorageSerializers } from '@vueuse/core'
import type { TGConfig } from '../GlobalType';

interface paramsInt {
    currentDate: String
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
export const useEventPublicStore = defineStore(title, () => {
    const count = useStorage<Number>(`${title}/count`, 0, sessionStorage)
    const content = useStorage<Array<contentInt>>('event/EventPublic/content', [], sessionStorage, {serializer: StorageSerializers.object})
    const params = reactive<paramsInt>({
        currentDate: '',
    })
    const config = reactive<TGConfig>({
        loading: false
    })

    async function GetAPI() {
        config.loading = true
        try {
            let { data: { data }} = await axios.get('/api/public/event', { params: params })
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

    async function GetCountAPI() {
        try {
            let { data: { count}} = await axios.get('/api/public/event', { params: { count: 1 }})
            count.value = count
        }
        catch(err) {
            console.log(err)
        }
    }

    return {
        count,
        params,
        config,
        content,

        GetCountAPI,
        GetAPI,
    }
})
