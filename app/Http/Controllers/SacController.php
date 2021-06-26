<?php

namespace App\Http\Controllers;

use App\Assistance;
use App\Sac;
use Illuminate\Http\Request;
use App\Http\Requests\SacRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class SacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sacs = Sac::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.sacs.index', compact('sacs'));
    }

    /**
     * Show the form for creating a sac resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Ouvidoria')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $assistances = Assistance::all();
        $action = route('sac.store');
        return view('sectors.sacs.form', compact('assistances', 'action'));
    }

    /**
     * Store a sacly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(sacRequest $request)
    {

         try {
            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/sac', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            Sac::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'assistance_id' => $request->assistance_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('sac.index');

         }
         catch (\Exception $e)
         {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('sac.create');
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
        $sac = Sac::find($id);
        return view('sectors.sacs.show', compact('sac'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Ouvidoria')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $sac = Sac::with(['Assistance'])->find($id);
        $assistances = Assistance::all();
        $action = route('sac.update', $sac -> id);
        return view('sectors.sacs.form', compact('sac', 'assistances', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(sacRequest $request, $id)
    {

        try {
            $sac = Sac::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/sac', $fileNameToStore);
                }
            }
            Sac::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'assistance_id' => $request->assistance_id,

            ]);

            $sac->assistance->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('sac.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('sac.edit', $id);
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
        if (!Auth::user()->hasPermissionTo('Excluir Setor Ouvidoria')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $sac = Sac::find($id);

            if ($sac->photo != 'noimage.jpg') {
                Storage::delete('public/sac/'. $sac->photo);
            }

            $sac->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('sac.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('sac.index');

    }
}
