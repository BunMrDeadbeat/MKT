<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanderSection extends Model
{
    protected $fillable = ['name', 'is_active'];
    protected $table = 'lander_sections';
    
}
