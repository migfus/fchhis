import { reactive } from 'vue'
import { defineStore} from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import type { TGQuery } from '../GlobalType'

interface configInt {
    loading: boolean
    open: boolean
    deleteID: number
}

const title = 'users/UserStore'
const url = '/api/users'
export const useUserStore = defineStore(title, () => {
    const config = reactive<configInt>({
        loading: false,
        open: false,
        deleteID: null,
    })
    const content = useStorage(`${title}/content`, null, sessionStorage, {serializer: StorageSerializers.object})
    const params = reactive<TGQuery>({
        search: '',
        sort: 'ASC',
        start: null,
        end: null,
        filter: 'Name',
    })

    async function GetAPI() {
        config.loading = true
        try {
            let { data: {data}} = await axios.get(url, {params: params})
            // NOTE Insert [open] value for open/close details toggle
            const contentData = data.data
            contentData.map(row => {
                row.open = config.open
                return {
                    ...row,
                }
            })
            content.value = data
            content.value.data = contentData
        }
        catch(err) {
            console.log(err)
        }
        config.loading = false
    }

    async function DestroyAPI() {
        try {
            let { data: {data}} = await axios.delete(`/api/users/${config.deleteID}`)
            console.log(data)
            config.deleteID = null
            GetAPI()
        }
        catch(err) {
            console.log(err)
        }
    }

    const toggleOpen = () => {
        config.open = !config.open
        content.value.data.map(row => row.open = config.open)
    }

    return {
        config,
        content,
        params,

        GetAPI,
        toggleOpen,
        DestroyAPI
    }
});
