<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'ASC')->paginate(20);

        return view('users.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            $request->validate([
                'name'=> 'required',
                'email'=> 'required',
                'password'=>'required',
            ]);

            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);

            return redirect()->route('user.index')->with(['color' => 'green', 'message' => 'Usuário foi cadastrada com sucesso!']);

        }

        catch (\Exception $e)
        {

            return redirect()->route('user.create')->with(['color' => 'orange', 'message' => 'Favor preencher os campos abaixo']);

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
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
            $user = User::find($id);

            $request->validate([
                'name'=> 'required',
                'email'=> 'required',
            ]);

            User::whereId($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);

            return redirect()->route('user.index')->with(['color' => 'green', 'message' => 'Usuário alterado com sucesso!']);
        }

        catch (\Exception $e)
        {
            $message = "Erro ao alterar o Usuário.";
            return redirect()->route('user.edit',$id)->with(['color' => 'orange', 'message' => 'Erro ao alterar o Usuàrio.']);
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
            User::destroy($id);
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'Erro ao excluir o Usuário.']);
        }

        return redirect()->route('user.index')->with(['color' => 'green', 'message' => 'Usuário excluida com sucesso!']);
    }

    public function roles($user)
    {
        $user = User::find($user);

        $roles = Role::all();

        foreach ($roles as $role)
        {
            if ($user->hasRole($role->name))
            {
                $role -> can = true;
            }
            else
            {
                $role -> can = false;
            }

        }

        return view('users.roles', compact('user', 'roles'));
    }

    public function rolesSync(Request $request, $user)
    {
        $rolesRequest = $request -> except(['_token', '_method']);

        foreach($rolesRequest as $key => $value)
        {
            $roles [] = Role::find($key);
        }

        $user = User::find($user);
        if (!empty($roles))
        {
            $user -> syncRoles($roles);
        }
        else
        {
            $user -> syncRoles(null);
        }

        return redirect()->route('user.roles', ['user' => $user -> id]);
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $users = User::where('name', 'LIKE', "%{$request->search}%")
        ->orWhere('email', 'LIKE',  "%{$request->search}%")->paginate(20);

            return view('users.index', compact('users', 'filters'));
    }
}
