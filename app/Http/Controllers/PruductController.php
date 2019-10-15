<?php

namespace App\Http\Controllers;

use App\Category;
use App\Pruduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PruductController extends Controller
{
    public function __construct()
    {
//        $this->middleware(['permission:read_users'])->only('index');
//        $this->middleware(['permission:create_users'])->only('createview');
//        $this->middleware(['permission:delete_users'])->only('delete');
//        $this->middleware(['permission:update_users'])->only('editview');
        $this->middleware(['lang','auth']);
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Pruduct::when($request->search, function ($q) use ($request)  {
            return $q->whereTranslationLike('name', '%' . $request->search . '%');

            }) ->when($request->category_id, function ($q) use ($request){

            return  $q->where('category_id','=',$request->category_id);
        })->latest()->paginate(5);
        return view('adminlte.dashboardview.Pruducts.index',compact('products','categories'));
        //
    }


    public function create()
    {
        $categories = Category::all();
        return view('adminlte.dashboardview.Pruducts.create',compact('categories'));
    }


    public function store(Request $request)
    {
        $rule=[
            'category_id'=>'required',
            'stoke'=>'required',
            'purchase_price'=>'required',
            'sale_price'=>'required',
        ];
        foreach (config('translatable.locales') as $locale){
            $rule+=[$locale.'.name'=>['required',Rule::unique('pruduct_translations','name')]];
            $rule+=[$locale.'.description'=>'required'];
        }
        $request->validate($rule);
        $request_data = $request->all();
        if($request->image){

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();})->save(public_path('/uploads/image_product/'.$request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }
      $p=  Pruduct::create($request_data);
      $cat = Category::find($request_data['category_id']);
      $cat->products()->save($p);

        return redirect()->route('dashboard.products.index');
    }


    public function show($id)
    {
        //
    }

    public function edit(Pruduct $product)
    {
        $categories = Category::all();
        return view('adminlte.dashboardview.Pruducts.create',compact('categories','product'));
    }


    public function update(Request $request, Pruduct $product)
    {
        $rule=[
            'category_id'=>'required',
            'stoke'=>'required',
            'purchase_price'=>'required',
            'sale_price'=>'required',
        ];
        foreach (config('translatable.locales') as $locale){
            $rule+=[$locale.'.name'=>['required',Rule::unique('pruduct_translations','name')->ignore($product->id,'pruduct_id')]];
            $rule+=[$locale.'.description'=>'required'];
        }
        $request->validate($rule);
        $request_data = $request->all();

        if($request->image){
            if($request->image!='imgProduct.png'){
                Storage::disk('public_uploads')->delete('/image_product/'.$product->image );

            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();})->save(public_path('/uploads/image_product/'.$request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }
        $product->update($request_data);



        return redirect()->route('dashboard.products.index');
    }

    public function destroy(Pruduct $product)
    {
        if($product->image!='imgProduct.png'){
            Storage::disk('public_uploads')->delete('/image_product/'.$product->image );

        }
            $product->delete();

    }
}
