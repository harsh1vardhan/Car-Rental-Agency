<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CloudFile;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{
    public function index()
    {
        $articles = Car::latest()->with('image')->get();
        return view('dashboard.vendors.cars.index', compact('articles'));
    }

    public function create()
    {
        return view('dashboard.vendors.cars.create');
    }


    public function handleCreate(Request $request)
    {

        $request->validate([
            'model' => 'required',
            'number' => 'required|integer',
            'seating_capacity' => 'required|integer',
            'rent_per_day' => 'required|integer',

        ], [
            'model.required' => 'Car model is required',
            'number.required' => 'Value is required',
            'seating_capacity.required' => 'Value is required',
            'rent_per_day.required' => 'Value is required',

        ]);


        try {

            DB::beginTransaction();

            $productData = [
                'model' => $request->model,
                'number' => $request->number,
                'seating_capacity' => $request->seating_capacity,
                'rent_per_day' => $request->rent_per_day,
                'agency_id' => auth('vendor')->user()->id,
            ];



            $product = Car::create($productData);


            $this->handleImageUpload($product, $request, 'image', 'cloud_files/cars', 'cloud_file_id');
            //Gerer ici l'upload des images 

            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Car save successfull');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function handleImageUpload($data, $request, $inputKey, $destination, $attributeName)
    {
        if ($request->hasFile($inputKey)) {

            //Chemin vers le fichier
            $filePath = $request->file($inputKey)->store("$destination", 'public');

            $cloudFile = CloudFile::create([
                'path' => $filePath
            ]);

            $data->{$attributeName} = $cloudFile->id;
            $data->update();
        }
    }
}
