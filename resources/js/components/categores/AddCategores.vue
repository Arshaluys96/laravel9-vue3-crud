<template>
    <div>
        <div
             class="w-7/12 m-auto overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative w-auto my-6 mx-auto max-w-6xl">
                <!--content-->
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            Add new category
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            @click="$emit('close')">
                        </button>
                    </div>
                    <!--body-->
                    <Form :validation-schema="schema" v-slot="{ errors }" @submit="saveCategores()">
                        <div class="relative p-6 flex-auto">
                            <div>
                                <label for="name"
                                       class="text-gray-800 mt-6 text-xl font-bold leading-tight tracking-normal">
                                    Name
                                </label>
                                <Field placeholder="Name"
                                       id="name"
                                       type="text"
                                       v-model="categore.name"
                                       name="name"
                                       class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'is-invalid': errors.name}">
                                </Field>
                                <div class="invalid-feedback">{{ errors.name }}</div>
                                <label for="description"
                                       class="text-gray-800 mt-6 text-xl font-bold leading-tight tracking-normal">
                                    Description
                                </label>
                                <Field placeholder="description"
                                       id="description"
                                       type="text"
                                       v-model="categore.description"
                                       name="description"
                                       class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'is-invalid': errors.description}">
                                </Field>
                                <div class="invalid-feedback">{{ errors.description }}</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                            <button
                                class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500  active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button" @click="$emit('close')">
                                Close
                            </button>
                            <button
                                class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="submit" >
                                Add
                            </button>
                        </div>
                    </Form>
                </div>
            </div>
        </div>
        <div  class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
</template>

<script>
import {Form, Field} from 'vee-validate';
import * as yup from "yup";

export default {
    name: "AddCategores.vue",
    components: {
        Form,
        Field,
    },
    data() {
        return {
            showAddCaModal: false,
            categore: {
                name: '',
                description: '',
            }
        }
    },
    computed: {
        schema() {
            return yup.object().shape({
                name: yup.string()
                    .min(3, "Name should be less than 3 characters")
                    .max(35, "Name should not exceed 35 characters")
                    .required("Name is required"),
                description: yup.string()
                    .min(10, "Name should be less than 10 characters")
                    .max(700, "Name should not exceed 700 characters")
                    .required("Please enter the required field")
            });
        },
    },
    methods: {
        saveCategores: function () {
            axios.post('/add-categories/', this.categore)
                .then(res => {
                this.$emit('addCategory', res.data.categore);
            }).catch(error => {
                console.log(error)
            })
        },
    },
}
</script>

<style scoped>

</style>
