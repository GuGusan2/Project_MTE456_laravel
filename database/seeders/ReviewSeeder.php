<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_review')->insert([
            [
                'mem_id' => 1,
                'menu_id' => 1,
                'comment' => 'อร่อยมาก!',
                'rating' => 5,
                'timestamp' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mem_id' => 2,
                'menu_id' => 3,
                'comment' => 'เฉยๆ',
                'rating' => 3,
                'timestamp' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
