<?php

namespace App\Http\Controllers;

use App\Assistance;
use App\MedicalRelationship;
use Illuminate\Http\Request;
use App\Http\Requests\MedicalRelationshipRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class MedicalRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicalRelationships = MedicalRelationship::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.medicalRelationships.index', compact('medicalRelationships'));
    }

    /**
     * Show the form for creating a medicalRelationship resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Relacionamento Medico')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $assistances = Assistance::all();
        $action = route('medicalRelationship.store');
        return view('sectors.medicalRelationships.form', compact('assistances', 'action'));
    }

    /**
     * Store a medicalRelationshiply created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicalRelationshipRequest $request)
    {

         try {

            $request['slug'] = Str::slug($request->title);

            $data = $request->all();

            if($request->photo && $request->photo->isValid())
            {
                $filenameWithExt = $request->file('photo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('photo')->storeAs('public/medicalRelationship', $fileNameToStore);
                $data['photo'] = $fileNameToStore;
            }

            MedicalRelationship::create($data);

            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('medicalRelationship.index');

         }
         catch (\Exception $e)
         {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('medicalRelationship.create');
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
        $medicalRelationship = MedicalRelationship::find($id);
        return view('sectors.medicalRelationships.show', compact('medicalRelationship'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Setor Relacionamento Medico')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $medicalRelationship = MedicalRelationship::with(['Assistance'])->find($id);
        $assistances = Assistance::all();
        $action = route('medicalRelationship.update', $medicalRelationship -> id);
        return view('sectors.medicalRelationships.form', compact('medicalRelationship', 'assistances', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(medicalRelationshipRequest $request, $id)
    {

        try {

            $medicalRelationship = medicalRelationship::find($id);

            $data = $request->all();

            if($request->photo && $request->photo->isValid())
            {
                if( Storage::exists('public/medicalRelationship/'. $medicalRelationship->photo))
                {
                    Storage::delete('public/medicalRelationship/'. $medicalRelationship->photo);
                }
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/medicalRelationship', $fileNameToStore);
                    $data['photo'] = $fileNameToStore;

           }

            $medicalRelationship->update($data);

            $medicalRelationship->assistance->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('medicalRelationship.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('medicalRelationship.edit', $id);
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
        if (!Auth::user()->hasPermissionTo('Excluir Setor Relacionamento Medico')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $medicalRelationship = medicalRelationship::find($id);

            if ($medicalRelationship->photo != 'noimage.jpg') {
                Storage::delete('public/medicalRelationship/'. $medicalRelationship->photo);
            }

            $medicalRelationship->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('medicalRelationship.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('medicalRelationship.index');

    }
}
