<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class AboutController extends Controller
{
    public function index()
    {
        $settings = Setting::get();
        $teams = Team::get();

        return view('frontend.about', compact('teams', 'settings'));
    }
}
