<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Book;

class BooksTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 出力件数を指定
        $NUM_FAKER = 60;
        // Factoryインスタンスを生成
        $faker = Factory::create('ja_JP');
        // 本のタイトルのみ英語名なので日本語で定義
        $bookTitle = [
            '気づけばプロ並みPHP',
            '独習PHP',
            'よくわかるPHPの教科書',
            'PHP2020年1月号人生、笑うが勝ち!',
            'レベルアップPHP',
            'PHPふりがなプログラミング',
            '基礎からのMySQL',
            '詳解MySQL5.7',
            '15時間でわかるMySQL集中講座',
            '3ステップでしっかり学ぶMySQL入門',
            'MySQL徹底入門',
            'Web開発のためのMySQL超入門',
            'PHPフレームワークLaravel入門',
            'PHPフレームワークLaravel実践開発',
            '速習Laravel6速習シリーズ',
            'PHPフレームワークLaravelWebアプリケーション開発',
            'Laravelエキスパート養成読本'
        ];
        for ($i = 0; $i < $NUM_FAKER; $i++) {
            Book::create([
                'item_name'  => $bookTitle[mt_rand(0, count($bookTitle)-1)],
                'item_purchase'=> $faker->numberBetween(1, 10),
                'item_amount'=> $faker->numberBetween(10,40)."00",
                'user_id' => $faker->numberBetween(1,5),
                'published'  => $faker->dateTimeBetween('-3 years', 'now'),
                'created_at' => $faker->dateTime('now'),
                'updated_at' => $faker->dateTime('now'),
            ]);
        }
    }
}
