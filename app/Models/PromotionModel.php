<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionModel extends Model
{
    protected $table = 'tbl_promotion';
    protected $primaryKey = 'pro_id'; // คีย์หลักตรงกับ DB

    // กำหนดฟิลด์ที่แก้ไขได้
    protected $fillable = [
        'conditions',
        'detail',
        'start_date',
        'end_date',
        'mem_id',
        'emp_id',
        'pro_pic',
        'timestamp'
    ];

    public $incrementing = true; // ✅ pro_id เป็น auto increment
    public $timestamps = false;  // ✅ ไม่มี created_at, updated_at
}
