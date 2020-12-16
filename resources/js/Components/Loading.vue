<template>
    <div
         class="mt-2 flex justify-center px-6 pt-5 pb-6 rounded-md">
        <div class="space-y-1 text-center">
            <div class="flex text-sm text-gray-600">
                <div
                    class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold hover:bg-teal-600 bg-teal-600 text-teal-100 border border-teal-600">
                                                        <span
                                                            class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold text-teal-100 border border-teal-600">
                                                            We are processing data. Please wait.
                                                        </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Loading',
};
</script>

<style scoped>

</style>
