<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\Marketing;
use Illuminate\Http\Request;
use App\Http\Requests\MarketingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marketings = Marketing::orderBy('created_at', 'DESC')->paginate(12);
        return view('sectors.marketings.index', compact('marketings'));
    }

    /**
     * Show the form for creating a marketing resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Setor Marketing')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $administratives = Administrative::all();
        $action = route('marketing.store');
        return view('sectors.marketings.form', compact('administratives', 'action'));
    }

    /**
     * Store a marketingly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarketingRequest $request)
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
                    $path = $request->file('photo')->storeAs('public/marketing', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.png';
            }

            Marketing::create([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);


            $request->session()->flash('success', "Cadastro realizado com sucesso!");
            return redirect()->route('marketing.index');

         }
         catch (\Exception $e)
         {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('marketing.create');
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
        $marketing = Marketing::find($id);
        return view('sectors.marketings.show', compact('marketing'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Setor Marketing')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $marketing = Marketing::with(['administrative'])->find($id);
        $administratives = Administrative::all();
        $action = route('marketing.update', $marketing -> id);
        return view('sectors.marketings.form', compact('marketing', 'administratives', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(MarketingRequest $request, $id)
    {

        try {
            $marketing = Marketing::find($id);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/marketing', $fileNameToStore);
                }
            }
            Marketing::whereId($id)->update([

                'title'=> $request->title,
                'description' => $request->description,
                'photo' => $fileNameToStore,
                'type' => $request->type,
                'link' => $request->link,
                'responsible' => $request->responsible,
                'administrative_id' => $request->administrative_id,

            ]);

            $marketing->administrative->update($request->all());

            $request->session()->flash('success', "Cadastro alterado com sucesso!");

            return redirect()->route('marketing.index');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('error', "Cadastro não foi realizado!");
            return redirect()->route('marketing.edit', $id);
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
        if (!Auth::user()->hasPermissionTo('Excluir Setor Marketing')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $marketing = marketing::find($id);

            if ($marketing->photo != 'noimage.jpg') {
                Storage::delete('public/marketing/'. $marketing->photo);
            }

            $marketing->delete();
        }

        catch (\Exception $e)
        {
            $request->session()->flash('message', "Erro ao exclur!");
            return redirect()->route('marketing.index');
        }

        $request->session()->flash('success', "Cadastro excluido com sucesso!");
        return redirect()->route('marketing.index');

    }
}
