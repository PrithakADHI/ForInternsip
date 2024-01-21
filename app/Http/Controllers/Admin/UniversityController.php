<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUniversityRequest;
use App\Http\Requests\Admin\UpdateUniversityRequest;
use App\Models\University;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;


class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities = University::oldest('order')->paginate(10);
        return view('admin.university.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.university.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUniversityRequest $request)
    {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image');
        $input['other_image'] = $this->fileUpload($request, 'other_image');
        $university =  University::create($input);
        $university->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.universities.index')->with('message', 'Created Successfully');
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
    public function edit(University $university)
    {
        return view('admin.university.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUniversityRequest $request, University $university)
    {
        $old_image = $university->image;
        $old_other_image = $university->other_image;
        $input = $request->all();
        $image = $this->fileUpload($request, 'image');
        $other_image = $this->fileUpload($request, 'other_image');

        if ($image) {
            $this->removeFile($old_image);
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        if ($other_image) {
            $this->removeFile($old_other_image);
            $input['other_image'] = $other_image;
        } else {
            unset($input['other_image']);
        }

        $input['slug'] = Str::slug($request->name);
        $university->update($input);
        return redirect()->route('admin.universities.index')->with('message', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        $this->removeFile($university->image);
        $this->removeFile($university->other_image);
        $university->delete();
        return redirect()->route('admin.universities.index')->with('message', 'Delete Successfully');
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/university';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }

    public function removeFile($file)
    {
        $path = public_path() . '/admin/images/university/' . $file;
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
