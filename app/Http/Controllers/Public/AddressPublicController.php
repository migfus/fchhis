<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressPublicController extends Controller
{
    public function index() : JsonRespone {
        $provinces = DB::table('address_provinces')->orderBy('name')->get();
        $out = [];
        $index = 0;

        foreach($provinces as $row) {
            $cities = DB::table('address_cities')->where('province_id', '=', $row->id)->orderBy('name')->get();
            $out[$index] = ['id' => $row->id, 'name' => $row->name, 'cities' => []];
            foreach($cities as $row2) {
                $out[$index]['cities'][] = ['id' => $row2->id, 'name' => $row2->name, 'zipcode' => $row2->zipcode];
            }
            $index++;
        }

        return response()->json($out);
    }
}
