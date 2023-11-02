<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use App\Models\Technology;
use App\Models\Type;
use App\Models\Project;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;




class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * *@return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(12);

        return view("admin.projects.index", compact("projects"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * *@return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view("admin.projects.create", compact("types","technologies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * *@return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data=$request->validated();

        $project = new Project();
        $project->fill($data);
        $project->slug = Str::slug($project->name);

        
        
        if (Arr::exists( $data,"technologies")) {
        $project->technologies()->attach($data['technologies']);
        }
        
        if ($request->hasFile("cover_image")) {
        $cover_image_path = Storage::put('uploads/projects/cover_image', $data['cover_image']);
        $project->cover_image = $cover_image_path;
        }
        
        $project->save();
        
        
        

        return redirect()->route("admin.projects.show", $project);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * *@return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * *@return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        $technology_ids = $project->technologies->pluck("id")->toArray();
    

        return view("admin.projects.edit", compact("project", "types", "technologies", "technology_ids"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * *@return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $project->fill($data);
        $project->slug = Str::slug($project->name);
        $project->save();


 
        if ($request->hasFile("cover_image")) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $cover_image_path = Storage::put('uploads/projects/cover_image', $data['cover_image']);
            $project->cover_image = $cover_image_path;}
            $project->save();
            
            
            if(Arr::exists($data,"technologies")) {
                $project->technologies()->sync($data['technologies']);
            } else { 
                $project->technologies()->detach();
            }
            
            return redirect()->route("admin.projects.show", $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * *@return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("admin.projects.index");
    }



}
