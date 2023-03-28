<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerCategory extends Model
{
    use HasFactory;
    protected $table = 'player_categories';
    protected $primaryKey = 'category_id';
}
