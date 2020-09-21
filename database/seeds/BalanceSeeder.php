<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataFake = [
            [ 'users_id' => 1, 'balance' => 1000000 ],
            [ 'users_id' => 2, 'balance' => 500000 ]
        ];

        foreach ($dataFake as $key => $value) {
            DB::table('balances')->insert($value);
        }
    }
}
