<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Validator,redirect,Response,File;

class NoticeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::orderBy('created_at', 'DESC')->paginate(12);
        return view('notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a notice resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Noticia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        return view('notices.create');
    }

    /**
     * Store a noticely created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $request['slug'] = Str::slug($request->title);

            $data = $request->all();

            $request -> validate([

                'title'=>'required',
                'notice' => 'required',
                'photo' => 'image|nullable|max:1999',
                'responsible' => 'required',

            ]);

            if($request->photo && $request->photo->isValid())
            {
                $filenameWithExt = $request->file('photo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('photo')->storeAs('public/notice', $fileNameToStore);
                $data['photo'] = $fileNameToStore;
            }

            Notice::create($data);

            return redirect()->route('notice.index')->with(['color' => 'green', 'message' => 'Notícia cadastrada com sucesso!']);

        }

        catch (\Exception $e)
        {
            return redirect()->route('notice.create')->with(['color' => 'orange', 'message' => 'OOps!!, Favor preencher todos os campos abaixo.']);
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
        $notice = Notice::find($id);
        return view('notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Noticia')) {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }
        $notice = Notice::find($id);
        return view('notices.edit', compact('notice'));
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

            $notice = Notice::find($id);

            $request->validate([

               'title'=>'required',
                'notice' => 'required',
                'photo' => 'image|nullable|max:1999',
                'responsible' => 'required',

            ]);

            $data = $request->all();

            if($request->photo && $request->photo->isValid())
            {
                if( Storage::exists('public/notice/'. $notice->photo))
                {
                    Storage::delete('public/notice/'. $notice->photo);
                }
                    $filenameWithExt = $request->file('photo')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $request->file('photo')->storeAs('public/notice', $fileNameToStore);
                    $data['photo'] = $fileNameToStore;

           }

          $notice->update($data);

            return redirect()->route('notice.index')->with(['color'=>'green', 'message'=> 'Notícia alterada com sucesso!']);

        }

        catch (\Exception $e)

        {

            return redirect()->route('notice.edit',$id)->with(['color'=>'orange', 'message'=> 'OOps!!!, altere os campos abaixo.']);

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
        if (!Auth::user()->hasPermissionTo('Excluir Noticia'))
        {
            throw new UnauthorizedException( 403, 'Você não tem permissão requerida!');
        }

        try
        {
            $notice = Notice::find($id);

            if ($notice->photo != 'noimage.jpg') {
                Storage::delete('public/notice/'. $notice->photo);
            }

            $notice->delete();
        }


        catch (\Exception $e)
        {
            return redirect()->back()->withInput()->with(['color' => 'orange', 'message' => 'Erro ao excluir a Notícia.']);
        }

        return redirect()->route('notice.index')->with(['color' => 'green', 'message' => 'Notícia excluida com sucesso!']);
    }

}
