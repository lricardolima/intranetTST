<?php

namespace App\Http\Controllers;

use App\Training;
use App\Financial;
use Illuminate\Http\Request;
use App\Http\Requests\FinancialRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financials = Financial::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.homes.financials.index', compact('financials'));
    }

    /**
     * Show the form for creating a financial resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $trainings = Training::all();
        $action = route('financial.store');
        return view('sectors.homes.financials.form', compact('trainings', 'action'));
  }

    /**
     * Store a financially created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FinancialRequest $request)
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
                    $path = $request->file('photo')->storeAs('public/financial', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            Financial::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'training_id' => $request->training_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('financial.index');

        }
         catch (\Exception $e)
        {

            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('financial.create');
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
        $financial = Financial::find($id);
        return view('sectors.homes.financials.show', compact('financial'));
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

        $financial = Financial::with(['training'])->find($id);
        $trainings = Training::all();
        $action = route('financial.update', $financial -> id);
        return view('sectors.homes.financials.form', compact('financial', 'trainings', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(FinancialRequest $request, $id)
    {

        try {
            $financial = Financial::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/financial', $fileNameToStore);
                }
            }
            Financial::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'training_id' => $request->training_id,

            ]);

            $financial->training->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('financial.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('financial.edit', $id);
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

            $financial = Financial::find($id);

            if ($financial->photo != 'noimage.jpg') {
                Storage::delete('public/financial/'. $financial->photo);
            }

            $financial->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('financial.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('financial.index');

    }
}
