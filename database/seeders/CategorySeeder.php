<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
            'title'  => 'ChatGPT系', 
            'slug'  => 'chatgpt', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '医療系', 
            'slug'  => 'medical', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '教育系', 
            'slug'  => 'education', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '業務系', 
            'slug'  => 'business', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '音声系', 
            'slug'  => 'voice', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'エンタメ系', 
            'slug'  => 'entertainment', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '育児系', 
            'slug'  => 'childcare', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '写真系', 
            'slug'  => 'photo', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'ユーティリティ系', 
            'slug'  => 'utility', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'ヘルスケア系', 
            'slug'  => 'healthcare', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '旅行系', 
            'slug'  => 'travel', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'ビデオ系', 
            'slug'  => 'video', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'アート系', 
            'slug'  => 'art', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'デザイン系', 
            'slug'  => 'design', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '生産管理系', 
            'slug'  => 'product', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'ライフスタイル系', 
            'slug'  => 'lifestyle', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'ファイナンス系', 
            'slug'  => 'finance', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'インテリア系', 
            'slug'  => 'interior', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '書籍 & 参考書系', 
            'slug'  => 'books', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'スポーツ系', 
            'slug'  => 'sports', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '美容系', 
            'slug'  => 'beauty', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '出会い系', 
            'slug'  => 'dating', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '仕事効率化系', 
            'slug'  => 'efficient', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => '料理系', 
            'slug'  => 'cooking', 
            'order' => 1, 
        ]);

        \App\Models\Category::create([
            'title'  => 'オーディオ系', 
            'slug'  => 'audio', 
            'order' => 1, 
        ]);
    }
}
