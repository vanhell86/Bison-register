<?php

namespace App\Http\Controllers;

use App\Participant;
use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function create()
    {
        return view('results.create');
    }

    public function store(Request $request)
    {
        $result = new Result($request->all());
        $id = $request->participant_id;

        if (!Participant::find($id)) {
            return back()->with('danger', 'There is no such participant');
        }
        if (Result::where('participant_id', $id)->where('stage_number', $request->stage_number)->first()) {
            return back()->with('danger', 'Record already exists');
        }
        $result->age_group = DB::table('participants')
            ->where('id', $id)->value('age_group');

        $result->save();

        return back()->with('success', 'Result added successfully');
    }

    public function index()
    {
        $results = Result::OrderByRaw("LENGTH(age_group), age_group")->OrderBy("points", 'desc')// order by length
            ->get();                                                              //and age group, then order by points

        return view('results.index', compact('results'));
    }

    public function calculateResults()
    {
        $age_group = [
            'V3', 'S3', 'V5', 'S5', 'V7', 'S7', 'V9', 'S9', 'V10', 'S10', 'V12', 'S12', 'V14', 'S14', 'V16', 'S16',
            'V18', 'S18', 'V20', 'S20', 'V21', 'S21', 'V35', 'S35', 'V40', 'S40', 'V45', 'S45', 'V50', 'S50', 'V55',
            'S55', 'V60', 'S60', 'V65', 'S65', 'V70', 'S70', 'V75', 'S75', 'V80', 'S80'
        ];
        $stages = range(1, 8);
        $best_time = [];

        foreach ($age_group as $age) {      // get best time in each stage in each age group
            foreach ($stages as $stage) {
                $best_time[$stage][$age] = Result::where('age_group', $age)
                    ->where('stage_number', $stage)
                    ->min('time');
            }
        }

        foreach ($best_time as $stageN => $stage) { // go through all stages
            foreach ($stage as $group => $time) {   // go through all age group
                if ($time === null) // if no result, then skip rest
                    continue;
                $pTimes = Result::select('participant_id', 'time')  // get all participants time
                    ->where('age_group', $group)
                    ->where('stage_number', $stageN)->get();

                foreach ($pTimes as $pTime) {   // calculate each participants points
                    DB::table('results')
                        ->where('participant_id', $pTime['participant_id'])
                        ->where('age_group', $group)
                        ->where('stage_number', $stageN)
                        ->update(['points' => (($time / $pTime['time']) * 1000)]);
                }
            }
        }
        return back();
    }
}
