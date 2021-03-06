<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ItemsResource;
use Illuminate\Support\Facades\URL;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return ItemsResource::collection($items)->toArray("data");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'string|nullable',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required'
        ]);
        
        if (isset($data['image'])) {
            $relativePath = $this->saveImage($data['image']);
            $data['image'] = $relativePath;
        }


        $i = Item::create($data);
        return response()->json($i, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $i = Item::findOrFail($id);
        $i->image = $i->image ? URL::to($i->image) : null;
        $i->category;
        if (is_null($i)) {
            return response()->json(['message' => 'Ez a termék nem létezik'], 404);
        } else {
            return response()->json($i);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $item = Item::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'image' => 'string|nullable',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required'
        ]);

        if (isset($data['image'])) {
            $relativePath = $this->saveImage($data['image']);
            $data['image'] = $relativePath;

            if ($item->image) {
                $absolutePath = public_path($item->image);
                File::delete($absolutePath);
            }
        }

        $item->update($data);
        return response()->json([ "success" => "Sikeres módosítás"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return response()->noContent();
    }

    /**
     * Szörcs
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $items = Item::where('name', 'like', '%' . $name . '%')->get();
        if (count($items) === 0) {
            return response()->json(['message' => 'Ez a termék nem létezik'], 404);
        } else {
            return ItemsResource::collection($items)->toArray("data");
        }
    }

    public function itemCount() {
        $items = Item::all()->count();
        return response()->json($items);
    }

    private function saveImage($image) {
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]);

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}
