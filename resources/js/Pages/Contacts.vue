<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contacts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <div class="mx-4 p-4">
                                        <div class="flex items-center">
                                            <template v-for="(step, index) in steps">
                                                <div class="flex items-center text-teal-600 relative">
                                                    <div
                                                        :class="{
                                                        'rounded-full': true,
                                                        'text-center': true,
                                                        'transition': true,
                                                        'duration-500': true,
                                                        'ease-in-out': true,
                                                        'h-12': true,
                                                        'w-12': true,
                                                        'py-3': true,
                                                        'border-2': true,
                                                        'border-teal-600': true,
                                                        'bg-teal-600': currentStep === index,
                                                        'text-white': currentStep === index
                                                    }">
                                                        {{ index + 1 }}
                                                    </div>
                                                    <div
                                                        class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-teal-600">
                                                        {{ step.title }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="mt-8 p-4"
                                         v-show="'upload_file' === steps.find((s, i) => i === currentStep).key">
                                        <div>
                                            <div
                                                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3">
                                                Full Name
                                            </div>
                                            <div class="flex flex-col md:flex-row">
                                                <div class="w-full flex-1 mx-2 svelte-1l8159u">
                                                    <div
                                                        class="bg-white my-2 p-1 flex border border-gray-200 rounded svelte-1l8159u">
                                                        <input placeholder="First Name"
                                                               class="p-1 px-2 appearance-none outline-none w-full text-gray-800">
                                                    </div>
                                                </div>
                                                <div class="w-full flex-1 mx-2 svelte-1l8159u">
                                                    <div
                                                        class="bg-white my-2 p-1 flex border border-gray-200 rounded svelte-1l8159u">
                                                        <input placeholder="Last Name"
                                                               class="p-1 px-2 appearance-none outline-none w-full text-gray-800">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-8 p-4"
                                         v-show="'map_fields' === steps.find((s, i) => i === currentStep).key">
                                        <div>
                                            <div class="flex flex-col md:flex-row">
                                                <div class="w-full mx-2 flex-1 svelte-1l8159u">
                                                    <div
                                                        class="font-bold h-6 mt-3 text-gray-600 text-xs leading-8 uppercase">
                                                        Username
                                                    </div>
                                                    <div
                                                        class="bg-white my-2 p-1 flex border border-gray-200 rounded svelte-1l8159u">
                                                        <input placeholder="Just a hint.."
                                                               class="p-1 px-2 appearance-none outline-none w-full text-gray-800">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-8 p-4"
                                         v-show="'replace_strategy' === steps.find((s, i) => i === currentStep).key">
                                        <div>
                                            <div class="w-full mx-2 flex-1 svelte-1l8159u">
                                                <div
                                                    class="font-bold h-6 mt-3 text-gray-600 text-xs leading-8 uppercase">
                                                    Your Email
                                                </div>
                                                <div
                                                    class="bg-white my-2 p-1 flex border border-gray-200 rounded svelte-1l8159u">
                                                    <input placeholder="jhon@doe.com"
                                                           class="p-1 px-2 appearance-none outline-none w-full text-gray-800">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-8 p-4"
                                         v-show="'confirm' === steps.find((s, i) => i === currentStep).key">
                                        Confirm step
                                    </div>

                                    <!-- Buttons -->
                                    <div class="mt-8 p-4">
                                        <div class="flex p-2 mt-4">
                                            <button class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                                                           hover:bg-gray-200
                                                           bg-gray-100
                                                           text-gray-700
                                                           border duration-200 ease-in-out
                                                           border-gray-600 transition"
                                                    @click="prev"
                                            >
                                                Previous
                                            </button>
                                            <div class="flex-auto flex flex-row-reverse">
                                                <button class="text-base  ml-2  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                                                            hover:bg-teal-600
                                                            bg-teal-600
                                                            text-teal-100
                                                            border duration-200 ease-in-out
                                                            border-teal-600 transition"
                                                        @click="next"

                                                >
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Title
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Role
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            Jane Cooper
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            jane.cooper@example.com
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                                <div class="text-sm text-gray-500">Optimization</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Active
                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Admin
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            </td>
                                        </tr>

                                        <!-- More rows... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';

export default {
    components: {
        AppLayout,
    },
    props: {
        contacts: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            currentStep: 0,
        };
    },
    computed: {
        steps() {
            return [
                {
                    key: 'upload_file',
                    title: 'Upload file',
                },
                {
                    key: 'map_fields',
                    title: 'Map Fields',
                },
                {
                    key: 'replace_strategy',
                    title: 'Replace Strategy',
                },
                {
                    key: 'confirm',
                    title: 'Confirm',
                },
            ];
        },
    },
    methods: {
        next() {
            this.currentStep += this.currentStep === this.steps.length - 1 ? 0 : 1;
        },
        prev() {
            this.currentStep -= this.currentStep === 0 ? 0 : 1;
        },
    },
};
</script>
