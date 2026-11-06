<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;

/**
 * Demo data: 5 customers and 25 orders (ORD-1001 .. ORD-1025),
 * enough to show search, the status filter, and 3 pages of pagination.
 *
 * Run:   php artisan db:seed --class=DemoSeeder
 * Safe to run more than once (firstOrCreate / updateOrCreate).
 */
class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $customers = collect([
            ['name' => 'Ahmad Khalil', 'email' => 'ahmad@example.com', 'phone' => '0791000001'],
            ['name' => 'Sara Haddad', 'email' => 'sara@example.com', 'phone' => '0791000002'],
            ['name' => 'Omar Nasser', 'email' => 'omar@example.com', 'phone' => '0791000003'],
            ['name' => 'Lina Saleh', 'email' => 'lina@example.com', 'phone' => '0791000004'],
            ['name' => 'Yousef Ali', 'email' => 'yousef@example.com', 'phone' => '0791000005'],
        ])->map(fn ($data) => Customer::firstOrCreate(['email' => $data['email']], $data));

        for ($i = 1; $i <= 25; $i++) {
            Order::updateOrCreate(
                ['order_number' => 'ORD-' . (1000 + $i)],
                [
                    'customer_id' => $customers[$i % $customers->count()]->id,
                    'total_amount' => 10 + ($i * 7.25),
                    'status' => Order::STATUSES[$i % count(Order::STATUSES)],
                ]
            );
        }
    }
}
