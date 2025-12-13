<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Di dalam run():
        \App\Models\Product::create(['sku' => 'PRD001', 'name' => 'Indomie Goreng', 'category' => 'Makanan', 'stock' => 120, 'min_stock' => 50, 'price' => 3500]);
        \App\Models\Product::create(['sku' => 'PRD002', 'name' => 'Teh Botol Sosro', 'category' => 'Minuman', 'stock' => 8, 'min_stock' => 20, 'price' => 5000]); // Stok Rendah
        \App\Models\Product::create(['sku' => 'PRD005', 'name' => 'Sabun Lifebuoy', 'category' => 'Kebersihan', 'stock' => 45, 'min_stock' => 20, 'price' => 8500]);

        \App\Models\Employee::create(['name' => 'Budi Santoso', 'role' => 'Kasir', 'phone' => '081234567890', 'status' => 'active', 'joined_at' => '2023-01-01']);
        \App\Models\Employee::create(['name' => 'Ahmad Fauzi', 'role' => 'Kasir', 'phone' => '081234567892', 'status' => 'cuti', 'joined_at' => '2023-03-01']);
    }
}
