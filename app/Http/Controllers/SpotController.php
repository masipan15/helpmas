<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpotResources;
use App\Http\Resources\VaccineResources;
use App\Models\Societies;
use App\Models\Spots;

class SpotController extends Controller
{
    public function spot($regional_id)
    {
        $society = Societies::firstWhere('regional_id', '=', $regional_id);
        $data = Spots::with('regional')->where('regional_id', '=', $society->regional_id)->get();
        return response()->json([
            "spots" => $data
        ], 200);
    }

    public function show($regional_id)
    {

        // $main = Spots::with('spot_vaccine.vaccine')->get();
        // $mains = Spots::with('spot_vaccine.vaccine')->get();
        $spot = Spots::with('spot_vaccine.vaccine')->Where('regional_id','=', $regional_id)->get();
        // dd($spot);
        return SpotResources::collection($spot);
        // return response()->json(
        //     [
        //         'spot' => [
        //             'id'=> $spot->name,
        //             // '$spots'=>'asdsas',
        //         ]
        //     ],
        //     200
        // );
    }
}
