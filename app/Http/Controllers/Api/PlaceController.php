<?php

namespace App\Http\Controllers\Api;

use App\Place;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlaceController extends BaseController
{
    public function index(Request $request)
    {
        $validator = $this->validasi($request);
        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 'error',
                'data'    => $validator->errors()
            ],400);
        }

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $q = $request->q;
        $get_place = DB::select("
        SELECT
            id, place, address, (
                6371 * acos (
                cos ( radians($latitude) )
                * cos( radians( latitude ) )
                * cos( radians( longitude ) - radians($longitude) )
                + sin ( radians($latitude) )
                * sin( radians( latitude ) )
                )
            ) AS distance
            FROM places WHERE place LIKE '%$q%'
            HAVING distance <= 5
        ");
        return response([
            'status' => 'success',
            'data' => $get_place
        ],200);
    }

    public function create(Request $request)
    {
        $validator = $this->validasi($request);
        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 'error',
                'data'    => $validator->errors()
            ],400);
        }
        $place = new Place();
        $this->save($place, $request);
        return response([
            'status' => 'success',
            'message' => 'Data Berhasil Disimpan',
            'data' => [
                'id' => $place->id
            ]
        ],200);
    }

    public function show($id)
    {
        $place = Place::find($id);
        if (!$place)
        {
            return response([
                'status' => 'error',
                'message' => 'Data Tidak Ditemukan'
            ],404);
        }
        return response([
            'status' => 'success',
            'data' => $place
        ],200);
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validasi($request);
        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 'error',
                'data'    => $validator->errors()
            ],400);
        }

        $place = Place::find($id);
        if (!$place)
        {
            return response([
                'status' => 'error',
                'message' => 'Data Tidak Ditemukan'
            ],404);
        }
        $this->save($place, $request);
        return response([
            'status' => 'success',
            'message' => 'Data Berhasil Disimpan',
            'data' => [
                'id' => $place->id
            ]
        ],200);
    }

    public function destroy($id)
    {
        $place = Place::find($id);
        if (!$place)
        {
            return response([
                'status' => 'error',
                'message' => 'Data Tidak Ditemukan'
            ],404);
        }
        $place->delete();
        return response([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus',
            'data' => [
                'id' => $place->id
            ]
        ],200);
    }

    private function validasi($request)
    {
        return Validator::make($request->all(), [
            'latitude'     => 'required',
            'longitude'   => 'required',
        ],
            [
                'latitude.required' => 'Masukkan Latitude !',
                'longitude.required' => 'Masukkan Longitude !',
            ]
        );
    }

    private function save(Place $place, Request $request)
    {
        $place->place = $request->place;
        $place->address = $request->address;
        $place->latitude = $request->latitude;
        $place->longitude = $request->longitude;
        $place->save();
    }
}
