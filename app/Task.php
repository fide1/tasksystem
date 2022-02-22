<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable=['name', 'dueDate', 'status'];

    public static function countAssignedTasks($username) {
        return Task::where('assignedTo', $username)->count();
    }

    public static function getAssignedTasks($username) {
        return Task::where('assignedTo', $username);
    }
    
    public static function countCompletedTasks($username) {
        return Task::where('createdBy', $username)
                        ->where('done', '100')->count();
    }

    public static function getCompletedTasks($username) {
        return Task::where('createdBy', $username)
                        ->where('done', '100');
    }

    public static function countPendingTasks($username) {
        return Task::where('createdBy', $username)->
                        where('assignedTo', '')->count();
    }

    public static function getPendingTasks($username) {
        return Task::where('createdBy', $username)->
                        where('assignedTo', '');
    }

    public static function countOverDueTasks($username) {
        return Task::where('createdBy', $username)->whereDate('dueDate', '<', date("Y-m-d"))->count();
    }

    public static function getOverDueTasks($username) {
        return Task::where('createdBy', $username)->whereDate('dueDate', '<', date("Y-m-d"));
    }

    public static function getAllDepMyTasksId($deparment_id) {
        return Task::where('department_id', $deparment_id)->pluck('id');
    }

    public static function getAllMyTasksId($username) {
        return Task::where('createdBy', $username)->orWhere('assignedTo', $username)->pluck('id');
    }

    public static function getAllDepMyOverDueId($deparment_id) {
        return Task::where('department_id', $deparment_id)
                    ->whereDate('dueDate', '<', date("Y-m-d"))->pluck('id');
    }

    public static function getAllMyOverDueId($username) {
        return Task::where('createdBy', $username)
                    ->whereDate('dueDate', '<', date("Y-m-d"))->pluck('id');
    }

    public static function getDepMyOpenId($deparment_id) {
        return Task::where('department_id', $deparment_id)->pluck('id');
    }

    public static function getMyOpenId($username) {
        return Task::where('assignedTo', $username)->pluck('id');
    }
}
