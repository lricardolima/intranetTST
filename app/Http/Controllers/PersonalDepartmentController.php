<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\PersonalDepartment;
use Illuminate\Http\Request;
use App\Http\Requests\PersonalDepartmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class PersonalDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personalDepartments = PersonalDepartment::orderBy('type', 'DESC')->paginate(12);
        return view('sectors.personalDepartments.index', compact('personalDepartments'));
    }

    /**
     * Show the form for creating a personalDepartment resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Pessoal')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $administratives = Administrative::all();
        $action = route('personalDepartment.store');
        return view('sectors.personalDepartments.form', compact('administratives', 'action'));
    }

    /**
     * Store a personalDepartmently created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalDepartmentRequest $request)
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
                    $path = $request->file('photo')->storeAs('public/personalDepartment', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            PersonalDepartment::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('personalDepartment.index');

        } catch (\Exception $e) {

            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('personalDepartment.create');
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
        $personalDepartment = PersonalDepartment::find($id);
        return view('sectors.personalDepartments.show', compact('personalDepartment'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Setor Pessoal')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $personalDepartment = PersonalDepartment::with(['administrative'])->find($id);
        $administratives = Administrative::all();
        $action = route('personalDepartment.update', $personalDepartment -> id);
        return view('sectors.personalDepartments.form', compact('personalDepartment', 'administratives', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(personalDepartmentRequest $request, $id)
    {

        try {
            $personalDepartment = PersonalDepartment::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/personalDepartment', $fileNameToStore);
                }
            }
            PersonalDepartment::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);

            $personalDepartment->administrative->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('personalDepartment.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('personalDepartment.edit', $id);
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
        if (!Auth::user()->hasPermissionTo('Excluir Setor Pessoal')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $personalDepartment = PersonalDepartment::find($id);

            if ($personalDepartment->photo != 'noimage.jpg') {
                Storage::delete('public/personalDepartment/'. $personalDepartment->photo);
            }

            $personalDepartment->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('personalDepartment.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('personalDepartment.index');

    }
}
