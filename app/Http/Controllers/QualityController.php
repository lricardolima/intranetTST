<?php

namespace App\Http\Controllers;

use App\Assistance;
use App\Quality;
use Illuminate\Http\Request;
use App\Http\Requests\QualityRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class QualityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualities = Quality::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.qualities.index', compact('qualities'));
    }

    /**
     * Show the form for creating a Quality resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Qualidade')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $assistances = Assistance::all();
        $action = route('quality.store');
        return view('sectors.qualities.form', compact('assistances', 'action'));
    }

    /**
     * Store a Qualityly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QualityRequest $request)
    {


            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/quality', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            Quality::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'assistance_id' => $request->assistance_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('quality.index');



    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quality = Quality::find($id);
        return view('sectors.qualities.show', compact('quality'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Qualidade')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $quality = Quality::with(['Assistance'])->find($id);
        $assistances = Assistance::all();
        $action = route('quality.update', $quality -> id);
        return view('sectors.qualities.form', compact('quality', 'assistances', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(QualityRequest $request, $id)
    {

        try {
            $quality = Quality::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/quality', $fileNameToStore);
                }
            }
            Quality::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'assistance_id' => $request->assistance_id,

            ]);

            $quality->assistance->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('quality.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('quality.edit', $id);
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
        if (!Auth::user()->hasPermissionTo('Excluir Setor Qualidade')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $quality = Quality::find($id);

            if ($quality->photo != 'noimage.jpg') {
                Storage::delete('public/quality/'. $quality->photo);
            }

            $quality->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('quality.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('quality.index');

    }
}
