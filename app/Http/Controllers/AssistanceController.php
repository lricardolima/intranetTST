<?php

namespace App\Http\Controllers;

use App\Assistance;
use Illuminate\Http\Request;
use App\Http\Requests\AssistanceRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;
use DB;

class AssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assistances = Assistance::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.assistances.index', compact('assistances'));
    }

    /**
     * Show the form for creating a assistance resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $action = route('assistance.store');
        return view('sectors.assistances.form', compact('action'));
    }

    /**
     * Store a assistancely created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssistanceRequest $request)
    {
        try
        {

            
            $request['slug'] = Str::slug($request->title);

            $data = $request->all();

            if ($request ->hasFile('image'))
            {
                if($request->file('image')->isValid())
                {
                    $filenameWithExt = $request->file('image')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('image')->storeAs('public/assistance', $fileNameToStore);
                }
            }
           
            Assistance::create($data);

            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('assistance.index');

        }

        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('assistance.create');
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
        $assistance = Assistance::find($id);
        return view('sectors.assistances.show', compact('assistance'));
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

        $assistance = Assistance::find($id);
        $action = route('assistance.update', $id);
        return view('sectors.assistances.form', compact('assistance', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(assistanceRequest $request, $id)
    {
        try
        {

            $assistance = Assistance::find($id);

            $data = $request->all();

            if($request->image && $request->image->isValid())
            {
                if( Storage::exists('public/assistance/'. $assistance->image))
                {
                    Storage::delete('public/assistance/'. $assistance->image);
                }
                    $filenameWithExt = $request->file('image')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('image')->storeAs('public/assistance', $fileNameToStore);
                    $data['image'] = $fileNameToStore;

           }

          $assistance->update($data);


            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('assistance.index');

        }

        catch (\Exception $e)

        {

            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('assistance.edit', $id);

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
            $assistance = Assistance::find($id);

            if ( $assistance->quality != null) {
                $assistance->quality->delete();
            }elseif ( $assistance->permanentEducation != null) {
                $assistance->permanentEducation->delete();
            }elseif ( $assistance->sac != null) {
                $assistance->sac->delete();
            }elseif ( $assistance->ccih != null) {
                $assistance->ccih->delete();
            }elseif ( $assistance->medicalRelationship != null) {
                $assistance->ccih->delete();
            }

            if ($assistance->image != 'noimage.jpg') {
                Storage::delete('public/assistance/'. $assistance->image);
            }

            $assistance->delete();


        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('assistance.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('assistance.index');

    }

}
