<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserManagement extends Model
{
    //
    protected $fillable = ['company_id','user_id','name','email','phone','gender','branch_id','designation_id','dob','doj'];

}
