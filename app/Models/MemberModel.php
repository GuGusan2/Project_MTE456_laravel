<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MemberModel extends Authenticatable
{
    protected $table = 'tbl_member';
    protected $primaryKey = 'mem_id';

    protected $fillable = [
        'mem_name',
        'mem_username',
        'mem_password',
        'mem_phone',
        'mem_gender',
        'mem_email',
        'mem_dob',
        'point',
        'emp_id',
        'mem_pic',
    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [
        'mem_password',
    ];
}
