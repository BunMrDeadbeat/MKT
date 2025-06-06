<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  //
  public function dashboard()
  {
    return view('adminDash');
  }

   public function blank()
  {
    return view('blank');
  }

  public function users()
  {
    return view('adminUsers');
  }

  public function products()
  {
    return view('adminProducts');
  }
}
