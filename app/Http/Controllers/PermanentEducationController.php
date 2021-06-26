<?php

namespace App\Http\Controllers;

use App\Assistance;
use App\PermanentEducation;
use Illuminate\Http\Request;
use App\Http\Requests\PermanentEducationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class PermanentEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permanentsEducation = PermanentEducation::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.permanentsEducation.index', compact('permanentsEducation'));
    }

    /**
     * Show the form for creating a PermanentEducation resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Educação Permanente')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $assistances = Assistance::all();
        $action = route('permanentEducation.store');
        return view('sectors.permanentsEducation.form', compact('assistances', 'action'));
    }

    /**
     * Store a PermanentEducationly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermanentEducationRequest $request)
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
                    $path = $request->file('photo')->storeAs('public/permanentEducation', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            PermanentEducation::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'assistance_id' => $request->assistance_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('permanentEducation.index');

         }
         catch (\Exception $e)
         {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('permanentEducation.create');
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
        $permanentEducation = PermanentEducation::find($id);
        return view('sectors.permanentsEducation.show', compact('permanentEducation'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Educação Permanente')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $permanentEducation = PermanentEducation::with(['Assistance'])->find($id);
        $assistances = Assistance::all();
        $action = route('permanentEducation.update', $permanentEducation -> id);
        return view('sectors.permanentsEducation.form', compact('permanentEducation', 'assistances', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(PermanentEducationRequest $request, $id)
    {

        try {
            $permanentEducation = PermanentEducation::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/permanentEducation', $fileNameToStore);
                }
            }
            PermanentEducation::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'assistance_id' => $request->assistance_id,

            ]);

            $permanentEducation->assistance->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('permanentEducation.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('permanentEducation.edit', $id);
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
        if (!Auth::user()->hasPermissionTo('Excluir Setor Educação Permanente')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $permanentEducation = PermanentEducation::find($id);

            if ($permanentEducation->photo != 'noimage.jpg') {
                Storage::delete('public/permanentEducation/'. $permanentEducation->photo);
            }

            $permanentEducation->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('permanentEducation.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('permanentEducation.index');

    }
}
