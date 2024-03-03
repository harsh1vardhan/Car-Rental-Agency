<?php

namespace App\Http\Controllers;

use App\Models\CloudFile;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Product::latest()->with('image')->get();
        return view('dashboard.vendors.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('dashboard.vendors.articles.create');
    }


    public function handleCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer'
        ], [
            'name.required' => 'Le nom du produit est requis',
            'price.required' => 'Le prix du produit est requis'
        ]);


        try {

            DB::beginTransaction();

            $productData = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'vendor_id' => auth('vendor')->user()->id,
            ];



            $product = Product::create($productData);


            $this->handleImageUpload($product, $request, 'image', 'cloud_files/articles', 'cloud_file_id');
            //Gerer ici l'upload des images 

            DB::commit();
            return redirect()->route('articles.index')->with('success', 'Produit enregistrer');
        } catch (Exception $e) {
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
