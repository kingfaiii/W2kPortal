<?php

namespace App\Http\Controllers;

use App\Models\projectManager;
use Illuminate\Http\Request;

class ProjectManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pm = projectManager::all();
        return view('projectManager', ['pm' => $pm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pm_fname' => 'required',
            'pm_lname' => 'required',
        ]);
        projectManager::create($request->all());
        return redirect()->route('ProjectManager.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\projectManager  $projectManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updatepProjectManager = projectManager::Find($id);
        $updatepProjectManager->update($request->all());

        return redirect()->route('ProjectManager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\projectManager  $projectManager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletePM = projectManager::Find($id);
        $deletePM->delete();
        return redirect()->route('ProjectManager.index');
    }
}
