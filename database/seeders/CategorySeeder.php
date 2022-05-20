<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 0 , 'name' => '総記'],
            ['id' => 1 , 'name' => '哲学'],
            ['id' => 2 , 'name' => '歴史'],
            ['id' => 3 , 'name' => '社会科学'],
            ['id' => 4 , 'name' => '自然科学'],
            ['id' => 5 , 'name' => '技術'],
            ['id' => 6 , 'name' => '産業'],
            ['id' => 7 , 'name' => '芸術'],
            ['id' => 8 , 'name' => '言語'],
            ['id' => 9 , 'name' => '文学'],
        ];
        \DB::table('categories')->insert($data);
    }
}
