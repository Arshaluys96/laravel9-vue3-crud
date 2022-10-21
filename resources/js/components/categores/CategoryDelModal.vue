<template>
    <div>
        <div
            class="w-7/12 m-auto overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative w-auto my-6 mx-auto max-w-6xl">
                <!--content-->
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">

                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            Delete Category ?
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            @click=" toggleCaDelModal()">
                        </button>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                        <button
                            class="text-blue-500 bg-transparent border border-solid border-red-500 hover:bg-red-500  active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button" @click="$emit('close')">
                            Close
                        </button>
                        <button
                            class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button" @click="toggleCaDelModal();deleteCategory()">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
</template>

<script>
export default {
    name: "CategoryDelModal.vue",
    props: ['id',
        'current_page'],
    data() {
        return {
            showCatDelModal: false,
        }
    },
    methods: {
        toggleCaDelModal: function () {
            this.showCatDelModal = !this.showCatDelModal;
        },
        deleteCategory() {
            axios.post(`/delete-category`, {id: this.id, current_page: this.current_page})
                .then((res) => {
                    this.$emit('deleteCategory', res.data.category);
                });
        },
    },
}
</script>

<style scoped>

</style>
