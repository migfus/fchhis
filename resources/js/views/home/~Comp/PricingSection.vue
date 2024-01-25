<template>
    <div class="bg-zinc-50">
        <div class="mx-auto max-w-7xl py-24 px-6 lg:px-8">
            <div class="sm:align-center sm:flex sm:flex-col">
                <h1 class="text-5xl font-bold tracking-tight text-gray-900 sm:text-center">Pricing Plans</h1>
                <p class="mt-5 text-xl text-gray-500 sm:text-center">Start building for free, then add a site plan to go live. Account plans unlock additional features.</p>
                <div class="relative mt-6 flex self-center rounded-lg bg-gray-100 p-0.5 sm:mt-8">
                    <button type="button" class="relative w-1/2 whitespace-nowrap rounded-md border-gray-200 bg-white py-2 text-sm font-medium text-gray-900 shadow-sm focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:w-auto sm:px-8">Monthly</button>
                    <button type="button" class="relative ml-0.5 w-1/2 whitespace-nowrap rounded-md border border-transparent py-2 text-sm font-medium text-gray-700 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:w-auto sm:px-8">Quarterly</button>
                    <button type="button" class="relative ml-0.5 w-1/2 whitespace-nowrap rounded-md border border-transparent py-2 text-sm font-medium text-gray-700 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:w-auto sm:px-8">Semi-Annual</button>
                    <button type="button" class="relative ml-0.5 w-1/2 whitespace-nowrap rounded-md border border-transparent py-2 text-sm font-medium text-gray-700 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:w-auto sm:px-8">Yearly</button>
                </div>
            </div>
            <div class="mt-12 space-y-4 sm:mt-16 sm:grid sm:grid-cols-2 sm:gap-6 sm:space-y-0 lg:mx-auto lg:max-w-4xl xl:mx-0 xl:max-w-none xl:grid-cols-4">
                <div v-for="tier in tiers" :key="tier.name" class="divide-y divide-gray-200 rounded-lg border border-gray-200 shadow-sm bg-white">
                    <div class="p-6">
                        <h2 class="text-lg font-medium leading-6 text-primary-900">{{ tier.name }}</h2>
                        <p class="mt-4 text-sm text-gray-500">{{ tier.description }}</p>
                        <p class="mt-8">
                            <span class="text-4xl font-bold tracking-tight text-gray-900">{{ tier.priceMonthly }} ₱</span>
                            {{ ' ' }}
                            <span class="text-base font-medium text-gray-500">/mo</span>
                        </p>
                        <a :href="tier.href" class="mt-8 block w-full rounded-md border border-primary-800 bg-primary-800 py-2 text-center text-sm font-semibold text-white hover:bg-primary-900">{{ tier.name }}</a>
                    </div>
                    <div class="px-6 pt-6 pb-8">
                        <h3 class="text-sm font-medium text-gray-900">What's included</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li v-for="feature in tier.includedFeatures" :key="feature" class="flex space-x-3">
                                <CheckIcon class="h-5 w-5 flex-shrink-0 text-green-500" aria-hidden="true" />
                                <span class="text-sm text-gray-500">{{ feature }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { CheckIcon } from '@heroicons/vue/20/solid'

interface tiersInt {
    name: string
    href: string
    priceMonthly: number
    description: string
    includedFeatures: Array<string>
}

const tiers: Array<tiersInt> = [
    {
        name: 'Jasper',
        href: '#',
        priceMonthly: 450,
        description: 'All the basics for starting a new business',
        includedFeatures: ['Potenti felis, in cras at at ligula nunc.', 'Orci neque eget pellentesque.'],
    },
    {
        name: 'Jade',
        href: '#',
        priceMonthly: 495,
        description: 'All the basics for starting a new business',
        includedFeatures: [
            'Potenti felis, in cras at at ligula nunc. ',
            'Orci neque eget pellentesque.',
            'Donec mauris sit in eu tincidunt etiam.',
        ],
    },
    {
        name: 'Beryl',
        href: '#',
        priceMonthly: 650,
        description: 'All the basics for starting a new business',
        includedFeatures: [
            'Potenti felis, in cras at at ligula nunc. ',
            'Orci neque eget pellentesque.',
            'Donec mauris sit in eu tincidunt etiam.',
            'Faucibus volutpat magna.',
        ],
    },
    {
        name: 'Onyx',
        href: '#',
        priceMonthly: 1300,
        description: 'All the basics for starting a new business',
        includedFeatures: [
            'Potenti felis, in cras at at ligula nunc. ',
            'Orci neque eget pellentesque.',
            'Donec mauris sit in eu tincidunt etiam.',
            'Faucibus volutpat magna.',
            'Id sed tellus in varius quisque.',
            'Risus egestas faucibus.',
            'Risus cursus ullamcorper.',
        ],
    },
];
</script>
