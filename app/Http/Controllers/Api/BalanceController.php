<?php

namespace App\Http\Controllers\Api;

use App\Balance;
use Illuminate\Http\Request;
use App\Http\Requests\Balance as RequestsBalance;

class BalanceController extends BaseController
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        $balance = Balance::find($id);
        if (!$balance) {
            return response([
                'status' => 'error',
                'message' => 'Data Tidak Ditemukan'
            ],404);
        }

        return response([
            'status' => 'success',
            'data' => $balance
        ],200);
    }

    public function update(RequestsBalance $request, $users_id)
    {
        $balance = Balance::where('users_id', $users_id)->first();
        if (!$balance){
            return response([
                'status' => 'error',
                'message' => 'Data Tidak Ditemukan'
            ],404);
        }

        $balance->balance = $balance->balance + (float) $request->balance;
        $balance->save();

        
        return response([
            'status' => 'success',
            'message' => 'Saldo Berhasil Ditambah',
            'data' => [
                'id' => $balance->id
            ]
        ],200);
    }
    
    public function destroy(Balance $balance)
    {
        //
    }
}
