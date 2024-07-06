<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['meta_title']         = 'TrendyThreads';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';
  
  
        return view('home', $data);
    }
}
