<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends Controller
{
    public function index() {
        $teams = Team::orderBy('order')->paginate(10);
        return view('admin.teams.index', compact('teams'));
    }

    public function create() {
        return view('admin.teams.create');
    }

    public function store(StoreTeamRequest $request) {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image', '/admin/images/teams');

        $team = Team::create($input);
        $team->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.teams.index')->with('message', 'Created Successfully');

    }

    public function show() {
        return '';
    }

    public function edit(Team $team) {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(UpdateTeamRequest $request, Team $team) {
        $old_image = $team->image;
        $input = $request->all();

        $image = $this->fileUpload($request, 'image', '/admin/images/teams/');

        if ($image) {
            $this->removeFile($old_image, '/admin/images/teams');
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $team->update($input);
        return redirect()->route('admin.teams.index')->with('message', 'Updated Successfully');

    }

    public function destroy(Team $team) {
        $this->removeFile($team->image, '/admin/images/teams/');
        $team->delete();
        return redirect()->route('admin.teams.index')->with('message', 'Deleted Successfully');
    }

    public function fileUpload(Request $request, $name, $path)

{

$imageName = '';

if ($image = $request->file($name)) {

$destinationPath = public_path() . $path;

$imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();

$image->move($destinationPath, $imageName);

$image = $imageName;

}

return $imageName;

}

  

public function removeFile($file, $path)

{

$path = public_path() . $path . $file;

if (File::exists($path)) {

File::delete($path);

}

}
}
