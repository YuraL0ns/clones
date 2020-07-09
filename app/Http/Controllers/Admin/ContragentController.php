<?php

namespace App\Http\Controllers\Admin;

use App\Contragent;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ContragentController extends Controller
{
     public function __construct()
        {
            $this->middleware(['permission:create project'])->only(['create', 'store']);
            $this->middleware(['permission:update project'])->only(['edit', 'update']);
            $this->middleware(['permission:show project'])->only(['show', 'index']);
            $this->middleware(['permission:destroy project'])->only(['destroy']);
            $this->middleware(['permission:create file'])->only(['uploadFile']);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contragent = Contragent::get();
        return view('admin.contragent.main', compact('contragent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.contragent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $contragent = Contragent::query()
            ->create([
                'first_name' => $request->get('first_name'),
                'second_name' => $request->get('second_name'),
                'three_name' => $request->get('three_name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'company' => $request->get('company'),
                'region' => $request->get('region'),
                
            ]);
        return view('admin.contragent.show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contragent  $contragent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contragent = Contragent::find($id);
           
        return view('admin.contragent.show', compact('contragent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contragent  $contragent
     * @return \Illuminate\Http\Response
     */
    public function edit(Contragent $contragent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contragent  $contragent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contragent $contragent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contragent  $contragent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contragent = Contragent::findOrFail($id);
        $contragent->delete();
        return redirect()->route('contragent.index');
    }
}
