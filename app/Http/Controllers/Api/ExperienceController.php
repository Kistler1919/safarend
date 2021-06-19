<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MiscHelpers;
use Illuminate\Http\Request;
use App\Models\Api\Experience;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    protected $miscHelpers;

    public function __construct(MiscHelpers $miscHelpers)
    {
        $this->miscHelpers = $miscHelpers;
    }

    public function index()
    {
        $experiences = Experience::all();
        return response()->json($experiences);
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $fields = $request->validate([
            'title' => 'required|string',
            'address' => 'string',
            'description' => 'required|string',
            'exp_banner' => 'required|string',
            'rating' => 'required|numeric',
            'lat' => 'numeric',
            'lng' => 'numeric',
        ]);

        $identifier = $this->miscHelpers->IDGenerator(new Experience, 'identifier', 8, 'act');

        $house = Experience::create([
            'user_id' => $userId,
            'identifier' => $identifier,
            'title' => $fields['title'],
            'address' => $fields['address'],
            'description' => $fields['description'],
            'exp_banner' => $fields['exp_banner'],
            'rating' => $fields['rating'],
            'lat' => $fields['lat'],
            'lng' => $fields['lng'],
        ]);
        
        return response()->json($house);
    }

    public function show($id)
    {
        $experience = Experience::where('id', $id)->first();
        return response()->json($experience);
    }

    public function update(Request $request, $id)
    {
        $newData = array();
        $newData['title'] = $request->title;
        $newData['address'] = $request->address;
        $newData['description'] = $request->description;
        $newData['exp_banner'] = $request->exp_banner;
        $newData['rating'] = $request->rating;
        $newData['lat'] = $request->lat;
        $newData['lng'] = $request->lng;
        
        Experience::where('id', $id)->update($newData);

        return response()->json("Experience updated successfully!");
    }

    public function destroy($id)
    {
        Experience::where('id', $id)->first()->delete();
        return response()->json("Experience deleted!");
    }
}
