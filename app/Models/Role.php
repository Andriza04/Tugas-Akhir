<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Define the table associated with the model
    protected $table = 'roles';

    // Define the fillable fields
    protected $fillable = ['name'];
}
