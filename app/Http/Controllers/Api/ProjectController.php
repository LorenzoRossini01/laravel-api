<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects=Project::orderBy('created_at', 'desc')
        ->select(['id','user_id','category_id','title','description','link','imageUrl','slug'])
        ->with(['category:id,label,color', 'tags:id,label,color', 'user:id,name,image'])
        ->paginate();

        foreach($projects as $project){
            if(!str_starts_with($project->imageUrl,'https')){

                $project->imageUrl=!empty($project->imageUrl)
                ?asset('storage/'. $project->imageUrl)
                :null;
            } 
        }
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project=Project::orderBy('created_at', 'desc')
        ->select(['id','user_id','category_id','title','description','link','imageUrl'])
        ->where('slug',$slug)
        ->with(['category:id,label,color', 'tags:id,label,color', 'user:id,name,image'])
        ->first();

        if(!str_starts_with($project->imageUrl,'https')){

            $project->imageUrl=!empty($project->imageUrl)
            ?asset('storage/'. $project->imageUrl)
            :null;
        } 
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fliter_category($filter_id)
    {
        $projects=Project::orderBy('created_at', 'desc')
        ->select(['id','user_id','category_id','title','description','link','imageUrl','slug'])
        ->where('category_id',$filter_id)
        ->with(['category:id,label,color', 'tags:id,label,color', 'user:id,name,image'])
        ->paginate();

        foreach($projects as $project){
            if(!str_starts_with($project->imageUrl,'https')){

                $project->imageUrl=!empty($project->imageUrl)
                ?asset('storage/'. $project->imageUrl)
                :null;
            } 
        }
        return response()->json($projects);
    }


    public function filter_tag($filter_id)
    {


        $projects=Project::orderBy('created_at', 'desc')
        ->select(['id','user_id','category_id','title','description','link','imageUrl','slug']) 
        ->with(['category:id,label,color', 'tags:id,label,color', 'user:id,name,image'])
        ->whereHas('tags', function($q)use($filter_id){$q->where('tag_id',$filter_id);})
        ->paginate();

        foreach($projects as $project){
            if(!str_starts_with($project->imageUrl,'https')){

                $project->imageUrl=!empty($project->imageUrl)
                ?asset('storage/'. $project->imageUrl)
                :null;
            } 
        }
        return response()->json($projects);
    }


    public function filter_user($filter_id)
    {
        $projects=Project::orderBy('created_at', 'desc')
        ->select(['id','user_id','category_id','title','description','link','imageUrl','slug'])
        ->with(['category:id,label,color', 'tags:id,label,color', 'user:id,name,image'])
        ->where('user_id',$filter_id)
        ->paginate();

        foreach($projects as $project){
            if(!str_starts_with($project->imageUrl,'https')){

                $project->imageUrl=!empty($project->imageUrl)
                ?asset('storage/'. $project->imageUrl)
                :null;
            } 
        }
        return response()->json($projects);
    }
}
