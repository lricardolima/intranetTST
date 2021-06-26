<?php

namespace App\Http\Controllers;

use App\Assistance;
use App\Ccih;
use Illuminate\Http\Request;
use App\Http\Requests\CcihRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class CcihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ccihs = Ccih::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.ccihs.index', compact('ccihs'));
    }

    /**
     * Show the form for creating a ccih resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Ccih')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $assistances = Assistance::all();
        $action = route('ccih.store');
        return view('sectors.ccihs.form', compact('assistances', 'action'));
    }

    /**
     * Store a ccihly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CcihRequest $request)
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
                    $path = $request->file('photo')->storeAs('public/ccih', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            Ccih::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'assistance_id' => $request->assistance_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('ccih.index');

         }
         catch (\Exception $e)
         {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('ccih.create');
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
        $ccih = Ccih::find($id);
        return view('sectors.ccihs.show', compact('ccih'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Ccih')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $ccih = Ccih::with(['Assistance'])->find($id);
        $assistances = Assistance::all();
        $action = route('ccih.update', $ccih -> id);
        return view('sectors.ccihs.form', compact('ccih', 'assistances', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ccihRequest $request, $id)
    {

        try {
            $ccih = Ccih::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/ccih', $fileNameToStore);
                }
            }
            Ccih::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'assistance_id' => $request->assistance_id,

            ]);

            $ccih->assistance->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('ccih.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('ccih.edit', $id);
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
        if (!Auth::user()->hasPermissionTo('Excluir Setor Ccih')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $ccih = Ccih::find($id);

            if ($ccih->photo != 'noimage.jpg') {
                Storage::delete('public/ccih/'. $ccih->photo);
            }

            $ccih->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('ccih.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('ccih.index');

    }
}
