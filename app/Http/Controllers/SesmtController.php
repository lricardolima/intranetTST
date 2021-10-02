<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\Sesmt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\SesmtRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class SesmtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sesmts = Sesmt::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.sesmts.index', compact('sesmts'));
    }

    /**
     * Show the form for creating a sesmt resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Sesmt')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $administratives = Administrative::all();
        $action = route('sesmt.store');
        return view('sectors.sesmts.form', compact('administratives', 'action'));
    }

    /**
     * Store a sesmtly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(sesmtRequest $request)
    {

         try
          {

            $request['slug'] = Str::slug($request->title);

            $data = $request->all();

            if($request->photo && $request->photo->isValid())
            {
                $filenameWithExt = $request->file('photo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('photo')->storeAs('public/sesmt', $fileNameToStore);
                $data['photo'] = $fileNameToStore;
            }

            Sesmt::create($data);

            return redirect()->route('sesmt.index')->with(['color' => 'green', 'message' => 'Cadastro realizado com sucesso!']);

         }
         catch (\Exception $e)
         {
            return redirect()->route('sesmt.create')->with(['color' => 'orange', 'message' => 'OOps!!, Favor preencher todos os campos abaixo.']);
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
        $sesmt = Sesmt::find($id);
        return view('sectors.sesmts.show', compact('sesmt'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Setor Sesmt')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $sesmt = Sesmt::with(['administrative'])->find($id);
        $administratives = Administrative::all();
        $action = route('sesmt.update', $sesmt -> id);
        return view('sectors.sesmts.form', compact('sesmt', 'administratives', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(sesmtRequest $request, $id)
    {

        try
        {

            $sesmt = Sesmt::find($id);

            $data = $request->all();

            if($request->photo && $request->photo->isValid())
            {
                if( Storage::exists('public/sesmt/'. $sesmt->photo))
                {
                    Storage::delete('public/sesmt/'. $sesmt->photo);
                }
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/sesmt', $fileNameToStore);
                    $data['photo'] = $fileNameToStore;

           }

            $sesmt->update($data);

            $sesmt->administrative->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('sesmt.index');

        }

        catch (\Exception $e)

        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('sesmt.edit', $id);
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
        if (!Auth::user()->hasPermissionTo('Excluir Setor Sesmt')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $sesmt = Sesmt::find($id);

            if ($sesmt->photo != 'noimage.jpg') {
                Storage::delete('public/sesmt/'. $sesmt->photo);
            }

            $sesmt->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('sesmt.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('sesmt.index');

    }
}
