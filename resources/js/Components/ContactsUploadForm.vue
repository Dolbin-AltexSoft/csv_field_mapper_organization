<template>
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
                                        <label class="block text-sm font-medium text-gray-700">
                                            Upload contacts
                                        </label>
                                        <div
                                            class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="file-upload"
                                                           class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                        <span
                                                            class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition">Upload a file</span>
                                                        <input id="file-upload" name="file-upload" type="file"
                                                               @change="preUpload"
                                                               class="sr-only">
                                                    </label>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    CSV up to 10MB
                                                </p>
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
</template>

<script>
import Button from '@/Jetstream/Button';

export default {
    name: 'ContactUploadForm',
    components: {
        Button,
    },
    data() {
        return {
            currentStep: 0,
            form: {
                file: null,
            },
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
        preUpload($event) {
            console.log($event);
            this.form.file = $event.target.files[0];
        },
        upload() {
            let formData = new FormData();
            formData.append('file', this.form.file);
            return axios.post('/import/parse-contacts', formData)
        },
        next() {
            this.upload().then((res => {
                this.currentStep += this.currentStep === this.steps.length - 1 ? 0 : 1;
            })).catch(e => {
                console.log(e);
            })

        },
        prev() {
            this.currentStep -= this.currentStep === 0 ? 0 : 1;
        },
    },
};
</script>
