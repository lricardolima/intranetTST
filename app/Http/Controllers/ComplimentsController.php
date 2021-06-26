<?php

namespace App\Http\Controllers;

use App\Compliments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class ComplimentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compliments = Compliments::orderBy('created_at', 'DESC')->paginate(12);
        return view('compliments.index', compact('compliments'));
    }

    /**
     * Show the form for creating a compliments resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Elogio')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        return view('compliments.create');
    }

    /**
     * Store a complimentsly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $request -> validate([

                'title'=>'required',
                'compliments' => 'required',
                'responsible' => 'required',

            ]);

            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/compliments', $fileNameToStore);
                }
            }
            else
            {
                $fileNameToStore = 'noimage.jpg';
            }

            Compliments::create([

                'title'=> $request->title,
                'photo' => $fileNameToStore,
                'compliments' => $request->compliments,
                'responsible' => $request->responsible,

            ]);

            return redirect()->route('compliment.index')->with(['color' => 'green', 'message' => 'Elogio cadastrada com sucesso!']);

        }

        catch (\Exception $e)
        {
            return redirect()->route('compliment.create')->with(['color' => 'orange', 'message' => 'OOps!!, Favor preencher todos os campos abaixo.']);
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
        $compliment = Compliments::find($id);
        return view('compliments.show', compact('compliment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Elogio')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $compliment = Compliments::find($id);
        return view('compliments.edit', compact('compliment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {

            $compliment = Compliments::find($id);

            $request->validate([

               'title'=>'required',
                'compliments' => 'required',
                'responsible' => 'required',

            ]);
            if ($request ->hasFile('photo'))
            {
                if($request->file('photo')->isValid())
                {
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/compliments', $fileNameToStore);
                }
            }

            Compliments::whereId($id)->update([

                'title'=> $request->title,
                'photo' => $fileNameToStore,
                'compliments' => $request->compliments,
                'responsible' => $request->responsible,

            ]);

            return redirect()->route('compliment.index')->with(['color'=>'green', 'message'=> 'Elogio alterada com sucesso!']);

        }

        catch (\Exception $e)

        {

            return redirect()->route('compliment.edit',$id)->with(['color'=>'orange', 'message'=> 'OOps!!!, altere os campos abaixo.']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $compliment = Compliments::find($id);

            if ($compliment->photo != 'noimage.jpg') {
                Storage::delete('public/compliments/'. $compliment->photo);
            }

            $compliment->delete();
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'Erro ao excluir o Elogio.']);
        }

        return redirect()->route('compliments.index')->with(['color' => 'green', 'message' => 'Elogio excluida com sucesso!']);
    }
}
