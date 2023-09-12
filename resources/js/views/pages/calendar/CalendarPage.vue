<template>
    <div class="mx-auto max-w-3xl lg:max-w-7xl px-4 sm:px-6 my-4">
        <div class="grid grid-cols-3 gap-4 items-start">

            <div class="bg-white mx-auto max-w-7xl py-4 sm:px-6 px-8 rounded-lg shadow col-span-3 lg:col-span-1 w-full">
                <h2 class="font-semibold">Upcoming Events</h2>
                <ul class="my-4">
                    <li v-for="(row, idx) in $event.content" :key="row.id" class="px-4 py-2 rounded-xl mb-2">
                        <span v-if="moment(row.start).format('YYYYMMDD') >= moment().format('YYYYMMDD')" :class="['']" :style="[`background-color: ${row.backgroundColor}`, `color: ${row.textColor}`]">
                        {{ `${moment(row.start).format('MM/DD/YYYY')} - ${row.title}`}}
                        </span>
                    </li>
                </ul>
            </div>

            <div class="bg-white mx-auto max-w-7xl py-4 sm:px-6 px-8 rounded-lg shadow col-span-3 lg:col-span-2 w-full">
                <FullCalendar ref="fullCalendar" :options='calendarOptions'>
                    <template v-slot:eventContent='arg'>
                        <b class="mx-2 truncate w-full text-ellipsis rounded-xl">{{ arg.event.title }}</b>
                    </template>
                </FullCalendar>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction';
import moment from 'moment'
import { useEventPublicStore } from '@/store/event/EventPublicStore';

const $event = useEventPublicStore();
const fullCalendar = ref(); // ref="fullCalendar"

const calendarOptions = ref({
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    events: [],
    eventsSet: async () => {
        if($event.config.count == 0) {
            $event.params.currentDate = moment(fullCalendar.value.getApi().getDate()).format('YYYY-MM-DD')
            await $event.GetAPI()
            $event.config.count = 3
            calendarOptions.value.events = $event.content
        }
        $event.config.count--;
    },
});

onMounted(async () => {
    await $event.GetAPI()
    calendarOptions.value.events = $event.content
});
onUnmounted(() => {
    $event.CancelAPI()
})
</script>
