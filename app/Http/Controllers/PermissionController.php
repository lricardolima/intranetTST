<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('name', 'ASC')->paginate(20);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try
        {

            $permission = Permission::where('name', $request->name )->get();
            if ($permission->count() > 0) {
                return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'OOps!!, o nome dessa permissão já esta em uso.']);
            }

            $request->validate([
                'name'=>'required'
            ]);


            permission::create([
                'name' =>$request->name,
            ]);

            return redirect()->route('permission.index')->with(['color' => 'green', 'message' => 'Permissão foi cadastrada com sucesso!']);

        }

        catch (\Exception $e)
        {
            return redirect()->route('permission.create')->with(['color' => 'orange', 'message' => 'Favor adicione o nome da permissão']);
        }

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
        $permission = permission::find($id);
        return view('permissions.edit', compact('permission'));
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
        try
        {

            $permission = Permission::where('name', $request->name )->where('id', '!=', $id)->get();
            if ($permission->count() > 0) {
                return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'OOps!!, o nome dessa permissão já esta em uso.']);
            }

            $request->validate([
                'name'=>'required'
            ]);

            permission::whereId($id)->update([
                'name' =>$request->name,
            ]);

            return redirect()->route('permission.index')->with(['color' => 'green', 'message' => 'Permissão alterado com sucesso!']);

        }

        catch (\Exception $e)
        {
            return redirect()->route('permission.edit')->with(['color' => 'orange', 'message' => 'Erro ao alterar a Permissão.']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            permission::destroy($id);
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'Erro ao excluir a permissão.']);
        }

        return redirect()->route('permission.index')->with(['color' => 'green', 'message' => 'Permissão excluida com sucesso!']);
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $permissions = Permissions::where('name', 'LIKE', "%{$request->search}%")->paginate(20);

            return view('permissions.index', compact('permissions', 'filters'));
    }
}
