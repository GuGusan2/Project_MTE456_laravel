<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionModel extends Model
{
    protected $table = 'tbl_promotion';
    protected $primaryKey = 'pro_id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['pro_id', 'conditions', 'mem_id', 'emp_id', 'end_date', 'start_date','timestamp','pro_pic','detail'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false; // ใส่บรรทัดนี้ถ้าไม่มี created_at, updated_at
}


