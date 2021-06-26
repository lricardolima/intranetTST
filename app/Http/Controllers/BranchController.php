<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branchs = Branch::orderBy('sector','ASC')->paginate(20);
        return view('branchs.index', compact('branchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Ramal')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        return view('branchs.create');
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
            $request['slug'] = Str::slug($request->sector);

            $branch = Branch::where('branch', $request->branch )->get();
            if ($branch->count() > 0)
             {
                return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'OOps!!, o número desse ramal já foi cadastrado.']);
             }

            $request->validate([

                'branch'=>'required|max:4|unique:branch',
                'sector'=>'required',
                'operation_initial'=>'required',
                'operation_end'=>'required',
                'collaborator'=>'required|min:3',

            ]);

            Branch::create([

               'branch'=>$request->branch,
               'sector'=>$request->sector,
               'operation_initial'=>$request->operation_initial,
               'operation_end'=>$request->operation_end,
               'collaborator'=>$request->collaborator,

            ]);

            return redirect()->route('branch.index')->with(['color'=>'green', 'message'=> 'Ramal criado com sucesso!']);
        }

        catch (\Exception $e)
        {
            return redirect()->route('branch.create')->with(['color' => 'orange', 'message' => 'OOps!!, Favor preencher todos os campos abaixo.']);
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
        $branchs = Branch::find($id);
        return view('branchs.show', compact('branchs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Ramal')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $branch = Branch::find($id);
        return view('branchs.edit', compact('branch'));
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

            $branch = Branch::where('branch', $request->branch )->where('id', '!=', $id)->get();
            if ($branch->count() > 0)
             {
                return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'OOps!!, o número desse ramal já foi cadastrado.']);
             }

            $branch = Branch::find($id);

            $request->validate([
                'branch'=> 'required|max:4',
                'sector'=> 'required',
                'operation_initial'=> 'required',
                'operation_end'=> 'required',
                'collaborator'=> 'required|min:3',
            ]);

            Branch::whereId($id)->update([
                'branch'=>$request->branch,
                'sector'=>$request->sector,
                'operation_initial'=>$request->operation_initial,
                'operation_end'=>$request->operation_end,
                'collaborator'=>$request->collaborator,
            ]);

            return redirect()->route('branch.index')->with(['color'=>'green', 'message'=> 'Ramal alterado com sucesso!']);

        }

        catch (\Exception $e)

        {

            return redirect()->route('branch.edit',$id)->with(['color'=>'orange', 'message'=> 'OOps!!!, altere os campos abaixo.']);

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
        if (!Auth::user()->hasPermissionTo('Excluir Ramal')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            Branch::destroy($id);
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'Erro ao excluir o Ramal.']);
        }

        return redirect()->route('branch.index')->with(['color' => 'green', 'message' => 'Ramal excluido com sucesso.']);
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
      
        $branchs = Branch::where('sector', 'LIKE', "%{$request->search}%")
        ->orWhere('collaborator', 'LIKE',  "%{$request->search}%")->paginate(20);
    
            return view('branchs.index', compact('branchs', 'filters'));
    }
}
