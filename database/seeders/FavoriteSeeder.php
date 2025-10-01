<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FavoriteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_favorite')->insert([
            [
                'mem_id' => 1,
                'menu_id' => 1,
                'timestamp' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mem_id' => 1,
                'menu_id' => 2,
                'timestamp' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
