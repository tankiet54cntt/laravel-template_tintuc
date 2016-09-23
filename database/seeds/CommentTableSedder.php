<?php

use Illuminate\Database\Seeder;

class CommentTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //
    	$NoiDung = array(
    		'Bài viết rất hay',
    		'Tôi rất thích bài viết này',
    		'Bài viết này tạm ổn',
    		'Hay quá trời',
    		'Tôi sẽ học thèo bài viết này',
    		'Bài viết này chưa được hay lắm',
    		'Ý kiến của tôi khác so với bài này',
    		'Bài viết này được',
    		'Không thích bài viết này',
    		'Tôi chưa có ý kiến gì'
    	);

    	for($i=1;$i<=100;$i++)
    	{
	        DB::table('comments')->insert(
	        	[
	        		'hoTen' => 'User_'.$i,
                    'email'=>'User'.$i.'@gmail.com',
	            	'NoiDung' => $NoiDung[rand(0,9)],
                    'idTinTuc' => 2005,
	            	'created_at' => new DateTime(),
                    'updated_at' => new DateTime()
	        	]
	    	);
    	}
    }
}
