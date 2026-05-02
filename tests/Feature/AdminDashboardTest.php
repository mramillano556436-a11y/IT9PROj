<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_uses_real_store_data(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $customerOne = User::factory()->create([
            'role' => 'customer',
            'status' => 'active',
        ]);

        $customerTwo = User::factory()->create([
            'role' => 'customer',
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Air Flex Pro',
            'category' => 'Running',
            'price' => 3499,
            'stock' => 3,
        ]);

        Product::create([
            'name' => 'Classic Low',
            'category' => 'Casual',
            'price' => 1999,
            'stock' => 14,
        ]);

        $todayOrder = Order::create([
            'user_id' => $customerOne->id,
            'status' => 'processing',
            'total' => 1500,
            'items_count' => 2,
        ]);

        $previousOrder = Order::create([
            'user_id' => $customerTwo->id,
            'status' => 'delivered',
            'total' => 2750,
            'items_count' => 1,
        ]);

        $todayOrder->forceFill([
            'created_at' => now(),
            'updated_at' => now(),
        ])->save();

        $previousOrder->forceFill([
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ])->save();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSee('PHP 4,250.00');
        $response->assertSee('1 currently processing');
        $response->assertSee('1 need stock attention');
        $response->assertSee('2 this week');
        $response->assertSee('#STR-1');
        $response->assertSee('#STR-2');
    }
}
