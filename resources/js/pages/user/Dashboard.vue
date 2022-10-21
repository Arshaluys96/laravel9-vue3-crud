<template>
    <div class="container max-w-6xl mx-auto mt-8">
        <div class="mb-4">
            <h1 class="font-serif text-3xl font-bold underline decoration-gray-400"> Category</h1>
            <div class="flex justify-end">
                <button class=" px-4 py-2 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600" type="button"
                        @click="openAddCaModal = !openAddCaModal">Add Category
                </button>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <div v-if="Object.values(categories).length">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Name
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Description
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Created_At
                                </th>
                                <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50"
                                    colspan="3">
                                    Action
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white">
                            <tr v-for="categorie in categories.data">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        {{ categorie.name }}
                                    </div>

                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    <div class="form-outline text-600" >
                                        <textarea class="form-control" disabled rows="2" >{{ categorie.description  }}</textarea>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <p>{{ categorie.status }}</p>
                                </td>

                                <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    <span>{{ categorie.created_at }}</span>
                                </td>

                                <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                                    <button @click="editCategore(categorie)"
                                            class="text-indigo-600 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                </td>
                                <td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                    <button @click="toggleCaDelModal(categorie.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-red-600 hover:text-red-800"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-if="categories.links.length > 3">
                            <div class="mt-10 flex justify-center mt-8">
                                <template v-for="(link, key) in categories.links" :key="key">
                                    <div
                                        v-if="link.url === null"
                                        class="py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-500 pointer-events-none focus:shadow-none"
                                        v-html="link.label"
                                    />
                                    <button
                                        v-else
                                        @click="getCategories(link.url)"
                                        class="mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                                        :class="{ 'bg-blue-700 text-white': link.active }"
                                        v-html="link.label"
                                    ></button>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <AddCategores
        v-if="openAddCaModal"
        @addCategory="addCategory"
        @close="openAddCaModal = false">
    </AddCategores>

    <!--    Product table-->

    <div class="container max-w-6xl mx-auto mt-8">
        <div class="mb-4">
            <h1 class="font-serif text-3xl font-bold underline decoration-gray-400"> Product</h1>
            <div class="flex justify-end">
                <button class=" px-4 py-2 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600" type="button"
                        @click="openAddPrModal = !openAddPrModal">
                    Add Product
                </button>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <div v-if="Object.values(products).length">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Category Name
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Name
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Prise
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Created_At
                                </th>
                                <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50"
                                    colspan="3">
                                    Action
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white">
                            <tr v-for="product in products.data">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        {{ product.category.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        {{ product.name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ product.price }}
                                    </div>
                                </td>


                                <td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
                                        <span
                                            :class="product.status === 'pending' ? 'bg-yellow-500' : product.status === 'reject' ? 'bg-red-500' : 'bg-green-400'"
                                            class=" text-white rounded w-[80px] d-block text-center"
                                        >
                                            {{ product.status }}
                                        </span>
                                </td>


                                <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    <span>{{ product.created_at }}</span>
                                </td>

                                <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                                    <button @click="editProduct(product)" class="text-indigo-600 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                </td>
                                <td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                    <button @click="togglePrDelModal(product.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-red-600 hover:text-red-800"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-if="products.links.length > 3 ">
                            <div class="mt-10 flex justify-center mt-8">
                                <template v-for="(link, key) in products.links" :key="key">
                                    <div
                                        v-if="link.url === null"
                                        class="py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-500 pointer-events-none focus:shadow-none"
                                        v-html="link.label"
                                    />
                                    <button
                                        v-else
                                        @click="getProducts(link.url)"
                                        class="mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                                        :class="{ 'bg-blue-700 text-white': link.active }"
                                        v-html="link.label"
                                    ></button>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <AddProduct
        v-if="openAddPrModal"
        @addProduct="addProduct"
        :categories="categoryList"
        @close="openAddPrModal = false">
    </AddProduct>


    <CategoryDelModal
        v-if="openDeleteCategoryModal"
        :id="selectedCategoryId"
        :current_page="categories.current_page"
        @close="openDeleteCategoryModal = false"
        @deleteCategory="deleteCategory">
    </CategoryDelModal>

    <ProductDelModal
        v-if="openDeleteProductModal"
        :id="selectedProductId"
        :current_page="products.current_page"
        @deleteProduct="deleteProduct"
        @close="openDeleteProductModal = false">
    </ProductDelModal>

    <EditCategory
        v-if="openCategoreEditModal"
        @updateCategore="updateCategore"
        :selectedCategore="selectedCategore"
        :categoryChange="categoryChange"
        @close="openCategoreEditModal = false">
    </EditCategory>

    <EditProduct
        v-if="openProductEditModal"
        @close="openProductEditModal = false"
        @updateProduct="updateProduct"
        :selectedProduct="selectedProduct"
        :productChange="productChange"
        :categories="categoryList">
    </EditProduct>


</template>
<script>

import addCategores from "../../components/categores/AddCategores.vue";
import CategoryDelModal from "../../components/categores/CategoryDelModal.vue";
import ProductDelModal from "../../components/product/ProductDelModal.vue";
import AddProduct from "../../components/product/AddProduct.vue";
import EditCategory from "../../components/categores/EditCategory.vue";
import EditProduct from "../../components/product/EditProduct.vue";


export default {
    name: "UserDashboard",

    components: {
        AddProduct,
        ProductDelModal:ProductDelModal,
        CategoryDelModal:CategoryDelModal,
        AddCategores:addCategores,
        EditCategory:EditCategory,
        EditProduct:EditProduct
    },

    data(){
        return {
            openAddCaModal:false,
            openAddPrModal:false,

            showCaEdModal:false,
            showPrEdModal:false,

            showPrModal: false,

            selectedCategore:{},
            selectedProduct:{},

            selectedCategoryId: null,
            selectedProductId: null,
            editCategoreId:null,
            openDeleteProductModal: false,
            openDeleteCategoryModal: false,
            openCategoreEditModal:false,
            categoryChange:{},
            openProductEditModal:false,
            productChange:{},
            categories: {},
            products: {},
            categoryList: []
        }
    },

    created() {
        this.getCategories();
        this.getProducts();
        this.getCategoryList();
    },

    methods: {

        getCategories(link = null) {
            axios.get(link ?? '/get-categories').then(res => {
                this.categories = res.data.categories;
            });
        },

        getProducts(link = null) {
            axios.get(link ?? '/get-products').then(res => {
                this.products = res.data.products;
            });
        },

        getCategoryList() {
            axios.get('/get-category-list').then(res => {
                this.categoryList = res.data.category_list;
            });
        },

        addProduct(param) {
            if(this.products.current_page === 1) {
                this.products.data.unshift(param);
            }
            if (this.products.data.length > 5) {
                this.products.data.pop();
            }

            this.products.total++;

            const pagesCount = Math.ceil(this.products.total / 5);

            if (pagesCount > (this.products.links.length - 2)) {
                const link = {
                    url: window.location.origin +'/get-products?page=' + pagesCount,
                    label: pagesCount,
                    active: false
                };
                this.products.links.splice(this.products.links.length - 1, 0, link);
            }
            this.openAddPrModal = false;
        },

        addCategory(param) {

            if(this.categories.current_page === 1){
                this.categories.data.unshift(param);
            }
            if (this.categories.data.length > 5) {
                this.categories.data.pop();
            }
            this.categories.total++;

            const pagesCount = Math.ceil(this.categories.total / 5);

            if (pagesCount > (this.categories.links.length - 2)) {
                const link = {
                    url: window.location.origin +'/get-categories?page=' + pagesCount,
                    label: pagesCount,
                    active: false
                };
                this.categories.links.splice(this.categories.links.length - 1, 0, link);
            }

            this.getCategoryList();
            this.openAddCaModal = false;
        },

        editCategore(categore) {
            this.selectedCategore.id = categore.id;
            this.selectedCategore.name = categore.name;
            this.selectedCategore.description = categore.description;
            this.categoryChange = categore;
            this.openCategoreEditModal = !this.openCategoreEditModal;
        },

        updateCategore(){
            this.openCategoreEditModal = false;
        },

        editProduct(product) {
            this.selectedProduct.id = product.id;
            this.selectedProduct.name = product.name;
            this.selectedProduct.price = product.price;
            this.selectedProduct.category = product.category
            this.productChange = product;
            this.openProductEditModal =!this.openProductEditModal
        },

        updateProduct(product){
            this.productChange.name = product.name;
            this.productChange.price = product.price;
            this.productChange.category = product.category;
            this.openProductEditModal = false;
        },

        toggleCaDelModal(id) {
            this.openDeleteCategoryModal = true;
            this.selectedCategoryId = id;
        },

        togglePrDelModal(id) {
            this.openDeleteProductModal = true;
            this.selectedProductId = id;
        },

        deleteCategory(category) {
            this.categories.data.forEach((item, index) => {
                if (item.id === this.selectedCategoryId) {
                    this.categories.data.splice(index, 1);
                }
            });
            if (this.categories.data.length === 4) {
                if (category)
                    this.categories.data.push(category);
            }
            this.categories.total--;
            const perPage = Math.ceil(this.categories.total / 5);
            if (perPage < (this.categories.links.length - 2)) {
                this.categories.links.splice(this.categories.links.length - 2, 1);
            }
            if (this.categories.current_page) {
                if (this.categories.data.length === 0){
                    const pages = this.categories.current_page - 1;
                    this.getCategories('/get-categories?page=' + pages);
                }
            }
            this.openDeleteCategoryModal = false;
        },

        deleteProduct(product) {
            this.products.data.forEach((item, index) => {
                if (item.id === this.selectedProductId) {
                    this.products.data.splice(index, 1);
                }
            });
            if(this.products.data.length === 4){
                if(product)
                this.products.data.push(product);
            }
            this.products.total--;
            const perPage = Math.ceil(this.products.total / 5);
            if (perPage < (this.products.links.length - 2)) {
                this.products.links.splice(this.products.links.length - 2, 1);
            }
            if (this.products.current_page) {
                if (this.products.data.length === 0){
                    const pages = this.products.current_page - 1;
                    this.getProducts('/get-products?page=' + pages);
                }
            }
            this.openDeleteProductModal = false;
        },
    }
}

</script>

<style scoped>

</style>
