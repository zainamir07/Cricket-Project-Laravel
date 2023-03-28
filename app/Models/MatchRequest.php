<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchRequest extends Model
{
    use HasFactory;
    protected $table = 'match_requests';
    protected $primaryKey = 'match_request_id';
}
