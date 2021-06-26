<?php

namespace App\Http\Controllers;

use App\Administrative;
use Illuminate\Http\Request;
use App\Http\Requests\AdministrativeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;
use DB;
class AdministrativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administratives = Administrative::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.administratives.index', compact('administratives'));
    }

    /**
     * Show the form for creating a administrative resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $action = route('administrative.store');
        return view('sectors.administratives.form', compact('action'));
    }

    /**
     * Store a administratively created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdministrativeRequest $request)
    {
        try
        {
            if ($request ->hasFile('image'))
            {
                if($request->file('image')->isValid())
                {
                    $filenameWithExt = $request->file('image')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('image')->storeAs('public/administrative', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }
            Administrative::create([

                'name'=> $request->name,
                'url'=> $request->url,
                'image' => $fileNameToStore,
            ]);

            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('administrative.index');

        }

        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('administrative.create');
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
        $administrative = Administrative::find($id);
        return view('sectors.administratives.show', compact('administrative'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $administrative = Administrative::find($id);
        $action = route('administrative.update', $id);
        return view('sectors.administratives.form', compact('administrative', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdministrativeRequest $request, $id)
    {
        try
        {

            $administrative = Administrative::find($id);

            if ($request ->hasFile('image'))
            {
                if($request->file('image')->isValid())
                {
                    $filenameWithExt = $request->file('image')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('image')->storeAs('public/administrative', $fileNameToStore);
                }
            }

            Administrative::whereId($id)->update([

                'name'=> $request->name,
                'url'=> $request->url,
                'image' => $fileNameToStore,
            ]);

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('administrative.index');

        }

        catch (\Exception $e)

        {

            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('administrative.edit', $id);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,  $id)
    {
        if (!Auth::user()->hasPermissionTo('Excluir Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $administrative = Administrative::find($id);

            if ( $administrative->technology != null) {
                $administrative->technology->delete();
            }elseif ( $administrative->humanResource != null) {
                $administrative->humanResource->delete();
            }elseif ( $administrative->sesmt != null) {
                $administrative->sesmt->delete();
            }elseif ( $administrative->marketing != null) {
                $administrative->marketing->delete();
            }elseif ( $administrative->personalDepartament != null) {
                $administrative->personalDepartament->delete();
            }

            if ($administrative->image != 'noimage.jpg') {
                Storage::delete('public/administrative/'. $administrative->image);
            }

            $administrative->delete();


        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('administrative.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('administrative.index');

    }
}
