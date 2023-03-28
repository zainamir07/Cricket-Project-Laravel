<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchDetails extends Model
{
    use HasFactory;
    protected $table = 'match_details';
    protected $primaryKey = 'match_detail_id';
}
