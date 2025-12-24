<script setup>
import { Head } from '@inertiajs/vue3';
import { 
    GlobeAltIcon, 
    CommandLineIcon, 
    BuildingStorefrontIcon,
    ServerStackIcon,
    CodeBracketIcon,
    CheckCircleIcon,
    SparklesIcon
} from '@heroicons/vue/24/outline';

</script>

<template>
    <Head title="Multi-Tenant E-Commerce Platform" />

    <div class="min-h-screen bg-gray-950 text-white font-sans">
        
        <!-- NAVBAR -->
        <nav class="border-b border-gray-800 bg-gray-950/50 backdrop-blur sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center gap-2 font-bold text-xl tracking-tight">
                    <GlobeAltIcon class="w-8 h-8 text-indigo-500" />
                    <span>MultiTenant<span class="text-indigo-500">Platform</span></span>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 bg-gradient-to-r from-white via-indigo-100 to-gray-400 bg-clip-text text-transparent">
                    Multi-Tenant E-Commerce Platform
                </h1>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    A robust multi-tenant e-commerce application using a database-per-tenant architecture. 
                    The project demonstrates strict data isolation, automated tenant onboarding via CLI, 
                    and a modern frontend built with Inertia.js.
                </p>
            </div>

            <!-- Key Features -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <SparklesIcon class="w-6 h-6 text-indigo-500" />
                    Key Features
                </h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6">
                        <div class="flex items-start gap-3">
                            <CheckCircleIcon class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                            <div>
                                <h3 class="font-semibold mb-2">Strict Data Isolation</h3>
                                <p class="text-gray-400 text-sm">Each tenant uses its own MySQL database; data from one tenant cannot leak to another.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6">
                        <div class="flex items-start gap-3">
                            <CheckCircleIcon class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                            <div>
                                <h3 class="font-semibold mb-2">Automated Onboarding CLI</h3>
                                <p class="text-gray-400 text-sm">An Artisan command provisions stores, domains, databases, and runs migrations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6">
                        <div class="flex items-start gap-3">
                            <CheckCircleIcon class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                            <div>
                                <h3 class="font-semibold mb-2">Full Shopping Cart</h3>
                                <p class="text-gray-400 text-sm">Add/remove items and manage quantities; cart data is persisted in the database.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6">
                        <div class="flex items-start gap-3">
                            <CheckCircleIcon class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                            <div>
                                <h3 class="font-semibold mb-2">Modern UI/UX</h3>
                                <p class="text-gray-400 text-sm">Tailwind CSS, Heroicons, and SweetAlert2 for interactive notifications.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6 md:col-span-2">
                        <div class="flex items-start gap-3">
                            <CheckCircleIcon class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                            <div>
                                <h3 class="font-semibold mb-2">Automated Tests</h3>
                                <p class="text-gray-400 text-sm">Includes <code class="bg-gray-800 px-1.5 py-0.5 rounded text-indigo-400">TenantIsolationTest</code> to verify tenant data separation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tech Stack -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <CodeBracketIcon class="w-6 h-6 text-indigo-500" />
                    Tech Stack
                </h2>
                <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6">
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-500">•</span>
                            <strong>Backend:</strong> Laravel 12
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-500">•</span>
                            <strong>Frontend:</strong> Vue 3 (Composition API) + Inertia.js
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-500">•</span>
                            <strong>Database:</strong> MySQL (multi-database architecture)
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-500">•</span>
                            <strong>Styling:</strong> Tailwind CSS
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-500">•</span>
                            <strong>Icons:</strong> Heroicons
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-500">•</span>
                            <strong>Testing:</strong> PHPUnit
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Installation -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <CommandLineIcon class="w-6 h-6 text-indigo-500" />
                    Installation
                </h2>
                <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6 space-y-6">
                    <div>
                        <h3 class="font-semibold mb-3">1. Clone the repository</h3>
                        <div class="bg-black rounded-lg p-4 font-mono text-sm">
                            <div class="text-gray-500">$</div>
                            <div class="text-green-400">git clone https://github.com/your-username/your-repo-name.git</div>
                            <div class="text-green-400">cd your-repo-name</div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-3">2. Install dependencies</h3>
                        <div class="bg-black rounded-lg p-4 font-mono text-sm space-y-2">
                            <div>
                                <div class="text-gray-500"># PHP dependencies</div>
                                <div class="text-gray-500">$</div>
                                <div class="text-green-400">composer install</div>
                            </div>
                            <div>
                                <div class="text-gray-500"># JS dependencies (use legacy flag for Vite 7 compatibility)</div>
                                <div class="text-gray-500">$</div>
                                <div class="text-green-400">npm install --legacy-peer-deps</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-3">3. Environment setup</h3>
                        <div class="bg-black rounded-lg p-4 font-mono text-sm space-y-2">
                            <div class="text-gray-500">$</div>
                            <div class="text-green-400">cp .env.example .env</div>
                            <div class="text-green-400">php artisan key:generate</div>
                        </div>
                        <p class="text-gray-400 text-sm mt-3">
                            Configure database in <code class="bg-gray-800 px-1.5 py-0.5 rounded text-indigo-400">.env</code>. 
                            Create a central database (for example <code class="bg-gray-800 px-1.5 py-0.5 rounded text-indigo-400">ecommerce_central</code>). 
                            Tenant databases will be created automatically by the provisioning command.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-3">4. Run central migrations</h3>
                        <div class="bg-black rounded-lg p-4 font-mono text-sm">
                            <div class="text-gray-500">$</div>
                            <div class="text-green-400">php artisan migrate</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create a New Store -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <BuildingStorefrontIcon class="w-6 h-6 text-indigo-500" />
                    Create a New Store (Tenant)
                </h2>
                <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6">
                    <p class="text-gray-300 mb-4">
                        Use the included Artisan command to provision a tenant (creates tenant record, domain, database and runs migrations):
                    </p>
                    <div class="bg-black rounded-lg p-4 font-mono text-sm space-y-2 mb-4">
                        <div>
                            <div class="text-gray-500"># Syntax</div>
                            <div class="text-gray-500">$</div>
                            <div class="text-green-400">php artisan tenant:create {store_name}</div>
                        </div>
                        <div>
                            <div class="text-gray-500"># Example</div>
                            <div class="text-gray-500">$</div>
                            <div class="text-green-400">php artisan tenant:create store1</div>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Expected output: Creating store, Tenant & Domain created, Running migrations, SUCCESS! 
                        Store is ready. URL: <code class="bg-gray-800 px-1.5 py-0.5 rounded text-indigo-400">http://store1.localhost:8000</code>
                    </p>
                </div>
            </div>

            <!-- Run the Application -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <ServerStackIcon class="w-6 h-6 text-indigo-500" />
                    Run the Application
                </h2>
                <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6 space-y-4">
                    <div>
                        <h3 class="font-semibold mb-3">Start the Laravel server:</h3>
                        <div class="bg-black rounded-lg p-4 font-mono text-sm">
                            <div class="text-gray-500">$</div>
                            <div class="text-green-400">php artisan serve</div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-3">Start the frontend (Vite):</h3>
                        <div class="bg-black rounded-lg p-4 font-mono text-sm">
                            <div class="text-gray-500">$</div>
                            <div class="text-green-400">npm run dev</div>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Open the tenant subdomains in your browser (ensure local DNS resolves subdomains to <code class="bg-gray-800 px-1.5 py-0.5 rounded text-indigo-400">127.0.0.1</code>):
                    </p>
                    <ul class="list-disc list-inside text-gray-300 space-y-1 ml-4">
                        <li><code class="bg-gray-800 px-1.5 py-0.5 rounded text-indigo-400">http://store1.localhost:8000</code></li>
                        <li><code class="bg-gray-800 px-1.5 py-0.5 rounded text-indigo-400">http://store2.localhost:8000</code></li>
                    </ul>
                </div>
            </div>

            <!-- Testing -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Testing (Verify Tenant Isolation)</h2>
                <div class="bg-gray-900/80 border border-gray-800 rounded-lg p-6">
                    <p class="text-gray-300 mb-4">
                        Run the test that proves tenant data separation:
                    </p>
                    <div class="bg-black rounded-lg p-4 font-mono text-sm mb-4">
                        <div class="text-gray-500">$</div>
                        <div class="text-green-400">php artisan test --filter=TenantIsolationTest</div>
                    </div>
                    <p class="text-gray-400 text-sm">
                        The test will: create two temporary tenants, insert data into Tenant A, 
                        switch to Tenant B and assert Tenant A's data is not visible, insert data into Tenant B, 
                        switch back to Tenant A and ensure data integrity.
                    </p>
                </div>
            </div>

            <!-- Author -->
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-400 mb-2">
                    <strong class="text-white">Author</strong>
                </p>
                <p class="text-gray-300">
                    M.Olfin Ulum
                </p>
                <p class="text-gray-400 text-sm">
                    Fullstack Developer
                </p>
            </div>

        </div>
    </div>
</template>

<style scoped>
code {
    font-family: 'Courier New', monospace;
}
</style>
