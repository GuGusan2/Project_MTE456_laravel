<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MemberModel extends Authenticatable
{
    protected $table = 'tbl_member';
<<<<<<< HEAD
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
=======
    protected $primaryKey = 'mem_id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['mem_name', 'mem_username', 'mem_password', 'mem_phone','mem_gender','mem_email','mem_dob','point','emp_id','mem_pic','timestamp'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false; // ใส่บรรทัดนี้ถ้าไม่มี created_at, updated_at

    
    protected $hidden = [
        'mem_password'
    ];

    // บอก Laravel ว่ารหัสผ่านอยู่ที่ไหน
    public function getAuthPassword()
    {
        return $this->mem_password;
    }
>>>>>>> 40417eca0e18322722f6bb87c56d2f8718641add
}
