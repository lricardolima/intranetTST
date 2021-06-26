<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\Technology;
use Illuminate\Http\Request;
use App\Http\Requests\TechnologyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a technology resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $administratives = Administrative::all();
        $action = route('technology.store');
        return view('sectors.technologies.form', compact('administratives', 'action'));
    }

    /**
     * Store a technologyly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(technologyRequest $request)
    {

        try
        {
            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/technology', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            Technology::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('technology.index');


        }

         catch (\Exception $e)
        {
                $request->session()->flash('error', "Cadastro não foi realizado!");
                return redirect()->route('technology.edit' , $id);
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
        $technology = Technology::find($id);
        return view('sectors.technologies.show', compact('technology'));
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

        $technology = technology::with(['administrative'])->find($id);
        $administratives = Administrative::all();
        $action = route('technology.update', $technology -> id);
        return view('sectors.technologies.form', compact('technology', 'administratives', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(technologyRequest $request, $id)
    {

        try {
            $technology = Technology::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/technology', $fileNameToStore);
                }
            }
            Technology::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);

            $technology->administrative->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('technology.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('technology.edit' , $id);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('Excluir Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $technology = Technology::find($id);

            if ($technology->photo != 'noimage.jpg') {
                Storage::delete('public/technology/'. $technology->photo);
            }

            $technology->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('technology.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('technology.index');

    }
}
