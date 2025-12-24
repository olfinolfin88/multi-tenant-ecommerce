<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2'; 

const props = defineProps({
    cart: Object
});

const grandTotal = computed(() => {
    if (!props.cart || !props.cart.items) return 0;
    
    return props.cart.items.reduce((total, item) => {
        return total + (item.quantity * item.product.price);
    }, 0);
});

const removeItem = (itemId) => {
    router.delete(route('cart.destroy', itemId), {
        preserveScroll: true,
        onSuccess: () => {
             Swal.fire({
                icon: 'success',
                title: 'Delete item successfully!',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
};
</script>

<template>
    <Head title="Cart" />

    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Your Shopping Cart</h2>
                        <Link href="/" class="text-indigo-600 hover:underline">
                            &larr; Continue Shopping
                        </Link>
                    </div>

                    <div v-if="!cart || !cart.items || cart.items.length === 0" class="text-center py-10">
                        <p class="text-gray-500 text-lg">Your cart is empty.</p>
                        <Link href="/" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-md">
                            Start Shopping
                        </Link>
                    </div>

                    <div v-else>
                        <div class="relative overflow-x-auto border rounded-lg mb-6">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3">Name Produk</th>
                                        <th class="px-6 py-3">Price</th>
                                        <th class="px-6 py-3">Qty</th>
                                        <th class="px-6 py-3">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in cart.items" :key="item.id" class="bg-white border-b">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ item.product.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(item.product.price) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.quantity }} pcs
                                        </td>
                                        <td class="px-6 py-4 font-bold text-gray-900">
                                            {{ new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(item.product.price * item.quantity) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <button 
                                                @click="removeItem(item.id)"
                                                class="text-red-500 hover:text-red-700 font-bold text-sm"
                                            >
                                               Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex flex-col items-end gap-4">
                            <div class="text-xl">
                                    Total: <span class="font-bold text-indigo-600">{{ new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(grandTotal) }}</span>
                                </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>