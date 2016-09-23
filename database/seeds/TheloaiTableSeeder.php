<?php

use Illuminate\Database\Seeder;

class TheloaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theloais')->insert([
        	['Ten' => 'Xã Hội','TenKhongDau' => 'Xa-Hoi','TrangThai'=>1],
        	['Ten' => 'Thế Giới','TenKhongDau' => 'The-Gioi','TrangThai'=>1],
        	['Ten' => 'Kinh Doanh','TenKhongDau' => 'Kinh-Doanh','TrangThai'=>1],
        	['Ten' => 'Văn Hoá','TenKhongDau' => 'Van-Hoa','TrangThai'=>1],
        	['Ten' => 'Thể Thao','TenKhongDau' => 'The-Thao','TrangThai'=>1],
        	['Ten' => 'Pháp Luật','TenKhongDau' => 'Phap-Luat','TrangThai'=>1],
        	['Ten' => 'Đời Sống','TenKhongDau' => 'Doi-Song','TrangThai'=>1],
        	['Ten' => 'Khoa Học','TenKhongDau' => 'Khoa-Hoc','TrangThai'=>1],
        	['Ten' => 'Vi Tính','TenKhongDau' => 'Vi-Tinh','TrangThai'=>1]
    	]);
    }
}
