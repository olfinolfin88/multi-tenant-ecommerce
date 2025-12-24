<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use App\Models\Tenant;
use App\Models\Product;
use App\Models\User;

class TenantIsolationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Bersihkan sisa test sebelumnya jika ada
        Tenant::whereIn('id', ['tenant_a', 'tenant_b'])->get()->each->delete();
    }
    public function test_two_tenant()
    {
        $log = function($msg) {
            echo "\n  " . $msg;
        };

        $log("✅ STARTING MULTI-TENANT DATA ISOLATION TEST...");
        $log("------------------------------------------------");
        // Create Tenant A
        $tenantA = Tenant::create(['id' => 'tenant_a']);
        $tenantA->domains()->create(['domain' => 'tenant_a.localhost']);
        // Run Migration for Tenant A
        Artisan::call('tenants:migrate', ['--tenants' => [$tenantA->id]]);
        $log("✅ Tenant A & Database created successfully.");

        // Create Tenant B
        $tenantB = Tenant::create(['id' => 'tenant_b']);
        $tenantB->domains()->create(['domain' => 'tenant_b.localhost']);
        // Run Migration for Tenant B
        Artisan::call('tenants:migrate', ['--tenants' => [$tenantB->id]]);
        $log("✅ Tenant A & Database created successfully.");

        // Initialization: Enter Tenant A Database
        tenancy()->initialize($tenantA);

        Product::create([
            'name'  => 'MACBOOK PRO A',
            'price' => 1000,
            'stock' => 100
        ]);

        // Assert: Ensure that Tenant A has 1 product
        $this->assertEquals(1, Product::count());
        $this->assertEquals('MACBOOK PRO A', Product::first()->name);
        $log("✅ User in Tenant A creates product 'MACBOOK PRO A'.");
        $log("✅ Data persisted in Tenant A Database.");
        // Done with Tenant A
        tenancy()->end();


        // Inisialisasi: Enter ke Database Tenant B
        tenancy()->initialize($tenantB);
        // Assert: Make sure it is EMPTY here (Product A must not leak here)
        $this->assertEquals(0, Product::count());
        $log("✅ Switched to Tenant B. Product A is NOT VISIBLE.");
        Product::create([
            'name'  => 'MACBOOK AIR B',
            'price' => 500,
            'stock' => 2000
        ]);

        // Assert: Ensure that Tenant A has 1 product
        $this->assertEquals(1, Product::count());
        $this->assertEquals('MACBOOK AIR B', Product::first()->name);

        $log("✅ User in Tenant B creates product 'MACBOOK AIR B'.");

        // Done with Tenant B
        tenancy()->end();

        // Check Again Tenant A
        tenancy()->initialize($tenantA);
        // Assert: Product B should not appear here. Quantity should remain 1.
        $this->assertEquals(1, Product::count());
        $this->assertEquals('MACBOOK PRO A', Product::first()->name);
        $log("✅ Switching back to Tenant A context...");
        $log("✅ Product B did NOT LEAK into Tenant A. Data isolation verified.");

        tenancy()->end();

        $log("------------------------------------------------");
        $log("✅ Multi-Tenant Data Isolation is working perfectly!\n");

        //Clean up data if want testing again
        $tenantA->delete();
        $tenantB->delete();
    }
}
