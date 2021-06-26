<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->paginate(20);

        return view('roles.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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

            $role = Role::where('name', $request->name )->get();
            if ($role->count() > 0) {
                return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'OOps!!, o nome do perfil já esta em uso.']);
            }

            $request->validate([
                'name'=>'required'
            ]);

            Role::create([
                'name' =>$request->name,
            ]);

            return redirect()->route('role.index')->with(['color' => 'green', 'message' => 'Perfil cadastrado com sucesso!']);

        }

        catch (\Exception $e)
        {
            return redirect()->route('role.create')->with(['color' => 'orange', 'message' => 'Favor adicione o nome da perfil']);
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
        $role = Role::find($id);
        return view('roles.edit', compact('role'));
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

            $role = Role::where('name', $request->name )->where('id', '!=', $id)->get();
            if ($role->count() > 0) {
                return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'OOps!!, o nome do perfil já esta em uso.']);
            }

            $request->validate([
                'name'=>'required'
            ]);

            Role::whereId($id)->update([
                'name' =>$request->name,
            ]);

            return redirect()->route('role.index')->with(['color' => 'green', 'message' => 'Perfil alterado com sucesso!']);
        }

        catch (\Exception $e)
        {
            $mensagem + "Erro ao alterar o Perfil.";
            return redirect()->route('role.edit')->with(['color' => 'orange', 'message' => 'Erro ao alterar o Perfil.']);
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
            Role::destroy($id);
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'Erro ao excluir o perfil.']);
        }

        return redirect()->route('role.index')->with(['color' => 'green', 'message' => 'Perfil excluida com sucesso.']);
    }

    public function permissions($role)
    {
        $role = Role::find($role);

        $permissions = Permission::all();

        foreach ($permissions as $permission)
        {
            if ($role->hasPermissionTo($permission->name))
            {
                $permission -> can = true;
            }
            else
            {
                $permission -> can = false;
            }

        }

        return view('roles.permissions', compact('role', 'permissions'));
    }

    public function permissionsSync(Request $request, $role)
    {
        $permissionsRequest = $request -> except(['_token', '_method']);

        foreach($permissionsRequest as $key => $value)
        {
            $permissions [] = Permission::find($key);
        }

        $role = Role::find($role);
        if (!empty($permissions))
        {
            $role -> syncPermissions($permissions);
        }
        else
        {
            $role -> syncPermissions(null);
        }

        return redirect()->route('role.permissions', ['role' => $role -> id]);
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $roles = Roles::where('name', 'LIKE', "%{$request->search}%")->paginate(20);

            return view('roles.index', compact('roles', 'filters'));
    }
}
