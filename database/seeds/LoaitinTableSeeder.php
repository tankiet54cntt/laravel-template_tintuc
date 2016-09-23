<?php

use Illuminate\Database\Seeder;

class LoaitinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('loaitins')->insert([
        	['Ten' => 'Giáo Dục','TenKhongDau' => 'Giao-Duc','TrangThai'=>1,'idTheLoai'=>1],
        	['Ten' => 'Nhịp Điệu Trẻ','TenKhongDau' => 'Nhip-Dieu-Tre','TrangThai'=>1,'idTheLoai'=>1],
        	['Ten' => 'Du Lịch','TenKhongDau' => 'Du-Lich','TrangThai'=>1,'idTheLoai'=>1],
        	['Ten' => 'Du Học','TenKhongDau' => 'Du-Hoc','TrangThai'=>1,'idTheLoai'=>1],
        	['Ten' => 'Cuộc Sống Đó Đây','TenKhongDau' => 'Cuoc-Song-Do-Day','TrangThai'=>1,'idTheLoai'=>2],
        	['Ten' => 'Ảnh','TenKhongDau' => 'Anh','TrangThai'=>1,'idTheLoai'=>2],
        	['Ten' => 'Người Việt 5 Châu','TenKhongDau' => 'Nguoi-Viet-5-Chau','TrangThai'=>1,'idTheLoai'=>2],
        	['Ten' => 'Phân Tích','TenKhongDau' => 'Phan-Tich','TrangThai'=>1,'idTheLoai'=>2],
        	['Ten' => 'Chứng Khoán','TenKhongDau' => 'Chung-Khoan','TrangThai'=>1,'idTheLoai'=>3],
        	['Ten' => 'Bất Động Sản','TenKhongDau' => 'Bat-Dong-San','TrangThai'=>1,'idTheLoai'=>3],
        	['Ten' => 'Doanh Nhân','TenKhongDau' => 'Doanh-Nhan','TrangThai'=>1,'idTheLoai'=>3],
        	['Ten' => 'Quốc Tế','TenKhongDau' => 'Quoc-Te','TrangThai'=>1,'idTheLoai'=>3],
        	['Ten' => 'Mua Sắm','TenKhongDau' => 'Mua-Sam','TrangThai'=>1,'idTheLoai'=>3],
        	['Ten' => 'Doanh Nghiệp Viết','TenKhongDau' => 'Doanh-Nghiep-Viet','TrangThai'=>1,'idTheLoai'=>3],
        	['Ten' => 'Hoa Hậu','TenKhongDau' => 'Hoa-Hau','TrangThai'=>1,'idTheLoai'=>4],
        	['Ten' => 'Nghệ Sỹ','TenKhongDau' => 'Nghe-Sy','TrangThai'=>1,'idTheLoai'=>4],
        	['Ten' => 'Âm Nhạc','TenKhongDau' => 'Am-Nhac','TrangThai'=>1,'idTheLoai'=>4],
        	['Ten' => 'Thời Trang','TenKhongDau' => 'Thoi-Trang','TrangThai'=>1,'idTheLoai'=>4],
        	['Ten' => 'Điện Ảnh','TenKhongDau' => 'Dien-Anh','TrangThai'=>1,'idTheLoai'=>4],
        	['Ten' => 'Mỹ Thuật','TenKhongDau' => 'My-Thuat','TrangThai'=>1,'idTheLoai'=>4],
        	['Ten' => 'Bóng Đá','TenKhongDau' => 'Bong-Da','TrangThai'=>1,'idTheLoai'=>5],
        	['Ten' => 'Tennis','TenKhongDau' => 'Tennis','TrangThai'=>1,'idTheLoai'=>5],
        	['Ten' => 'Chân Dung','TenKhongDau' => 'Chan-Dung','TrangThai'=>1,'idTheLoai'=>5],
        	['Ten' => 'Ảnh TT','TenKhongDau' => 'Anh-TT','TrangThai'=>1,'idTheLoai'=>5],
        	['Ten' => 'Hình Sự','TenKhongDau' => 'Hinh-Su','TrangThai'=>1,'idTheLoai'=>6]
    	]);
    }
}
