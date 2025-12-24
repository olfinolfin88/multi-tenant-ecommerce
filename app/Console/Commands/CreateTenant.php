<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;
use Illuminate\Support\Facades\Artisan;

class CreateTenant extends Command
{
    
protected $signature = 'tenant:create {id : The unique name of the store}';
    protected $description = 'Create a new tenant store with isolated database and domain';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');

        // 1. Check if the Tenant already exists?
        if (Tenant::find($id)) {
            $this->error("❌ Error: Tenant with ID '{$id}' already exists!");
            return;
        }

        $this->info("🔄 Creating store: {$id} ...");

        // 2. Create Tenant & Domain
        try {
            $tenant = Tenant::create(['id' => $id]);
            $tenant->domains()->create(['domain' => $id . '.localhost']);
            
            $this->info("✅ Tenant & Domain created successfully.");

            // 3. Run Tenant Database Migration
            $this->info("🔄 Running database migrations for {$id}...");
            
            Artisan::call('tenants:migrate', [
                '--tenants' => [$id]
            ]);

            $this->info("✅ Database migrated.");
            
            // Output Success Info
            $this->newLine();
            $this->info("SUCCESS! Store '{$id}' is ready.");
            $this->info("URL: http://{$id}.localhost:8000");
            $this->info("Login Admin: You can register a new user at the URL above.");
            $this->newLine();

        } catch (\Exception $e) {
            $this->error("❌ Failed to create tenant: " . $e->getMessage());
        }
    }
}
