<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobrole extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_role',
        'qualification',
        'certification',
        'experience',
        'salary',
        'team_name'
    ];
}
