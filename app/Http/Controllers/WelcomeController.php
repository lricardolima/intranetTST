<?php

namespace App\Http\Controllers;
use App\Carousel;
use App\Compliments;
Use Carbon\Carbon;
use App\birthday;
use App\Menu;
use App\Notice;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datetoday = Carbon::now();
        $carousels = Carousel::all();
        $notices = Notice::orderBy('created_at', 'DESC')->limit(6)->get();
        $compliments = Compliments::orderBy('created_at', 'DESC')->limit(3)->get();
        $birthdays = Birthday::whereMonth('date', $datetoday->month)->whereDay('date', $datetoday->day)->orderByRaw('day(date) asc')->limit(8)->get();
        $data = [
            'carousels'=>$carousels,
            'birthdays'=>$birthdays,
            'notices'=>$notices,
            'compliments'=>$compliments,
        ];
        return view('welcome', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
