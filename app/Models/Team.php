<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        "team_name",
        "team_description",
        "team_creator",
        "team_creator_role"
    ];
}
