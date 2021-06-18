<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\House;
use App\Helpers\MiscHelpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    protected $miscHelpers;

    public function __construct(MiscHelpers $miscHelpers)
    {
        $this->miscHelpers = $miscHelpers;
    }
    
    public function index()
    {
        $houses = House::all();
        return response()->json($houses);
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $fields = $request->validate([
            'title' => 'required|string',
            'type' => 'string',
            'description' => 'required|string',
            'beds' => 'required|string',
            'bedrooms' => 'required|string',
            'price' => 'required|numeric',
            'discountPrice' => 'required|numeric',
            'totalPrice' => 'required|numeric',
            'image_url' => 'string',
            'address' => 'string',
            'lat' => 'string|numeric',
            'lng' => 'string|numeric',
        ]);

        $identifier = $this->miscHelpers->IDGenerator(new House, 'identifier', 8, 'apt');

        $house = House::create([
            'user_id' => $userId,
            'title' => $fields['title'],
            'identifier' => $identifier,
            'type' => $fields['type'],
            'description' => $fields['description'],
            'beds' => $fields['beds'],
            'bedrooms' => $fields['bedrooms'],
            'price' => $fields['price'],
            'discountPrice' => $fields['discountPrice'],
            'totalPrice' => $fields['totalPrice'],
            'image_url' => $fields['image_url'],
            'address' => $fields['address'],
            'lat' => $fields['lat'],
            'lng' => $fields['lng'],
        ]);
        
        return response()->json($house);
    }

    public function show($id)
    {
        $house= House::where('id', $id)->first();
        return response()->json($house);
    }


    public function update(Request $request, $id)
    {
        $data = array();
        $data['title'] = $request->title;
        $data['type'] = $request->type;
        $data['description'] = $request->description;
        $data['beds'] = $request->beds;
        $data['bedrooms'] = $request->bedrooms;
        $data['price'] = $request->price;
        $data['discountPrice'] = $request->discountPrice;
        $data['totalPrice'] = $request->totalPrice;
        $data['image_url'] = $request->image_url;
        $data['address'] = $request->address;
        $data['lat'] = $request->lat;
        $data['lng'] = $request->lng;

        $house = House::where('id', $id)->update($data);

        return response()->json($house);
    }

    public function destroy($id)
    {
        House::where('id', $id)->first()->delete();
        return response()->json("Post deleted!");
    }
}
