<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Http\Request;
use App\Http\Requests\TrainingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;
use DB;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = Training::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.homes.trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a training resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $action = route('training.store');
        return view('sectors.homes.trainings.form', compact('action'));
    }

    /**
     * Store a trainingly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainingRequest $request)
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
                    $path = $request->file('photo')->storeAs('public/training', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }
            Training::create([

                'name'=> $request->name,
                'url'=> $request->url,
                'photo' => $fileNameToStore,
            ]);

            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('training.index');

        }

        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('training.create');
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
        $training = Training::find($id);
        return view('sectors.homes.trainings.show', compact('training'));
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

        $training = Training::find($id);
        $action = route('training.update', $id);
        return view('sectors.homes.trainings.form', compact('training', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TrainingRequest $request, $id)
    {
        try
        {

            $training = Training::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/training', $fileNameToStore);
                }
            }

            Training::whereId($id)->update([

                'name'=> $request->name,
                'url'=> $request->url,
                'photo' => $fileNameToStore,
            ]);

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('training.index');

        }

        catch (\Exception $e)

        {

            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('training.edit', $id);

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
            $training = training::find($id);

            if ( $training->attendance != null) {
                $training->attendance->delete();
            }

            if ($training->photo != 'noimage.jpg') {
                Storage::delete('public/training/'. $training->photo);
            }

            $training->delete();


        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('training.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('training.index');

    }

}




