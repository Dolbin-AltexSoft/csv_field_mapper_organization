<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow border-b border-gray-200 sm:rounded-lg" v-if="errors.length">
                                <template v-for="error in errors">
                                    <error-bag :message="error"></error-bag>
                                </template>
                            </div>
                            <div class="shadow border-b border-gray-200 sm:rounded-lg">
                                <!-- Steps -->
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
                                                :class="`flex-${step.flex} border-t-2 transition duration-500 ease-in-out border-gray-300`"></div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Steps Fields -->
                                <div class="mt-8 p-4"
                                     v-if="'upload_file' === steps.find((s, i) => i === currentStep).key">
                                    <div>
                                        <div v-show="!isLoading"
                                             class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="file-upload"
                                                           class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                        <span
                                                            class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition">
                                                            {{ form.file ? 'Replace the file' : 'Upload a file' }}
                                                        </span>
                                                        <input id="file-upload" name="file-upload" type="file"
                                                               ref="file"
                                                               @change="preUpload"
                                                               class="sr-only">
                                                    </label>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    CSV up to 10MB
                                                </p>
                                            </div>
                                        </div>
                                        <div v-show="!isLoading"
                                             class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="delimiter"
                                                           class="relative bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                        <span class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition mb-2">
                                                            Type delimiter
                                                        </span>
                                                        <input id="delimiter" name="delimiter" type="text"
                                                               v-model="form.delimiter"
                                                               class="text-l border p-2 ml-2 mt-2">
                                                    </label>
                                                </div>
                                                <p class="text-l border p-2 ml-2 mt-2">
                                                    Accepts <strong>,</strong> or <strong>;</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <loading v-show="isLoading"></loading>
                                    </div>
                                </div>
                                <div class="mt-8 p-4"
                                     v-if="'map_fields' === steps.find((s, i) => i === currentStep).key">
                                    <div class="shadow border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    File Fields
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Contact Fields
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-gray-50">
                                            <tr v-for="header in form.contactsHeaders" :key="`headers-${header}`">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ header }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex sm:flex sm:items-center sm:ml-6">
                                                        <div class="ml-3 relative">
                                                            <jet-dropdown align="right" width="48">
                                                                <template #trigger>
                                                                    <button
                                                                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                                        <div>{{
                                                                                form.mappedFields.find(
                                                                                    f => f.field === header) &&
                                                                                form.mappedFields.find(
                                                                                    f => f.field === header).mapTo ||
                                                                                `-Select field-`
                                                                            }}
                                                                        </div>

                                                                        <div class="ml-1">
                                                                            <svg class="fill-current h-4 w-4"
                                                                                 xmlns="http://www.w3.org/2000/svg"
                                                                                 viewBox="0 0 20 20">
                                                                                <path fill-rule="evenodd"
                                                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                                      clip-rule="evenodd"/>
                                                                            </svg>
                                                                        </div>
                                                                    </button>
                                                                </template>
                                                                <template #content>
                                                                    <template>
                                                                        <form @submit.prevent="setField(header, null)"
                                                                              :key="`fields-list-clear`">
                                                                            <jet-dropdown-link as="button">
                                                                                -Select field-
                                                                            </jet-dropdown-link>
                                                                        </form>
                                                                    </template>
                                                                    <template v-for="field in fieldsList">
                                                                        <form @submit.prevent="setField(header, field)"
                                                                              :key="`fields-list-${field}`">
                                                                            <jet-dropdown-link as="button">
                                                                                {{ field }}
                                                                            </jet-dropdown-link>
                                                                        </form>
                                                                    </template>

                                                                </template>
                                                            </jet-dropdown>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-8 p-4"
                                     v-if="'confirm' === steps.find((s, i) => i === currentStep).key">
                                    <div v-show="!isLoading"
                                         class="mt-2 flex justify-center px-6 pt-5 pb-6 rounded-md">
                                        <div class="space-y-1 text-center">
                                            <div class="flex text-sm text-gray-600">
                                                <div
                                                    class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold hover:bg-teal-600 bg-teal-600 text-teal-100 border border-teal-600">
                                                        <span
                                                            class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold text-teal-100 border border-teal-600">
                                                            {{
                                                                successImportMessage
                                                                    ? successImportMessage
                                                                    : 'The data is ready. Click Submit to proceed.'
                                                            }}
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <loading v-show="isLoading"></loading>
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
                                            <button :disabled="!form.file" class="text-base  ml-2  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                                                            hover:bg-teal-600
                                                            bg-teal-600
                                                            text-teal-100
                                                            border duration-200 ease-in-out
                                                            border-teal-600 transition"
                                                    @click="next"

                                            >
                                                {{
                                                    'confirm' === steps.find((s, i) => i === currentStep).key
                                                        ? 'Submit'
                                                        : 'Next'
                                                }}
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
import JetDropdown from '@/Jetstream/Dropdown';
import JetDropdownLink from '@/Jetstream/DropdownLink';
import Button from '@/Jetstream/Button';
import {Inertia} from '@inertiajs/inertia';
import Loading from '@/Components/Loading';
import ErrorBag from '@/Components/ErrorBag';

