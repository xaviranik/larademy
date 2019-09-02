<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Series;

class FrontendController extends Controller
{
    public function welcome()
    {
        return view('welcome')->withSeries(Series::all());
    }

    public function home()
    {
        $series = Series::all();
        return view('home')->withSeries($series);
    }

    public function series(Series $series)
    {
        return view('series')->withSeries($series);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('welcome');
    }
}
