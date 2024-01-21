<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use App\Models\Demand;
use App\Models\Country;
use App\Models\Package;
use App\Models\Partner;
use App\Models\Service;
use App\Models\University;
use App\Models\Destination;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = Blog::count();
        $countries = Country::count();
        $courses = Course::count();
        $services = Service::count();
        $universities = University::count();
        return view('admin.dashboard', compact('blogs', 'countries', 'courses', 'services', 'universities'));
    }
}
