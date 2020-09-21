<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'from_users_id' => 1, 'to_users_id' => 2, 'out_balance' => 10000 ],
            [ 'from_users_id' => 1, 'to_users_id' => 2, 'in_balance' => 10000 ]
        ];
        foreach ($data as $value) {
            DB::table('transactions')->insert($value);
        }
    }
}
