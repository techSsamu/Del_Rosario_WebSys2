<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Electronics', 'Clothing', 'Home & Garden', 'Sports', 'Books'];
        
        // Generate sales data for the last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $daysInMonth = $month->daysInMonth;
            
            // Create 3-5 sales entries per day
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $saleDate = $month->copy()->setDay($day);
                $numSales = rand(3, 5);
                
                for ($j = 0; $j < $numSales; $j++) {
                    Sale::create([
                        'revenue' => rand(500, 5000),
                        'expenses' => rand(200, 2500),
                        'units_sold' => rand(1, 50),
                        'category' => $categories[array_rand($categories)],
                        'sale_date' => $saleDate->format('Y-m-d'),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }
}

