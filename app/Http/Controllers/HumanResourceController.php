<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\HumanResource;
use Illuminate\Http\Request;
use App\Http\Requests\HumanResourceRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class HumanResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $humanResources = HumanResource::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.humanResources.index', compact('humanResources'));
    }

    /**
     * Show the form for creating a humanResource resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Recursos Humanos')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $administratives = Administrative::all();
        $action = route('humanResource.store');
        return view('sectors.humanResources.form', compact('administratives', 'action'));
    }

    /**
     * Store a humanResourcely created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HumanResourceRequest $request)
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
                    $path = $request->file('photo')->storeAs('public/humanResource', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            HumanResource::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('humanResource.index');

         }
         catch (\Exception $e)
         {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('humanResource.create');
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
        $humanResource = HumanResource::find($id);
        return view('sectors.humanResources.show', compact('humanResource'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Setor Recursos Humanos')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $humanResource = HumanResource::with(['administrative'])->find($id);
        $administratives = Administrative::all();
        $action = route('humanResource.update', $humanResource -> id);
        return view('sectors.humanResources.form', compact('humanResource', 'administratives', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(HumanResourceRequest $request, $id)
    {

        try {
            $humanResource = HumanResource::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/humanResource', $fileNameToStore);
                }
            }
            HumanResource::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);

            $humanResource->administrative->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('humanResource.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('humanResource.edit', $id);
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
        if (!Auth::user()->hasPermissionTo('Excluir Setor Recursos Humanos')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $humanResource = HumanResource::find($id);

            if ($humanResource->photo != 'noimage.jpg') {
                Storage::delete('public/humanResource/'. $humanResource->photo);
            }

            $humanResource->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('humanResource.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('humanResource.index');

    }
}
