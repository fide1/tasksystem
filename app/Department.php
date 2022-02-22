<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable=['name'];

    public static function getDepartmentName($id) {
        $department = Department::find($id);
        if ($department) {
            return $department['name'];            
        } else {
            return;
        }
    }
}
