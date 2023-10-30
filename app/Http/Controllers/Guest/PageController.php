<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;

class PageController extends Controller
{
  public function index()
  {
    $title = "Featured Projects";
    $projects = Project::orderByDesc("created_at")->paginate(8);

    return view('guest.home', compact('title', 'projects'));
  }
}