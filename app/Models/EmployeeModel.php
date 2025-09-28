<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class EmployeeModel extends Authenticatable
{
    protected $table = 'tbl_emp_admin'; // ชื่อตารางจริง
    protected $primaryKey = 'emp_id';
    public $timestamps = false; // ถ้าไม่มี created_at/updated_at

    protected $fillable = [
        'emp_username', 'emp_email', 'emp_name', 'emp_password', 'emp_phone',
        'emp_dob', 'date', 'emp_gender', 'role', 'emp_pic'
    ];

    protected $hidden = [
        'emp_password'
    ];

    // บอก Laravel ว่ารหัสผ่านอยู่ที่ไหน
    public function getAuthPassword()
    {
        return $this->emp_password;
    }
}
