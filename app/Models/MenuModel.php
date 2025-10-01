<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'tbl_menu';
    protected $primaryKey = 'menu_id'; // Primary key ของตาราง

    // คอลัมน์ที่อนุญาตให้เพิ่ม/แก้ไข
    protected $fillable = [
        'menu_name',
        'price',
        'menu_type',
        'emp_id',
        'menu_pic',
        'menu_detail',
    ];

    public $incrementing = true; // Primary key auto increment
    public $timestamps = false;  // ถ้าไม่มี created_at / updated_at

    // 🔹 ความสัมพันธ์กับ Employee
    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class, 'emp_id', 'emp_id');
    }

    // 🔹 ความสัมพันธ์กับ Review
    public function reviews()
    {
        return $this->hasMany(Review::class, 'menu_id', 'menu_id');
    }

    // 🔹 ความสัมพันธ์กับ Favorite
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'menu_id', 'menu_id');
    }
}
