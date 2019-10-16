<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Pruduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
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
        $clients = Client::when($request->search, function ($q) use ($request)  {
            return $q->where('name','like', '%' . $request->search . '%')
                ->orWhere('address','like', '%' . $request->search . '%')
                ->orWhere('phone','like', '%' . $request->search . '%');

        }) ->latest()->paginate(5);
        return view('adminlte.dashboardview.Clients.index',compact('clients'));
        //
    }
    public function create()
    {
        return view('adminlte.dashboardview.Clients.create');
    }
    public function store(Request $request)
    {


        $rule=[
            'name'=>'required',
            'address'=>'required',
            'phone.0'=>'required|numeric',
        ];
        if($request->phone[1]!=null)
            $rule+=['phone.1'=>'numeric'];
        $request->validate($rule);

       Client::create($request->all());

        return redirect()->route('dashboard.clients.index');
    }
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
    public function edit(Client $client)
    {
        return view('adminlte.dashboardview.Clients.create',compact('client'));

    }

    public function update(Request $request, Client $client)
    {

        $rule=[
            'name'=>'required',
            'address'=>'required',
            'phone.0'=>'required|numeric',
        ];
        if($request->phone[1]!=null)
            $rule+=['phone.1'=>'numeric'];
        $request->validate($rule);

        $client->update($request->all());

        return redirect()->route('dashboard.clients.index');
    }


    public function destroy(Client $client)
    {
        $client->delete();
    }
}
