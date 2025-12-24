<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { 
    ShoppingBagIcon, 
    BuildingStorefrontIcon, 
    UserIcon, 
    ArrowRightOnRectangleIcon, 
    Squares2X2Icon, 
    PlusIcon,
    PhotoIcon 
} from '@heroicons/vue/24/outline';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    products: {
        type: Array,
        default: () => [],
    },
    tenantName: String
});

const form = useForm({
    product_id: null,
    quantity: 1,
});

const addToCart = (product) => {
    router.post(route('cart.add'), {
        product_id: product.id,
        quantity: 1
    }, {
        preserveScroll: true, 
        onSuccess: () => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Add Cart!',
                text: `${product.name} add successfully.`,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#fff',
                iconColor: '#10B981' 
            });
        },
        onError: () => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Error',
                text: 'Error adding to cart.',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
};
</script>

<template>
    <Head title="Welcome" />

    <div class="min-h-screen bg-gray-50 font-sans text-gray-900">
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    
                    <div class="flex items-center gap-2">
                        <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600">
                            <BuildingStorefrontIcon class="w-6 h-6" />
                        </div>
                        <span class="font-bold text-xl tracking-tight text-gray-800">
                            {{ tenantName }}
                        </span>
                    </div>
                    
                    <div v-if="canLogin" class="flex items-center gap-4">
                        <template v-if="$page.props.auth.user">
                            <Link :href="route('cart.index')" class="group flex items-center gap-1 text-gray-600 hover:text-indigo-600 font-medium transition mr-2">
                                <div class="relative">
                                    <ShoppingBagIcon class="w-6 h-6 group-hover:scale-110 transition" />
                                    <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                                    </span>
                                </div>
                                <span>Cart</span>
                            </Link>

                            <Link :href="route('dashboard')" class="flex items-center gap-1 text-gray-600 hover:text-indigo-600 font-medium transition">
                                <Squares2X2Icon class="w-6 h-6" />
                                <span class="hidden sm:inline">Dashboard</span>
                            </Link>
                        </template>

                        <template v-else>
                            <Link :href="route('login')" class="flex items-center gap-1 text-gray-600 hover:text-gray-900 font-medium">
                                <ArrowRightOnRectangleIcon class="w-5 h-5" />
                                Log in
                            </Link>
                            <Link v-if="canRegister" :href="route('register')" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow-sm flex items-center gap-1 font-medium text-sm">
                                <UserIcon class="w-5 h-5" />
                                Register
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <div class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-extrabold text-gray-900">Product Catalog</h1>
                    <p class="text-gray-500 mt-2">Discover our premium collection from {{ tenantName }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <div v-for="product in products" :key="product.id" class="bg-white p-5 rounded-2xl shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="h-48 bg-gray-100 rounded-xl mb-4 flex items-center justify-center text-gray-300">
                                <PhotoIcon class="w-16 h-16" />
                            </div>
                            
                            <h2 class="text-lg font-bold text-gray-900 line-clamp-1">{{ product.name }}</h2>
                            <p class="text-gray-500 text-sm mt-2 line-clamp-2 min-h-[40px]">{{ product.description || 'No description available' }}</p>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-lg font-bold text-indigo-600">
                                {{ new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(product.price) }}
                            </span>

                            <button 
                                v-if="$page.props.auth.user" 
                                @click="addToCart(product)"
                                :disabled="form.processing"
                                class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-600 transition flex items-center gap-1 shadow-md"
                            >
                                <PlusIcon class="w-4 h-4" />
                                Add
                            </button>
                            
                            <Link 
                                v-else 
                                :href="route('login')"
                                class="text-xs text-indigo-500 hover:text-indigo-700 font-medium underline"
                            >
                                Login to buy
                            </Link>
                        </div>
                    </div>

                    <div v-if="products.length === 0" class="col-span-full py-12 text-center text-gray-500">
                        <ShoppingBagIcon class="w-12 h-12 mx-auto text-gray-300 mb-3" />
                        <p>No products available in this store yet.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>