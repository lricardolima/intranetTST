<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\Controllership;
use Illuminate\Http\Request;
use App\Http\Requests\ControllershipRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class ControllershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controllerships = Controllership::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.controllerships.index', compact('controllerships'));
    }

    /**
     * Show the form for creating a controllership resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Tecnologia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $administratives = Administrative::all();
        $action = route('controllership.store');
        return view('sectors.controllerships.form', compact('administratives', 'action'));
  }

    /**
     * Store a controllershiply created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ControllershipRequest $request)
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
                    $path = $request->file('photo')->storeAs('public/controllership', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            Controllership::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('controllership.index');

        }
         catch (\Exception $e)
        {

            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('controllership.create');
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
        $controllership = Controllership::find($id);
        return view('sectors.controllerships.show', compact('controllership'));
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

        $controllership = Controllership::with(['administrative'])->find($id);
        $administratives = administrative::all();
        $action = route('controllership.update', $controllership -> id);
        return view('sectors.controllerships.form', compact('controllership', 'administratives', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ControllershipRequest $request, $id)
    {

        try {
            $controllership = Controllership::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/controllership', $fileNameToStore);
                }
            }
            Controllership::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);

            $controllership->administrative->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('controllership.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('controllership.edit', $id);
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

            $controllership = Controllership::find($id);

            if ($controllership->photo != 'noimage.jpg') {
                Storage::delete('public/controllership/'. $controllership->photo);
            }

            $controllership->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('controllership.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('controllership.index');

    }

}
