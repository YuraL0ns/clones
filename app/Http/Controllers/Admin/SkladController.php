<?php

namespace App\Http\Controllers\Admin;

use App\Sklad;
use App\User;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SkladController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create project'])->only(['create', 'store']);
        $this->middleware(['permission:update project'])->only(['edit', 'update']);
        $this->middleware(['permission:show project'])->only(['show', 'index']);
        $this->middleware(['permission:destroy project'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sklad = Sklad::get();
        return view('admin.sklad.index', compact('sklad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sklad = User::role(['Программист', 'Директор', 'Инжинер', 'Склад', 'Снабжение'])->get();
        return view('admin.sklad.create', compact('sklad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'in' => ['required', 'numeric'],
            'out' => ['nullable', 'numeric'],
            'type' => ['required', 'in:detail,material,purchased']
        ]);

        Sklad::create([
            'name' => $request->get('name'),
            'in' => $request->get('in'),
            'out' => $request->get('out'),
            'type' => $request->get('type'),
        ]);

        return redirect()->route('sklad.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sklad = Sklad::query()
            ->with('owners')
            ->with('tasks')
            ->findOrFail($id);

        return view('admin.sklad.show', compact('sklad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sklad = Sklad::query()
            ->with('owners')
            ->with('tasks')
            ->findOrFail($id);

        $users = User::role(['Программист', 'Конструктор\АСУ', 'Склад', 'Снабжение'])->get();
        return view('admin.sklad.edit', compact('sklad', 'users'));
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
        $this->validate($request, [
            'name' => 'required',
            'in' => '',
            'out' => '',
        ]);

        $sklad = Sklad::findOrFail($id);

        $sklad->update([
            'name' => $request->get('name'),
            'in' => $request->get('in'),
            'out' => $request->get('out'),
            'updated_at' => now()
        ]);
        return redirect()->route('admin.sklad.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sklad = Sklad::findOrFail($id);
        $sklad->delete();
        return redirect()->route('admin.sklad.index');
    }
}
