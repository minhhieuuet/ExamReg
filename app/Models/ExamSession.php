<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    //
    protected $fillable = ['module_id', 'test_site_id', 'started_at', 'finished_at'];
}
