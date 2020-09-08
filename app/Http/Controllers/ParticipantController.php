<?php

namespace App\Http\Controllers;

use App\Participant;
use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{

    public function index()
    {
        $participants = Participant::
        orderByRaw("CAST(SUBSTRING(age_group,2,99) as unsigned) ,'desc'")
            ->get();    // order by from 2 symbol in age group
        return view('participants.index', compact('participants'));
    }


    public function create()
    {
        return view('participants.create');
    }

    public function store(Request $request)
    {
        $participant = new Participant($request->all());
        $participant->age_group = $request->gender . $participant->calculateAgeGroup($request->birthdate);
        $participant->save();
        return back()->with('success', 'Participant added successfully');

    }

    public function calculateResults()
    {
        $pId = Participant::select('id')->get();

        foreach ($pId as $id) { // get five best participants results
            $points = Result::select('points')
                ->where('participant_id', $id['id'])
                ->limit(5)
                ->get();
            $sum = 0;
            foreach ($points as $point) {
                $sum += $point['points'];
            }
            DB::table('participants')   // update points
                ->where('id', $id['id'])
                ->update(['total_points' => $sum]);
        }
        return back();
    }
}
