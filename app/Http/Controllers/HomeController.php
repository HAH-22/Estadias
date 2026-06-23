<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Trainer;
use App\Models\GymConfig;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\SocialNetwork;
use App\Models\Slide;
use App\Models\Price;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $plans = Plan::all();
        $trainers = Trainer::all();
        $config = GymConfig::first();
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $schedules = Schedule::all();
        $socialNetworks = SocialNetwork::where('is_active', true)->orderBy('order')->get();
        $slides = Slide::where('is_active', true)->orderBy('order')->get();
        $prices = Price::where('is_active', true)->orderBy('order')->get();

        return view('index', compact('plans', 'trainers', 'config', 'services', 'schedules', 'socialNetworks', 'slides', 'prices'));
    }
}