<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Bine ați venit în Parcul Național Retezat';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        return view('pages.services');
        /*$data = array(
            'title' => 'Services'
        );
        return view('pages.services')->($data);*/

    }
    public function retezat(){
        return view('pages.retezat');
    }
    public function retezatulmic(){
        return view('pages.retezatulmic');
    }
}
