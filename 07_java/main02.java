class main02 {
    public static void main(String[] args) {
        //比較演算子
        System.out.println(true);
        System.out.println(false);
        System.out.println(6 + 2 == 5);
        System.out.println(6 + 2 != 5);
        boolean bool = 3 * 9 == 27;
        System.out.println(bool);
        //大小比較
        System.out.println(4 + 2 > 6);
        System.out.println(4 + 2 >= 6);
        System.out.println(8 / 4 < 2);
        System.out.println(8 / 4 <= 2);
        //かつ・または、・〜ではない
        int x = 5;
        System.out.println(x > 10 && x < 30);
        System.out.println(x > 10 || x < 30);
        int y = 20;
        System.out.println(y >= 30);
        System.out.println(!(y >= 30));
        //まとめ
        System.out.println(true && false);
        System.out.println(true || false);
        //if構文を使ってみよう
        int z = 10;
        if (z == 10) {
            System.out.println("zは10です");
        }
        int a = 15;
        if (a == 10) {
            System.out.println("aは10です");
        }
        int b = 20;
        if (b < 30) {
            System.out.println("条件はture");
            System.out.println("bは30より小さい");
        }
        //else
        int c = 20;
        if (c < 30) {
            System.out.println("cは30より小さい");
        } else {
            System.out.println("cは30以上");
        }
        int d = 40;
        if (d < 30) {
            System.out.println("dは30より小さい");
        } else {
            System.out.println("dは30以上");
        }
        //else if
        int e = 25;
        if (e >= 30) {
            System.out.println("eは30以上");
        } else if (e > 20) {
            System.out.println("eは20より大きく、30より小さい");
        } else {
            System.out.println("eは20以下");
        }
        int f = 15;
        if (f >= 30) {
            System.out.println("fは30以上");
        } else if (f > 20) {
            System.out.println("fは20より大きく、30より小さい");
        } else {
            System.out.println("fは20以下");
        }
        //else if (実行される処理)
        int g = 40;
        if (g >= 30) {
            System.out.println("gは30以上");
        } else if (g > 20) {
            System.out.println("gが20以上より大きく、30より小さい");
        } else {
            System.out.println("gが20以下");
        }
        //switch文
        //if文の場合
        int n = 1;
        if (n == 1) {
            System.out.println("大吉です");
        } else if (n == 2) {
            System.out.println("吉です");
        }
        //switch文の場合
        int m = 1;
        switch (m) {
            case 1:
                System.out.println("大吉です");
                break;
            case 2:
                System.out.println("吉です");
                break;
        }
        //break句がない場合
        int l = 1;
        switch (l) {
            case 1:
                System.out.println("大吉です");
            case 2:
                System.out.println("吉です");
                break;
        }
        //default句
        //if構文の場合
        int o = 1;
        if (o == 1) {
            System.out.println("大吉です");
        } else if (o == 2) {
            System.out.println("吉です");
        } else {
            System.out.println("凶です");
        }
        //switch構文の場合
        int p = 1;
        switch (p) {
            case 1:
                System.out.println("大吉です");
                break;
            case 2:
                System.out.println("吉です");
                break;
            default:
                System.out.println("凶です");
                break;
        }
        //繰り返し処理
        System.out.println(1);
        System.out.println(2);
        System.out.println(99);
        System.out.println(100);
        //while句
        int h = 1;
        while (h <= 5) {
            System.out.println(h);
            h++;
        }
        //while句を実際使用
        int j = 1;
        while (j <= 5) {
            System.out.println(j + "回ジャンプしました");
            j++;//コードを記載しないと無限ループになる。
        }
        //逆から表示する場合
        int number = 10;
        while (number > 0) {
            System.out.println(number);
            number--;
        }
        //for文
        for (int i = 1; i <= 5; i++) {
            System.out.println(i);
        }
        //for文を実際に記載
        for (int i = 1; i <= 5; i++) {
            System.out.println(i + "回ジャンプしました");
        }
        //break(for文)
        for (int i = 1; i <= 10; i++) {
            if (i > 5) {
                break;
            }
            System.out.println(i);
        }
        for (int i = 1; i <= 10; i++) {
            if (i % 3 == 0) {
                continue;
            }
            System.out.println(i);
        }
        //配列
        String[] names = { "John", "Kate", "Bob" };
        System.out.println("私の名前は" + names[0] + "です");
        //配列の要素を上書き
        System.out.println(names[0]);
        names[0] = "Willian";
        System.out.println(names[0]);
        //for文を用いない場合
        System.out.println("Hello" + names[0]);
        System.out.println("Hello" + names[1]);
        System.out.println("Hello" + names[2]);
        //for文の置き換え
        for (int i = 0; i < 3; i++) {
            System.out.println("Hello" + names[i]);
        }
        //length(数を出力される)
        System.out.println(names.length);
        //lengthを用いた繰り返し処理
        for (int i = 0; i < names.length; i++) {
            System.out.println("Hello" + names[i]);
        }
        //拡張for文の記載
        for (String name : names) {
            System.out.println(name);
        }
        //総合問題
        int oddSum = 0;
        int evenSum = 0;
        int[] numbers = { 1, 4, 6, 9, 13, 16 };
    // for文を用いて、配列numbersの偶数の和と奇数の和を求めてください
        for (int num : numbers) {
        if (num % 2 == 0) {
            evenSum += num;
        } else {
            oddSum += num;
        }
    }
        System.out.println("奇数の和は" + oddSum + "です");
        System.out.println("偶数の和は" + evenSum + "です");
    }
    }
