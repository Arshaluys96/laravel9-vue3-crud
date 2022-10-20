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
                            Edit product
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            @click="$emit('close')">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                ×
              </span>
                        </button>
                    </div>
                    <!--body-->
                    <Form :validation-schema="schema" v-slot="{ errors }">
                        <div class="relative p-6 flex-auto">
                            <div>
                                <label for="categories"
                                       class="block mt-2 text-xl font-medium text-gray-900 dark:text-gray-400">
                                    Category
                                </label>
                                <Field id="categories"
                                       name="categorie"
                                       as="select"
                                       v-model="selectedProduct.category.id"
                                       :class="{ 'is-invalid': errors.category}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                       <option v-for="categorie in categories"
                                            :value="categorie.id">
                                        {{ categorie.name }}
                                       </option>
                                </Field>

                                <label for="name"
                                       class="text-gray-800 mt-6 text-xl font-bold leading-tight tracking-normal">
                                    Name
                                </label>
                                <Field
                                       id="name"
                                       type="text"
                                       v-model="selectedProduct.name"
                                       name="name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'is-invalid': errors.name}">
                                </Field>
                                <div class="invalid-feedback">{{ errors.name }}</div>

                                <label for="price"
                                       class="pt-5 text-gray-800 text-xl font-bold leading-tight tracking-normal">
                                    Price
                                </label>
                                <Field placeholder="Price"
                                       id="price"
                                       type="number"
                                       v-model="selectedProduct.price"
                                       name="price"
                                       :class="{ 'is-invalid': errors.price}"
                                       class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </Field>
                                <div class="invalid-feedback ">{{ errors.price }}</div>
                            </div>
                        </div>
                    </Form>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                        <button
                            class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500  active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button" @click="$emit('close')">
                            Close
                        </button>
                        <button
                            class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button" @click="changeProduct()">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
</template>

<script>

import {Form, Field} from 'vee-validate';
import * as yup from "yup";

export default {
    name: "EditProduct.vue",
    components: {
        Form,
        Field,
    },
    props:[
        'selectedProduct',
        'productChange',
        'categories'
    ],
    data(){
        return{
            categoryId: '',
            openProductEditModal : false,
            producte: {
                'name': '',
                'price': '',
            },
        }
    },

    computed: {
        schema() {
            return yup.object().shape({
                name: yup.string()
                    .min(3, "Name should be less than 2 characters")
                    .max(35, "Name should not exceed 35 characters")
                    .required("Name is required"),
                price: yup.string()
                    .required("Please enter the required field")
                    .matches(/^[0-9](\.[0-9][0-9][0-9])$/, "Only number are allowed for this field example 1.111")
            });
        },
    },

    methods:{
        changeProduct() {
            this.selectedProduct.category_id = this.selectedProduct.category.id
            axios.post(`/edit-product`, this.selectedProduct)
                .then(res => {
                    if(res.data.product) {
                        this.$emit('updateProduct',res.data.product)
                    }
                })
        },
    }
}
</script>

<style scoped>

</style>
