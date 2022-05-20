<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <=100 ; $i++) { 
            $book = new \App\Models\Book([
                'isbn' => random_int(0000000000000, 9999999999999),
                'title' => 'タイトル' .$i,
                'author' => '著者' .$i,
                'category_id' => rand(0,9),
                'publisher' => '出版社' .$i,
                'published_date' => date("Y/m/d",strtotime('-' .rand(0,27) .'day -' .rand(0,12).'month -' .rand(0,2).'year')),
            ]);
            $book->save();
        }
        
    }
}
