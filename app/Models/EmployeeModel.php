<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    protected $table = 'tbl_emp_admin';
    protected $primaryKey = 'emp_id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['emp_name', 'emp_username', 'emp_password', 'emp_gender', 'emp_email','emp_phone','emp_dob','role','date','timestamp','emp_pic'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false; // ใส่บรรทัดนี้ถ้าไม่มี created_at, updated_at
}


