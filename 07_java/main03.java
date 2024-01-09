import java.util.Scanner;
public class main03 {
    public static void main(String[] args) {
        hello();
        //メゾット指定
        hello();
        //メゾットを引き渡す
        hello("Bob");
        //複数の引数を渡してみよう
        Printprice("ピザ", 3000);
        Printprice("コーラ", 150);
        //戻り値の具体例
        int total = add(7, 5);
        System.out.println(total);
        //メゾットを組み合わせる
        System.out.println(average(3, 8));
        //真偽値を返すメソッドの例
        int number = 9;
        if (isEven(number)) {
            System.out.println(number + "は偶数です");
        } else {
            System.out.println(number + "は奇数です");
        }
        //Mathクラスのメソッド
        int max = Math.max(3, 8);
        System.out.println("最大値は" + max + "です");
        //Scannerで文字列を受け取る
        Scanner scanner = new Scanner(System.in);
        System.out.print("あなたの名前 : ");
        String name = scanner.next();
        System.out.println("あなたの名前は" + name + "です");
        //数値の入力を受けとる
        System.out.print("年齢:");
        int age = scanner.nextInt();
        System.out.print("体重:");
        double weight = scanner.nextDouble();
        System.out.println("あなたの名前は" + age + "です");
        System.out.println("あなたの名前は" + weight + "です");
    }

    //メゾット定義
    public static void hello() {
        System.out.println("Hello World");
        //voidは戻り値はない
        System.out.println("こんにちわ");
        //同名メゾット
        System.out.println("こんにちは世界");
    }

    //メゾットを引き渡す
    public static void hello(String name) {
        System.out.println(name + "さんこんにちは");
    //オーバーロード
        System.out.println("こんにちわ" + name +  "さん");
    }
    //複数の引数を渡してみよう
    public static void Printprice(String item, int price) {
        System.out.println(item + "は" + price + "円です");
    }
    //戻り値の具体例
    public static int add(int a, int b) {
        return a + b;
    }
    //メゾットを組み合わせる
    public static double average(int c, int d) {
        int total = add(c, d);
        return (double) total / 2;
    }

    public static int ad(int c, int d) {
        return c + d;
    }
    //真偽値を返す
    public static boolean isEven(int a) {
        return a % 2 == 0;
    }
}
