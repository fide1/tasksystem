<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Department;
use App\Http\Controllers\Auth;

class UserTaskController extends Controller
{
    //
    public function index() {
        $tasks = Task::
                where('type', 'public')->
                orWhere('createdBy', Auth()->user()->name)->
                orWhere('assignedTo', Auth()->user()->name)->
                orderBy('id', 'DESC')->
                get();
        $departments = Department::all();
        return view('user.task.index')->with('tasks', $tasks)
                                        ->with('departments', $departments);
    }

    public function create() {
        $users = User::all();
        return view('user.task.create')->with('users', $users);
    }

    public function store(Request $request) {
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
        return redirect()->route('task');
    }

    public function edit($id) {
        $task = Task::find($id);
        return view('user.task.edit')->with('task', $task);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name'=>'string|required|max:50',
            'done'=>'integer|required',
        ]);

        $file = $request->file('file');
        if($file) {
            $file_name = time()."_".$file->getClientOriginalName();
        }

        $task = Task::findOrFail($id);
        $task->status = $request->input('status');
        $task->done = $request->input('done');
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
        return redirect()->route('task');
    }

    public function destroy($id) {
        $delete_task = Task::find($id);
        $delete_task->delete();

        request()->session()->flash('success','Task successfully canceld');
        return redirect()->back();
    }

    public function assign($id) {
        $task = Task::find($id);
        $task->assignedTo = Auth()->user()->name;
        $status = $task->save();
        if($status){
            request()->session()->flash('success','You successfully assigned');
        }
        else{
            request()->session()->flash('error','Error occurred while assigning task');
        }
        return redirect()->route('task');
    }

    public function assignedTasks() {
        $username = Auth()->user()->name;
        $tasks = Task::getAssignedTasks($username)->get();
        return $tasks;
    }

    public function completedTasks() {
        $username = Auth()->user()->name;
        $tasks = Task::where('createdBy', $username)->where('done', '100')->get();
        return $tasks;
    }

    public function pendingTasks() {
        $username = Auth()->user()->name;
        $tasks = Task::where('createdBy', $username)->where('assignedTo', '')->get();
        return $tasks;
    }

    public function overDueTasks() {
        $username = Auth()->user()->name;
        $tasks = Task::where('createdBy', $username)->whereDate('dueDate', '<', date("Y-m-d"))->get();
        return $tasks;
    }

    public function userboard() {
        $users = User::all();
        return view('user.task.userboard')->with('users', $users);
    }

    public function userboardDetail($name) {
        $assigneds = Task::getAssignedTasks($name)->get();
        $completeds = Task::getCompletedTasks($name)->get();
        $pendings = Task::getPendingTasks($name)->get();
        $overDues = Task::getOverDueTasks($name)->get();
        return view('user.task.detail')->with('username', $name)
                                            ->with('assigneds', $assigneds)
                                            ->with('completeds', $completeds)
                                            ->with('pendings', $pendings)
                                            ->with('overDues', $overDues);
    }
}
