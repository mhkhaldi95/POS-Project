<?php

namespace App\Http\Controllers;

use App\Category;
use App\User as User;
use http\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
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


        $categories = Category::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(5);

        return view('adminlte.dashboardview.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminlte.dashboardview.Categories.create');

    }


    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required|unique:categories,name' ,
        ]);
        Category::create($request->all());
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $category = Category::findOrFail($id);

        }catch (ModelNotFoundException $exception){
            return redirect()->route('dashboard.categories.index')->withErrors(['error'=>__('ID Not Found')]);
;
        }



        return view('adminlte.dashboardview.Categories.create',compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|unique:categories,name,'.$id ,
        ]);
        try {
            $category = Category::find($id);
            $category->update($request->all());

            return redirect()->route('dashboard.categories.index');
        }catch (ModelNotFoundException $exception){
        ;
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Exception|Exception
     */
    public function destroy($id)
    {
        try{
            $category = Category::findOrFail($id);
            $category->delete();
        }catch (ModelNotFoundException $exception){
            return redirect()->route('dashboard.categories.index')->withErrors(['error'=>__('ID Not Found')]);

        }


    }
}
