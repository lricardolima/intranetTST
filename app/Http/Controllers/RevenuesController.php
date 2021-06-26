<?php

namespace App\Http\Controllers;

use App\Training;
use App\Revenues;
use Illuminate\Http\Request;
use App\Http\Requests\RevenuesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class RevenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $revenues = Revenues::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.homes.revenues.index', compact('revenues'));
    }

    /**
     * Show the form for creating a revenues resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $trainings = Training::all();
        $action = route('revenues.store');
        return view('sectors.homes.revenues.form', compact('trainings', 'action'));
  }

    /**
     * Store a revenuesly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RevenuesRequest $request)
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
                    $path = $request->file('photo')->storeAs('public/revenues', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            Revenues::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'training_id' => $request->training_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('revenues.index');

        } catch (\Exception $e) {

            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('revenues.create');
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
        $revenues = Revenues::find($id);
        return view('sectors.revenues.show', compact('revenues'));
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

        $revenues = revenues::with(['training'])->find($id);
        $trainings = Training::all();
        $action = route('revenues.update', $revenues -> id);
        return view('sectors.homes.revenues.form', compact('revenues', 'trainings', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(revenuesRequest $request, $id)
    {

        try {
            $revenues = Revenues::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/revenues', $fileNameToStore);
                }
            }
            Revenues::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'training_id' => $request->training_id,

            ]);

            $revenues->training->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('revenues.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('revenues.edit', $id);
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
            $revenues = revenues::find($id);

            if ($revenues->photo != 'noimage.jpg') {
                Storage::delete('public/revenues/'. $revenues->photo);
            }

            $revenues->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('revenues.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('revenues.index');

    }
}
