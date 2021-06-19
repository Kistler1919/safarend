<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MiscHelpers;
use App\Models\Api\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    protected $miscHelpers;

    public function __construct(MiscHelpers $miscHelpers)
    {
        $this->miscHelpers = $miscHelpers;
    }

    public function index()
    {
        $activities = Activity::all();
        return response()->json($activities);
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $fields = $request->validate([
            'type' => 'required|string',
            'venue' => 'required|string',
            'price' => 'required|string',
            'thumbnail' => 'required|string',
            'date' => 'required|string',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
        ]);

        $identifier = $this->miscHelpers->IDGenerator(new Activity, 'identifier', 8, 'act');

        $house = Activity::create([
            'user_id' => $userId,
            'identifier' => $identifier,
            'thumbnail' => $fields['thumbnail'],
            'venue' => $fields['venue'],
            'price' => $fields['price'],
            'type' => $fields['type'],
            'date' => $fields['date'],
            'start_time' => $fields['start_time'],
            'end_time' => $fields['end_time'],
        ]);
        
        return response()->json($house);
    }

    public function show($id)
    {
        $activity = Activity::where('id', $id)->first();
        return response()->json($activity);
    }

    public function update(Request $request, $id)
    {
        $newData = array();
        $newData['venue'] = $request->venue;
        $newData['type'] = $request->type;
        $newData['price'] = $request->price;
        $newData['thumbnail'] = $request->thumbnail;
        $newData['date'] = $request->date;
        $newData['start_time'] = $request->start_time;
        $newData['end_time'] = $request->end_time;
        
        Activity::where('id', $id)->update($newData);

        return response()->json("Activity updated successfully!");
    }

    public function destroy($id)
    {
        Activity::where('id', $id)->first()->delete();
        return response()->json("Activity deleted!");
    }
}
