<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestRoomUser extends Model
{
    protected $table = 'test_room_user';
    protected $fillable = ['test_room_id', 'user_id'];
}
