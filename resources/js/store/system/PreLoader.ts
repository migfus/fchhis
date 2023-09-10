import { defineStore } from 'pinia'
import { reactive } from 'vue'
import type { RouteRecordName } from 'vue-router'

interface configInt {
    loading: boolean
    to: RouteRecordName
}

const title = 'system/PreLoader'
export const usePreLoader = defineStore(title, () => {
    const config = reactive<configInt>({
        loading: false,
        to: 'home'
    });

    return {
        config,
    }
});
