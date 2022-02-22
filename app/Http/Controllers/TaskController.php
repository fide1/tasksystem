<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\User;
use App\Department;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $department_id = Auth()->user()->department_id;
        $tasks = Task::where('department_id', $department_id)->
                        orWhere('type', 'public')->orderBy('id','DESC')->paginate(20);
        $departments = Department::all();
        return view('backend.task.index')->with('tasks', $tasks)
                                        ->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        return view('backend.task.create')->with('users', $users);
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
        $this->validate($request, [
            'name'=>'string|required|max:50',
            'dueDate'=>'date|required',
            'createdBy'=>'string|required',
        ]);

        $file = $request->file('file');
        if($file) {
            $file_name = time()."_".$file->getClientOriginalName();
        }

        $task = new Task();
        $task->name = $request->input('name');
        $task->department_id = Auth()->user()->department_id;
        $task->type = $request->input('type');
        $task->priority = $request->input('priority');
        $task->dueDate = $request->input('dueDate');
        $task->status = $request->input('status');
        $task->done = $request->input('done');
        $task->createdBy = $request->input('createdBy');
        $task->assignedTo = $request->input('assignedTo');
        $task->comments = $request->input('comments');
        $task->file_name = $file_name;
        $status = $task->save();

        if($status){
            $destinationPath = public_path('images/image');
            $file->move($destinationPath, $file_name);
            request()->session()->flash('success','Task successfully created');
        }
        else{
            request()->session()->flash('error','Error occurred while creating task');
        }
        return redirect()->route('admintask.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::find($id);
        $users = User::all();
        return view('backend.task.edit')->with('task', $task)
                                        ->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name'=>'string|required|max:50',
            'dueDate'=>'date|required',
            'createdBy'=>'string|required',
            'assignedTo'=>'string|required',
        ]);

        $file = $request->file('file');
        if($file){
            $file_name = time()."_".$file->getClientOriginalName();
        }    

        $task = Task::findOrFail($id);
        $task->name = $request->input('name');
        $task->type = $request->input('type');
        $task->priority = $request->input('priority');
        $task->dueDate = $request->input('dueDate');
        $task->status = $request->input('status');
        $task->done = $request->input('done');
        $task->createdBy = $request->input('createdBy');
        $task->assignedTo = $request->input('assignedTo');
        $task->comments = $request->input('comments');
        if($file_name) {
            $task->file_name = $file_name;
        }
        $status = $task->save();

        if($status){
            if($file_name){
                $destinationPath = public_path('images/image');
                $file->move($destinationPath, $file_name);
            }
            request()->session()->flash('success','Task successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating task');
        }
        return redirect()->route('admintask.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete_task = Task::find($id);
        $delete_task->delete();

        request()->session()->flash('success','Task successfully deleted');
        return redirect()->back();
    }

    public function userboard() {
        $users = User::all();
        return view('backend.task.userboard')->with('users', $users);
    }

    public function userboardDetail($name) {
        $assigneds = Task::getAssignedTasks($name)->get();
        $completeds = Task::getCompletedTasks($name)->get();
        $pendings = Task::getPendingTasks($name)->get();
        $overDues = Task::getOverDueTasks($name)->get();
        return view('backend.task.detail')->with('username', $name)
                                            ->with('assigneds', $assigneds)
                                            ->with('completeds', $completeds)
                                            ->with('pendings', $pendings)
                                            ->with('overDues', $overDues);
    }
}
