<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'director_id',
        'name',
    ];

    protected $dates = ['deleted_at'];

}
