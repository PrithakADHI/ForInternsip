<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\FAQ;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Team;
use App\Models\Course;
use App\Models\Slider;
use App\Models\Country;
use App\Models\Service;
use App\Models\University;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\StoreBlogRequest;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($class)
    {
        try {
            $blogs = $this->getObject($class)::get();
            
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $blogs,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $class)
    {
        try {

            $validation = Validator::make($request->all(), $this->getStoreValidation($class));


            if ($validation->fails()) {
                return response()->json(['statusCode' => 401, 'error' => true, 'error_message' => $validation->errors(), 'message' => 'Please fill the input field properly']);
            }

            $stored_data = $this->getObject($class)::create($request->all());
            $stored_data->update(['slug' => Str::slug($request->title)]);

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'message' => 'Successfully Inserted'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($class, $id)
    {
        try {
            $blog = $this->getObject($class)::find($id);
            if ($blog) {
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $blog,
                "message" => "Retrieved Successfully",
            ]);
        } else {
            return response()->json([
                "statusCode" => 401,
                "error" => true,
                "message" => "No Data Found",
            ]);
        }
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class, $id)
    {
        try {
            $validation = Validator::make($request->all(), [
                
            ]);

            if ($validation->fails()) {
                return response()->json(['statusCode' => 401, 'error' => true, 'error_message' => $validation->errors(), 'message' => 'Please fill the input field properly']);
            }

            $blog = $this->getObject($class)::find($id);
            $blog->update($request->all());

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'message' => 'Successfully Edited'
            ]);

        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($class, $id)
    {
        try {
            $blog = $this->getObject($class)::find($id);
            $blog->delete();
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'message' => 'Successfully Deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function getObject($class) {
        if ($class == 'blog') {
            return Blog::class;
        } else if ($class == 'country') {
            return Country::class;
        } else if ($class == 'course') {
            return Course::class;
        } else if ($class == 'service') {
            return Service::class;
        } else if ($class == 'university') {
            return University::class;
        } else if ($class == 'testimonial') {
            return Testimonial::class;
        } else if ($class == 'team') {
            return Team::class;
        } else if ($class == 'faq') {
            return FAQ::class;
        } else if ($class == 'page') {
            return Page::class;
        } else if ($class == 'slider') {
            return Slider::class;
        } else {
            throw new Exception('Class Not Found');
        }
    }

    public function getStoreValidation($class) {
        if ($class == 'blog') {
            return [
                'title' => 'required',
                'description' => 'required',
                'short_description' => 'required',
            ];
        } else if ($class == 'country') {
            return [
                'name' => 'required',
                'description' => 'required',
                'order' => 'required|integer',
                'short_description' => 'required',
            ];
        } else if ($class == 'course') {
            return [
                'name' => 'required',
                'description' => 'required',
                'order' => 'required|integer',
                'short_description' => 'required',
            ];
        } else if ($class == 'service') {
            return [
                'name' => 'required',
                'description' => 'required',
                'order' => 'required|integer',
                'short_description' => 'required',
            ];
        } else if ($class == 'university') {
            return [
                'name' => 'required',
                'description' => 'required',
                'order' => 'required|integer',
                'short_description' => 'required',
            ];
        } else if ($class == 'testimonial') {
            return [
                'name' => 'required',
                'description' => 'required',
                'order' => 'required|integer',
                'short_description' => 'required',
            ];
        } else if ($class == 'team') {
            return [
                'name' => 'required',
                'description' => 'required',
                'order' => 'required|integer',
                'short_description' => 'required',
            ];
        } else if ($class == 'faq') {
            return [
                'name' => 'required',
                'description' => 'required',
                'order' => 'required|integer',
                'short_description' => 'required',
            ];
        } else if ($class == 'page') {
            return [
                'name' => 'required',
                'description' => 'required',
                'order' => 'required|integer',
                'short_description' => 'required',
            ];
        } else if ($class == 'slider') {
            return [
                'slogan' => 'required',
                'title' => 'required',
                'order' => 'required|integer',
                'description' => 'required',
            ];
        } else {
            throw new Exception('Class Not Found');
        }
    }
    
}
