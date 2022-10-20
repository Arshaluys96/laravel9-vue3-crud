<template>
    <div class="container max-w-7xl mx-auto mt-8">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Category  Name
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
                        <tr  v-for="(product) in productsList.data">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    {{ product.category.name}}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    {{ product.name }}
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
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <p>{{ product.status }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                <span>{{ product.created_at }}</span>
                            </td>
                            <td>
                                <button
                                    v-if="product.status === 'reject' || product.status === 'pending'"
                                    class="btn btn-success btn-sm"
                                    @click="changeStatus(product, 'approve')"
                                >
                                    Approve
                                </button>
                                <button
                                    v-if="product.status === 'approve' || product.status === 'pending'"
                                    class="btn btn-danger btn-sm"
                                    @click="changeStatus(product, 'reject')"
                                >
                                    Reject
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div v-if="products.links.length > 3">
                        <div class="flex flex-wrap mt-8">
                            <template v-for="(link, key) in products.links" :key="key">
                                <div
                                    v-if="link.url === null"
                                    class="mr-1 mb-1 text-sm leading-4 text-gray-400 border rounded"
                                    v-html="link.label"
                                />
                                <a
                                    v-else
                                    class="mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                                    :class="{ 'bg-blue-700 text-white': link.active }"
                                    :href="link.url"
                                    v-html="link.label"
                                ></a>
                            </template>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdminDashboard",
    props: [
        'products'
    ],
    data(){
        return{
            productsList: []
        }
     },
    methods:{
        changeStatus(product, status){
            const data = {
                id:product.id,
                status:status
            }
            axios.post('/change-status/', data)
                .then(res => {
                    product.status = status;
                })
                .catch(
                    error => {
                        console.log('error here');
                    })
        }
    },
    created() {
        this.productsList = this.products;
    }
}
</script>

<style scoped>

</style>
