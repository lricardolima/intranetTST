<?php

namespace App\Http\Controllers;

use App\Birthday;
Use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class BirthdayController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datetoday = Carbon::now();
        $birthdays = Birthday::whereMonth('date', $datetoday->month)->orderByRaw('day(date) asc')->paginate(10);
        return view('birthdays.index', compact('birthdays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Aniversario')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        return view('birthdays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $request['slug'] = Str::slug($request->mame);

            $data = $request->all();

            $request -> validate([

                'name'=>'required',
                'date' => 'required',
                'sector' => 'required',
                'photo' => 'image|nullable|max:1999',
                'cpf' => 'nullable',

            ]);

            if($request->photo && $request->photo->isValid())
            {
                $filenameWithExt = $request->file('photo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('photo')->storeAs('public/birthday', $fileNameToStore);
                $data['photo'] = $fileNameToStore;
            }

            Birthday::create($data);

            return redirect()->route('birthday.index')->with(['color' => 'green', 'message' => 'Aniversáriante cadastrada com sucesso!']);

        }

        catch (\Exception $e)
        {
            return redirect()->route('birthday.create')->with(['color' => 'orange', 'message' => 'OOps!!, Favor preencher todos os campos abaixo.']);
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
        $birthday = birthday::find($id);
        return view('birthdays.show', compact('birthday'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Aniversario')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        $birthday = Birthday::find($id);
        return view('birthdays.edit', compact('birthday'));
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

            $birthday = Birthday::find($id);

            $request->validate([

                'name'=>'required',
                'date' => 'required',
                'sector' => 'required',
                'photo' => 'image|nullable|max:1999',
                'cpf' => 'nullable',

            ]);
            $data = $request->all();

            if($request->photo && $request->photo->isValid())
            {
                if( Storage::exists('public/birthday/'. $birthday->photo))
                {
                    Storage::delete('public/birthday/'. $birthday->photo);
                }
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/birthday', $fileNameToStore);
                    $data['photo'] = $fileNameToStore;

           }

          $birthday->update($data);

            return redirect()->route('birthday.index')->with(['color'=>'green', 'message'=> 'Aniversáriante alterado com sucesso!']);

        }

        catch (\Exception $e)

        {

            return redirect()->route('birthday.edit',$id)->with(['color'=>'orange', 'message'=> 'OOps!!!, altere os campos abaixo.']);

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
        if (!Auth::user()->hasPermissionTo('Excluir Aniversario')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $birthday = Birthday::find($id);

            if ($birthday->photo != 'noimage.jpg') {
                Storage::delete('public/birthday/'. $birthday->photo);
            }

            $birthday->delete();
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'Erro ao excluir o Registro!.']);
        }

        return redirect()->route('birthday.index')->with(['color' => 'green', 'message' => 'Reistro excluido com sucesso!']);
    }
}
