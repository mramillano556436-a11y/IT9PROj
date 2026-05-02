<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductImageUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function fakePngUpload(string $name = 'product.png'): UploadedFile
    {
        $png = base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+a5Z0AAAAASUVORK5CYII='
        );

        return UploadedFile::fake()->createWithContent($name, $png);
    }

    public function test_admin_can_create_a_product_with_an_image(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => 'Air Flex Pro',
            'category' => 'Running',
            'price' => 3499,
            'stock' => 12,
            'description' => 'Test product',
            'image' => $this->fakePngUpload(),
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $product = Product::first();

        $this->assertNotNull($product);
        $this->assertNotNull($product->image_path);
        Storage::disk('public')->assertExists($product->image_path);
    }

    public function test_admin_can_update_a_product_image(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $oldPath = $this->fakePngUpload('old.png')->store('products', 'public');

        $product = Product::create([
            'name' => 'Classic Low',
            'category' => 'Casual',
            'price' => 1999,
            'stock' => 10,
            'description' => 'Old description',
            'image_path' => $oldPath,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.products.update', $product), [
            'name' => 'Classic Low',
            'category' => 'Casual',
            'price' => 2099,
            'stock' => 8,
            'description' => 'Updated description',
            'image' => $this->fakePngUpload('new.png'),
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $product->refresh();

        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($product->image_path);
    }
}
