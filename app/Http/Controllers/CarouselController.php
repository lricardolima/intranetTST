<?php

namespace App\Http\Controllers;

use App\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousels = Carousel::orderBy('created_at', 'DESC')->paginate(12);
        return view('carousels.index', compact('carousels'));
    }

    /**
     * Show the form for creating a carousel resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Carousel')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        return view('carousels.create');
    }

    /**
     * Store a carouselly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {

            $data = $request->all();

            $request -> validate([

                'photo' => 'image|nullable|max:1999',

            ]);

            if($request->photo && $request->photo->isValid())
            {
                $filenameWithExt = $request->file('photo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('photo')->storeAs('public/carousel', $fileNameToStore);
                $data['photo'] = $fileNameToStore;
            }

            Carousel::create($data);


            return redirect()->route('carousel.index')->with(['color' => 'green', 'message' => 'Treinamento cadastrado com sucesso!']);

        }

        catch (\Exception $e)
        {
            return redirect()->route('carousel.create')->with(['color' => 'orange', 'message' => 'OOps!!, Favor preencher todos os campos abaixo.']);
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
        $carousel = Carousel::find($id);
        return view('carousel.show', compact('carousel'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Carousel')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $carousel = Carousel::find($id);
        return view('carousels.edit', compact('carousel'));
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

            $carousel = Carousel::find($id);

            $request->validate([

                'photo' => 'image|nullable|max:1999',
            ]);

            $data = $request->all();

            if($request->photo && $request->photo->isValid())
            {
                if( Storage::exists('public/carousel/'. $carousel->photo))
                {
                    Storage::delete('public/carousel/'. $carousel->photo);
                }
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/carousel', $fileNameToStore);
                    $data['photo'] = $fileNameToStore;

           }

          $carousel->update($data);

            return redirect()->route('carousel.index')->with(['color'=>'green', 'message'=> 'Treinamento alterado com sucesso!']);

        }

        catch (\Exception $e)

        {

            return redirect()->route('carousel.edit',$id)->with(['color'=>'orange', 'message'=> 'OOps!!!, altere os campos abaixo.']);

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
        if (!Auth::user()->hasPermissionTo('Excluir Carousel')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $carousel = Carousel::find($id);

            if ($carousel->photo != 'noimage.jpg') {
                Storage::delete('public/carousel/'. $carousel->photo);
            }

            $carousel->delete();
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'Erro ao excluir o treinamento.']);
        }

        return redirect()->route('carousel.index')->with(['color' => 'green', 'message' => 'Treinamento excluido com sucesso!']);
    }
}
