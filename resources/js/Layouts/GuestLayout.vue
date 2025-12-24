<script setup>
//import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { BuildingStorefrontIcon } from '@heroicons/vue/24/outline'; 
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const tenantName = page.props.tenant ? page.props.tenant.name : 'Our Store';

</script>

<template>
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
        <div>
            <Link href="/" class="flex flex-col items-center gap-2 group">
                <div class="bg-indigo-600 p-2 rounded-xl text-white shadow-lg group-hover:scale-110 transition duration-300">
                    <BuildingStorefrontIcon class="h-12 w-12" />
                </div>

                <span class="text-2xl font-bold text-gray-700 tracking-tight">
                    {{ tenantName }}
                </span>
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>