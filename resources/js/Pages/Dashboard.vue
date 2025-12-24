<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

defineProps({
    products: Array
});

const form = useForm({
    name: '',
    description: '',
    price: '',
    stock: '',
})

const submit = () => {
    form.post(route('products.store'), {
        onSuccess: () => form.reset(),
    });
};

const deleteProduct = (id) => {
    if (confirm('Are you sure delete this ?')) {
        router.delete(route('products.destroy', id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product Management</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Add New Product</h2>
                        <p class="mt-1 text-sm text-gray-600">Fill the form below to add stock.</p>
                    </header>

                    <form @submit.prevent="submit" class="mt-6 space-y-6 max-w-xl">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Product Name</label>
                            <input v-model="form.name" type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required />
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea v-model="form.description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"></textarea>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="block font-medium text-sm text-gray-700">Price (USD)</label>
                                <input v-model="form.price" type="number" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required />
                            </div>
                            <div class="w-1/2">
                                <label class="block font-medium text-sm text-gray-700">Stock</label>
                                <input v-model="form.stock" type="number" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button :disabled="form.processing" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Save Product
                            </button>
                            
                            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved successfully.</p>
                            </Transition>
                        </div>
                    </form>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4">Product List</h3>
                        <div class="relative overflow-x-auto border rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3">Name</th>
                                        <th class="px-6 py-3">Price</th>
                                        <th class="px-6 py-3">Stock</th>
                                        <th class="px-6 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in products" :key="product.id" class="bg-white border-b">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ product.name }}</td>
                                        <td class="px-6 py-4">{{ new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(product.price) }}</td>
                                        <td class="px-6 py-4">{{ product.stock }}</td>

                                        <td class="px-6 py-4">
                                            <button 
                                                @click="deleteProduct(product.id)"
                                                class="text-red-600 hover:text-red-900 font-bold"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="products.length === 0">
                                        <td colspan="4" class="px-6 py-4 text-center">No products yet.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>