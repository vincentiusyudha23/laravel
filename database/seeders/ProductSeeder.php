<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Lenovo 100',
            'price' => '20000',
            'description' => 'Ini Lenovo 100',
            'ketersediaan' => 'in_stock',
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
        DB::table('products')->insert([
            'name' => 'Lenovo 200',
            'price' => '30000',
            'description' => 'Ini Lenovo 200',
            'ketersediaan' => 'in_stock',
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
        DB::table('products')->insert([
            'name' => 'Lenovo 300',
            'price' => '40000',
            'description' => 'Ini Lenovo 300',
            'ketersediaan' => 'in_stock',
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
        DB::table('products')->insert([
            'name' => 'Lenovo 400',
            'price' => '50000',
            'description' => 'Ini Lenovo 400',
            'ketersediaan' => 'in_stock',
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
    }
}
