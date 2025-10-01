<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'tbl_favorite';
    protected $primaryKey = 'id';
    protected $fillable = ['mem_id', 'menu_id', 'timestamp'];
    public $timestamps = true;

    public function member()
    {
        return $this->belongsTo(MemberModel::class, 'mem_id', 'mem_id');
    }

    public function menu()
    {
        return $this->belongsTo(MenuModel::class, 'menu_id', 'menu_id');
    }
}
