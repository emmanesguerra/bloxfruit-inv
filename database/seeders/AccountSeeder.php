<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
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
                'username' => 'binawnaw2',
                'email' => 'zanecpreyes@gmail.com',
                'storage_ctr' => '2',
            ],
            [
                'username' => 'binawnaw3',
                'email' => 'emmangenshin1@gmail.com',
                'storage_ctr' => '2',
            ],
            [
                'username' => 'binawnaw4',
                'email' => 'emmanesguerra2013@gmail.com',
                'storage_ctr' => '3',
            ],
            [
                'username' => 'binawnaw5',
                'email' => '',
                'storage_ctr' => '1',
            ],
            [
                'username' => 'penice_1234',
                'email' => '',
                'storage_ctr' => '1',
            ],
            [
                'username' => 'jupgil',
                'email' => 'zanegamertray29@gmail.com',
                'storage_ctr' => '1',
            ],
            [
                'username' => 'Pegaming_123',
                'email' => '',
                'storage_ctr' => '1',
            ],
        ];
        
        foreach($data as $users) {
            Account::create($users);
        }
    }
}
