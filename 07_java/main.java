class main {
    public static void main(String[] args) {
        //こんにちわ・文字列
        System.out.println("Hello World");
        System.out.println(3);
        System.out.println(5 + 2);
        System.out.println("5 - 2");
        System.out.println(8 - 5);
        System.out.println(3 * 2);
        System.out.println(6 / 2);
        System.out.println(8 % 5);
        System.out.println("ninza" + "wanko");
        System.out.println("5" + "3");
        System.out.println(5 + 3);
        //数値変数代入
        int number;
        number = 10;
        System.out.println(number);
        String name;
        name = "Sato";
        System.out.println(name);
        //int型変数の計算
        int number1 = 10;
        System.out.println(number1 + 3);
        int number2 = 5;
        System.out.println(number1 + number2);
        //String型変数の連結
        String greeting = "こんにちわ";
        System.out.println(greeting + "佐藤さん");
        String name1 = "鈴木さん";
        System.out.println(greeting + name1);
        //変数の更新
        name = "Suzuki";
        System.out.println(name);
        number = 5;
        System.out.println(number);
        //自己代入
        int x = 3;
        System.out.println(x);
        x = x + 2;
        System.out.println(x);
        //自己代入の省略した書き方
        //基本型
        x = x + 10;
        x = x - 10;
        x = x * 10;
        x = x / 10;
        x = x % 10;
        //省略型
        x += 10;
        x -= 10;
        x *= 10;
        x /= 10;
        x %= 10;
        //1を足す、1を引く
        x = x + 1;
        x += 1;
        x++;
        x = x - 1;
        x -= 1;
        x--;
        //変数の役割
        String text = "ProgateでJavaをマスターしましょう。";
        System.out.println("Aさん、" + text);
        System.out.println("Bさん、" + text);
        System.out.println("Cさん、" + text);
        //正しい変数名
        String lastName = "Sato";
        System.out.println(lastName);
        //double型（小数）
        double number02 = 3.14;
        System.out.println(number02);
        double number03 = -39;
        System.out.println(number03);
        //小数点同士の計算
        double number04 = 8.5;
        double number05 = 3.4;
        System.out.println(number04 + number05);
        System.out.println(number04 - number05);
        //型変換について
        System.out.println("佐藤さんは" + 23 + "歳です。");
        System.out.println(5 / 2);
        System.out.println(5.0 / 2.0);
        System.out.println(5.0 / 2);
        //int型同士の計算・キャスト
        int number6 = 13;
        int number7 = 4;
        System.out.println((double) number6 / number7);
    }
}
