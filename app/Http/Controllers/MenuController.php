<?php

namespace App\Http\Controllers;

use App\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::whereDate('date', '>=', Carbon::today())->orderBy('date', 'ASC')->limit(7)->paginate(7);
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Refeicao')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        return view('menus.create');
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
            $request['slug'] = Str::slug($request->meal);

            $request -> validate([

                'meal'=>'required',
                'description' => 'required',
                'date' => 'required',

            ]);

            Menu::create([

                'meal'=> $request->meal,
                'description' => $request->description,
                'date' => $request->date,

            ]);

            return redirect()->route('menu.index')->with(['color' => 'green', 'message' => 'Refeição cadastrada com sucesso!']);

        }

        catch (\Exception $e)
        {
            return redirect()->route('menu.create')->with(['color' => 'orange', 'message' => 'OOps!!, Favor preencher todos os campos abaixo.']);
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
        $menu = Menu::find($id);
        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Refeicao')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $menu = Menu::find($id);
        return view('menus.edit', compact('menu'));
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

            $menu = Menu::find($id);

            $request->validate([

                'meal'=>'required',
                'description' => 'required',
                'date' => 'required',

            ]);

            Menu::whereId($id)->update([

                'meal'=> $request->meal,
                'description' => $request->description,
                'date' => $request->date,

            ]);

            return redirect()->route('menu.index')->with(['color'=>'green', 'message'=> 'Refeição alterada com sucesso!']);

        }

        catch (\Exception $e)

        {

            return redirect()->route('menu.edit',$id)->with(['color'=>'orange', 'message'=> 'OOps!!!, altere os campos abaixo.']);

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
        if (!Auth::user()->hasPermissionTo('Excluir Refeicao')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            Menu::destroy($id);
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'Erro ao excluir a Refeição.']);
        }

        return redirect()->route('menu.index')->with(['color' => 'green', 'message' => 'Refeição excluida com sucesso!']);
    }

}
