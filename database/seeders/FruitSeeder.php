<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fruit;

class FruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = [
            [
                'name' => 'kilo',
                'type' => '1',
                'beli' => '5000',
            ],
            [
                'name' => 'spin',
                'type' => '1',
                'beli' => '7500',
            ],
            [
                'name' => 'chop',
                'type' => '1',
                'beli' => '30000',
            ],
            [
                'name' => 'spring',
                'type' => '1',
                'beli' => '60000',
            ],
            [
                'name' => 'bomb',
                'type' => '1',
                'beli' => '80000',
            ],
            [
                'name' => 'smoke',
                'type' => '1',
                'beli' => '100000',
            ],
            [
                'name' => 'spike',
                'type' => '1',
                'beli' => '180000',
            ],
            [
                'name' => 'flame',
                'type' => '2',
                'beli' => '250000',
            ],
            [
                'name' => 'falcon',
                'type' => '2',
                'beli' => '300000',
            ],
            [
                'name' => 'ice',
                'type' => '2',
                'beli' => '350000',
            ],
            [
                'name' => 'sand',
                'type' => '2',
                'beli' => '420000',
            ],
            [
                'name' => 'dark',
                'type' => '2',
                'beli' => '500000',
            ],
            [
                'name' => 'revive',
                'type' => '2',
                'beli' => '550000',
            ],
            [
                'name' => 'diamond',
                'type' => '2',
                'beli' => '600000',
            ],
            [
                'name' => 'light',
                'type' => '3',
                'beli' => '650000',
            ],
            [
                'name' => 'rubber',
                'type' => '3',
                'beli' => '750000',
            ],
            [
                'name' => 'barrier',
                'type' => '3',
                'beli' => '800000',
            ],
            [
                'name' => 'magma',
                'type' => '3',
                'beli' => '850000',
            ],
            [
                'name' => 'quake',
                'type' => '4',
                'beli' => '1000000',
            ],
            [
                'name' => 'buddha',
                'type' => '4',
                'beli' => '1200000',
            ],
            [
                'name' => 'love',
                'type' => '4',
                'beli' => '1300000',
            ],
            [
                'name' => 'spider',
                'type' => '4',
                'beli' => '1500000',
            ],
            [
                'name' => 'pheonix',
                'type' => '4',
                'beli' => '1800000',
            ],
            [
                'name' => 'portal',
                'type' => '4',
                'beli' => '1900000',
            ],
            [
                'name' => 'rumble',
                'type' => '4',
                'beli' => '2100000',
            ],
            [
                'name' => 'paw',
                'type' => '4',
                'beli' => '2300000',
            ],
            [
                'name' => 'blizzard',
                'type' => '4',
                'beli' => '2400000',
            ],
            [
                'name' => 'gravity',
                'type' => '5',
                'beli' => '2500000',
            ],
            [
                'name' => 'dough',
                'type' => '5',
                'beli' => '2800000',
            ],
            [
                'name' => 'shadow',
                'type' => '5',
                'beli' => '2900000',
            ],
            [
                'name' => 'venom',
                'type' => '5',
                'beli' => '3000000',
            ],
            [
                'name' => 'control',
                'type' => '5',
                'beli' => '3200000',
            ],
            [
                'name' => 'spirit',
                'type' => '5',
                'beli' => '3400000',
            ],
            [
                'name' => 'dragon',
                'type' => '5',
                'beli' => '3500000',
            ],
            [
                'name' => 'leopard',
                'type' => '5',
                'beli' => '5000000',
            ],
        ];
        
        $ar = array_reverse($data);
        
        foreach($ar as $fruits) {
            Fruit::create($fruits);
        }
    }
}