export default {
    name: 'ContactUploadForm',
    components: {
        ErrorBag,
        Loading,
        JetDropdown,
        JetDropdownLink,
        Button,
    },
    props: {
        fieldsList: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            currentStep: 0,
            isLoading: false,
            form: {
                file: null,
                contactsHeaders: [],
                contactsData: [],
                mappedFields: [],
                mappedData: [],
                delimiter: ',',
            },
            successImportMessage: '',
            errors: [],
        };
    },
    computed: {
        steps() {
            return [
                {
                    key: 'upload_file',
                    title: 'Upload file',
                    callback: this.upload,
                    flex: 1,
                },
                {
                    key: 'map_fields',
                    title: 'Map Fields',
                    callback: () => new Promise((res) => res(true)),
                    flex: 1,
                },
                {
                    key: 'confirm',
                    title: 'Confirm',
                    callback: this.confirm,
                    flex: 0,
                },
            ];
        },
    },
    methods: {
        setField(header, field) {
            this.form.mappedFields = this.form.mappedFields.filter(mf => mf.field !== header);
            this.form.mappedFields.push({
                field: header,
                mapTo: field,
            });
        },
        preUpload($event) {
            console.log($event);
            this.form.file = $event.target.files[0];
            this.$refs.file.value = null;
        },
        upload() {
            let formData = new FormData();
            formData.append('file', this.form.file);
            formData.append('delimiter', this.form.delimiter);
            this.isLoading = true;
            return axios.post('/import/parse-contacts', formData).then(res => {
                this.form.contactsHeaders = res.data.data.contactsHeaders;
                this.form.contactsData = res.data.data.contactsData;
                this.form.mappedFields = this.form.contactsHeaders.map(h => ({
                    field: h,
                    mapTo: null,
                }));
                this.isLoading = false;
            }).catch(e => {
                throw e;
            });
        },
        confirm() {
            this.successImportMessage = '';
            this.isLoading = true;
            this.form.mappedData = [];
            let fields = this.form.mappedFields.filter(mf => mf.mapTo !== null);
            let custom_attributes = this.form.mappedFields.filter(mf => mf.mapTo === null);
            this.form.contactsData.forEach(cdk => {
                let mapped_fields = {};
                let mapped_custom_attributes = [];
                Object.keys(cdk).forEach(cif => {
                    let field = fields.find(f => f.field === cif);
                    let custom_attribute = custom_attributes.find(f => f.field === cif);
                    console.log(field, custom_attribute);
                    if (field) {
                        mapped_fields[field.mapTo] = cdk[cif];
                    } else if (custom_attribute) {
                        if (cdk[cif]) {
                            mapped_custom_attributes.push({
                                key: custom_attribute.field,
                                value: cdk[cif],
                            });
                        }
                    }
                });
                this.form.mappedData.push({
                    fields: mapped_fields,
                    custom_attributes: mapped_custom_attributes,
                });
            });
            return axios.post('/import/import-contacts',
                {mappedData: this.form.mappedData, delimiter: this.form.delimiter}).
                then(() => {
                    this.isLoading = false;
                    this.successImportMessage = 'Contacts are successfully imported.';
                    Inertia.visit('contacts', {only: ['contacts']});
                }).
                catch(e => {
                    throw e;
                });
        },
        next() {
            this.errors = [];
            this.steps[this.currentStep].callback().then(() => {
                this.currentStep += this.currentStep === this.steps.length - 1 ? 0 : 1;
            }).catch(e => {
                this.isLoading = false;
                if (e.response && e.response.data && e.response.data.message) {
                    this.errors.push(e.response.data.message);
                } else if (e.message) {
                    this.errors.push(e.message);
                } else {
                    this.errors.push('Internal error. Please contact administrator.');
                }
            });

        },
        prev() {
            this.errors = [];
            this.currentStep -= this.currentStep === 0 ? 0 : 1;
        },
    },
};
</script>
<style scoped>
.flex-0 {
    flex: 0;
}
.flex-1 {
    flex: 1;
}
</style>
