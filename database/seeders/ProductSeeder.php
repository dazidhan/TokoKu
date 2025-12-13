<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel produk dulu agar tidak duplikat saat di-seed ulang
        DB::table('products')->truncate();

        $products = [
            // --- SEMBAKO & DAPUR ---
            ['sku' => 'SEM001', 'name' => 'Beras Pandan Wangi 5kg', 'category' => 'Dapur', 'stock' => 20, 'min_stock' => 5, 'price' => 72000],
            ['sku' => 'SEM002', 'name' => 'Minyak Goreng Bimoli 1L', 'category' => 'Dapur', 'stock' => 5, 'min_stock' => 10, 'price' => 18500], // Stok Rendah
            ['sku' => 'SEM003', 'name' => 'Gula Pasir Gulaku 1kg', 'category' => 'Dapur', 'stock' => 35, 'min_stock' => 10, 'price' => 16000],
            ['sku' => 'SEM004', 'name' => 'Telur Ayam Negeri 1kg', 'category' => 'Dapur', 'stock' => 12, 'min_stock' => 5, 'price' => 28000],
            ['sku' => 'SEM005', 'name' => 'Tepung Segitiga Biru 1kg', 'category' => 'Dapur', 'stock' => 4, 'min_stock' => 10, 'price' => 14000], // Stok Rendah
            ['sku' => 'SEM006', 'name' => 'Kecap Bango Manis 550ml', 'category' => 'Dapur', 'stock' => 24, 'min_stock' => 5, 'price' => 24500],
            ['sku' => 'SEM007', 'name' => 'Saus Sambal ABC 335ml', 'category' => 'Dapur', 'stock' => 30, 'min_stock' => 5, 'price' => 18000],
            ['sku' => 'SEM008', 'name' => 'Garam Meja Refina 500g', 'category' => 'Dapur', 'stock' => 50, 'min_stock' => 10, 'price' => 3500],
            ['sku' => 'SEM009', 'name' => 'Santan Kara 65ml', 'category' => 'Dapur', 'stock' => 100, 'min_stock' => 20, 'price' => 3500],
            ['sku' => 'SEM010', 'name' => 'Masako Rasa Ayam 100g', 'category' => 'Dapur', 'stock' => 45, 'min_stock' => 10, 'price' => 5000],

            // --- MAKANAN INSTAN & ROTI ---
            ['sku' => 'MKN001', 'name' => 'Indomie Goreng Original', 'category' => 'Makanan', 'stock' => 240, 'min_stock' => 40, 'price' => 3500],
            ['sku' => 'MKN002', 'name' => 'Indomie Ayam Bawang', 'category' => 'Makanan', 'stock' => 150, 'min_stock' => 40, 'price' => 3300],
            ['sku' => 'MKN003', 'name' => 'Indomie Soto Mie', 'category' => 'Makanan', 'stock' => 120, 'min_stock' => 40, 'price' => 3300],
            ['sku' => 'MKN004', 'name' => 'Mie Sedaap Goreng', 'category' => 'Makanan', 'stock' => 100, 'min_stock' => 20, 'price' => 3400],
            ['sku' => 'MKN005', 'name' => 'Roti Tawar Sari Roti', 'category' => 'Makanan', 'stock' => 8, 'min_stock' => 10, 'price' => 16000], // Stok Rendah
            ['sku' => 'MKN006', 'name' => 'Roti Sobek Coklat', 'category' => 'Makanan', 'stock' => 15, 'min_stock' => 5, 'price' => 18000],
            ['sku' => 'MKN007', 'name' => 'Sarden ABC Tomat 155g', 'category' => 'Makanan', 'stock' => 25, 'min_stock' => 5, 'price' => 12000],
            ['sku' => 'MKN008', 'name' => 'Bubur Sun Pisang', 'category' => 'Makanan', 'stock' => 20, 'min_stock' => 5, 'price' => 9500],
            ['sku' => 'MKN009', 'name' => 'Energen Coklat (10 Sachet)', 'category' => 'Makanan', 'stock' => 30, 'min_stock' => 5, 'price' => 22000],

            // --- MINUMAN ---
            ['sku' => 'MNM001', 'name' => 'Aqua Botol 600ml', 'category' => 'Minuman', 'stock' => 48, 'min_stock' => 24, 'price' => 4000],
            ['sku' => 'MNM002', 'name' => 'Aqua Galon 19L', 'category' => 'Minuman', 'stock' => 10, 'min_stock' => 15, 'price' => 22000], // Stok Rendah
            ['sku' => 'MNM003', 'name' => 'Teh Pucuk Harum 350ml', 'category' => 'Minuman', 'stock' => 60, 'min_stock' => 10, 'price' => 4000],
            ['sku' => 'MNM004', 'name' => 'Teh Botol Sosro Kotak', 'category' => 'Minuman', 'stock' => 55, 'min_stock' => 10, 'price' => 3500],
            ['sku' => 'MNM005', 'name' => 'Pocari Sweat 500ml', 'category' => 'Minuman', 'stock' => 24, 'min_stock' => 10, 'price' => 8000],
            ['sku' => 'MNM006', 'name' => 'Coca Cola 390ml', 'category' => 'Minuman', 'stock' => 20, 'min_stock' => 10, 'price' => 5500],
            ['sku' => 'MNM007', 'name' => 'Good Day Cappuccino Botol', 'category' => 'Minuman', 'stock' => 30, 'min_stock' => 10, 'price' => 6500],
            ['sku' => 'MNM008', 'name' => 'Kopi Kapal Api Mix (10s)', 'category' => 'Minuman', 'stock' => 40, 'min_stock' => 5, 'price' => 14000],
            ['sku' => 'MNM009', 'name' => 'Susu Bear Brand', 'category' => 'Minuman', 'stock' => 6, 'min_stock' => 10, 'price' => 10500], // Stok Rendah
            ['sku' => 'MNM010', 'name' => 'Ultra Milk Coklat 250ml', 'category' => 'Minuman', 'stock' => 45, 'min_stock' => 10, 'price' => 7000],
            ['sku' => 'MNM011', 'name' => 'Yakult (1 Pack)', 'category' => 'Minuman', 'stock' => 15, 'min_stock' => 5, 'price' => 11000],

            // --- SNACK ---
            ['sku' => 'SNK001', 'name' => 'Chitato Sapi Panggang 68g', 'category' => 'Makanan', 'stock' => 20, 'min_stock' => 10, 'price' => 11500],
            ['sku' => 'SNK002', 'name' => 'Lays Rumput Laut', 'category' => 'Makanan', 'stock' => 22, 'min_stock' => 10, 'price' => 11500],
            ['sku' => 'SNK003', 'name' => 'Oreo Original', 'category' => 'Makanan', 'stock' => 35, 'min_stock' => 10, 'price' => 9500],
            ['sku' => 'SNK004', 'name' => 'Beng Beng', 'category' => 'Makanan', 'stock' => 100, 'min_stock' => 20, 'price' => 2500],
            ['sku' => 'SNK005', 'name' => 'Silverqueen 62g', 'category' => 'Makanan', 'stock' => 10, 'min_stock' => 5, 'price' => 16500],
            ['sku' => 'SNK006', 'name' => 'Roma Kelapa', 'category' => 'Makanan', 'stock' => 25, 'min_stock' => 5, 'price' => 10500],
            ['sku' => 'SNK007', 'name' => 'Taro Net BBQ', 'category' => 'Makanan', 'stock' => 18, 'min_stock' => 5, 'price' => 5000],
            ['sku' => 'SNK008', 'name' => 'Kacang Garuda Rosta', 'category' => 'Makanan', 'stock' => 30, 'min_stock' => 10, 'price' => 15000],

            // --- KEBERSIHAN & MANDI ---
            ['sku' => 'BRS001', 'name' => 'Sabun Lifebuoy Total 100g', 'category' => 'Kebersihan', 'stock' => 50, 'min_stock' => 10, 'price' => 4500],
            ['sku' => 'BRS002', 'name' => 'Sabun Cair Lux 450ml', 'category' => 'Kebersihan', 'stock' => 4, 'min_stock' => 5, 'price' => 28000], // Stok Rendah
            ['sku' => 'BRS003', 'name' => 'Shampoo Pantene 160ml', 'category' => 'Kebersihan', 'stock' => 15, 'min_stock' => 5, 'price' => 25000],
            ['sku' => 'BRS004', 'name' => 'Shampoo Clear Men 160ml', 'category' => 'Kebersihan', 'stock' => 12, 'min_stock' => 5, 'price' => 26000],
            ['sku' => 'BRS005', 'name' => 'Pepsodent Pencegah Gigi Berlubang', 'category' => 'Kebersihan', 'stock' => 30, 'min_stock' => 10, 'price' => 12500],
            ['sku' => 'BRS006', 'name' => 'Deterjen Rinso Anti Noda 800g', 'category' => 'Kebersihan', 'stock' => 20, 'min_stock' => 5, 'price' => 24000],
            ['sku' => 'BRS007', 'name' => 'Pewangi Downy Sachet', 'category' => 'Kebersihan', 'stock' => 100, 'min_stock' => 20, 'price' => 1500],
            ['sku' => 'BRS008', 'name' => 'Sunlight Jeruk Nipis 755ml', 'category' => 'Kebersihan', 'stock' => 25, 'min_stock' => 5, 'price' => 18000],
            ['sku' => 'BRS009', 'name' => 'Tisu Wajah Nice 250s', 'category' => 'Kebersihan', 'stock' => 40, 'min_stock' => 10, 'price' => 14000],
            ['sku' => 'BRS010', 'name' => 'Pampers MamyPoko L', 'category' => 'Kebersihan', 'stock' => 10, 'min_stock' => 5, 'price' => 65000],

            // --- OBAT & LAINNYA ---
            ['sku' => 'LNS001', 'name' => 'Minyak Kayu Putih Cap Lang 60ml', 'category' => 'Kebersihan', 'stock' => 15, 'min_stock' => 5, 'price' => 18000],
            ['sku' => 'LNS002', 'name' => 'Panadol Merah (1 Strip)', 'category' => 'Kebersihan', 'stock' => 50, 'min_stock' => 10, 'price' => 12000],
            ['sku' => 'LNS003', 'name' => 'Tolak Angin Cair (1 Sachet)', 'category' => 'Kebersihan', 'stock' => 40, 'min_stock' => 10, 'price' => 4500],
            ['sku' => 'LNS004', 'name' => 'Autan Sachet', 'category' => 'Kebersihan', 'stock' => 50, 'min_stock' => 10, 'price' => 1000],
        ];

        foreach ($products as $item) {
            Product::create($item);
        }
    }
}