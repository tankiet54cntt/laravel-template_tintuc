<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(TheloaiTableSeeder::class); // tao bang thu 1
        // $this->call(LoaitinTableSeeder::class); // tao bang thu 2
        // $this->call(TintucTableSeeder::class);
        $this->call(CommentTableSedder::class);
    }
}
