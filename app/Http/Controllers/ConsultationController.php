<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;


class ConsultationController extends Controller
{
    public function show($society_id)
    {

        $data = Consultation::firstWhere('society_id', $society_id);

        return response()->json([
            'id' => $data->id,
            'society_id' => $data->society_id,
            'status' => $data->status,
            'disease_history' => $data->disease_history,
            'current_symptomps' => $data->current_symptomps,
            'doctor_notes' => $data->doctor_notes,
            'doctor' => $data->doctor_notes,
        ],200);
    }

    public function create(Request $request)
    {

        $data = Consultation::create([
            'disease_history' => $request->disease_history,
            'society_id' => $request->society_id,
            'current_symptomps' => $request->current_symptomps,
        ]);
        return response()->json(['message' => 'Request Consultation Successfully', 'data' =>
        $data], 200);
    }
}
