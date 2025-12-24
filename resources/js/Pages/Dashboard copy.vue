<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// Menerima data products dari controller/route
defineProps({
    products: {
        type: Array,
        default: () => [],
    }
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Produk</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold">Daftar Produk Toko</h3>
                            <span class="text-sm text-gray-500">Data dari Database Tenant</span>
                        </div>

                        <div class="relative overflow-x-auto border rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Nama Produk</th>
                                        <th scope="col" class="px-6 py-3">Deskripsi</th>
                                        <th scope="col" class="px-6 py-3">Harga</th>
                                        <th scope="col" class="px-6 py-3">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in products" :key="product.id" class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ product.name }}
                                        </th>
                                        <td class="px-6 py-4 truncate max-w-xs">
                                            {{ product.description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp {{ new Intl.NumberFormat('id-ID').format(product.price) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ product.stock }}
                                        </td>
                                    </tr>
                                    <tr v-if="!products || products.length === 0">
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                            Belum ada data produk di database tenant ini.
                                        </td>
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