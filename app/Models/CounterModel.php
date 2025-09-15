<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounterModel extends Model
{
    protected $table = 'tbl_count_view';
    protected $primaryKey = 'count_id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['menu_id', 'timestamp'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false; // ใส่บรรทัดนี้ถ้าไม่มี created_at, updated_at
}


