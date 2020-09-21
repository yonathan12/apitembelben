<?php

namespace App\Http\Controllers\Api;

use App\Balance;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction as RequestsTransaction;

class TransactionController extends Controller
{
    public function index()
    {
        //
    }

    public function create(RequestsTransaction $request)
    {
        $from_users_id = $request->from_users_id;
        $to_users_id = $request->to_users_id;
        $transaction_balance = $request->balance;

        for ($i=0; $i < 2; $i++) { 
            $transaction = new Transaction();
            $transaction->from_users_id = $from_users_id;
            $transaction->to_users_id = $to_users_id;
            $transaction->in_balance = $transaction_balance;
            $transaction->save();
        }

        $balance = Balance::where('users_id', $from_users_id)->first();
        $balance->balance = $balance->balance - (float) $transaction_balance;
        $balance->save();

        $balance = Balance::where('users_id', $to_users_id)->first();
        $balance->balance = $balance->balance + (float) $transaction_balance;
        $balance->save();

        return response([
            'status' => 'success',
            'message' => 'Pembayaran Berhasil Dilakukan',
            'data' => [
                'id' => $transaction->id
            ]
        ],200);
    }

    
    public function update(Request $request, Transaction $Transaction)
    {
        //
    }

    public function destroy(Transaction $Transaction)
    {
        //
    }
}
