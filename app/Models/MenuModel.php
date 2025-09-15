<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'tbl_menu';
    protected $primaryKey = 'menu_id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['menu_name', 'price', 'menu_type', 'emp_id', 'mem_id','timestamp','menu_pic','menu_detail'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false; // ใส่บรรทัดนี้ถ้าไม่มี created_at, updated_at
}


