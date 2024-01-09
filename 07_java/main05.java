public class main05 {
    public static void main(String[] args) {

        //インスタンスを変数を代入
        Person person = new Person();
        person.hello();

        //インスタンスを複数生成する
        Person person1 = new Person();

        //インスタンスフィールドへのアクセス
        person1.name = "Suzuki";
        System.out.println(person1.name);

        //this
        Person person2 = new Person();
        person2.name = "Okuma";
        person2.morning();

        //コンストラクタでフィールドをセットする
        Person person3 = new Person("Katou");
        System.out.println(person3.name);

        //インスタンスメソッドの呼び出し
        person1.hello();
        person2.hello();
        person3.hello();

        //コンストラクタを作ろう
        Person person4 = new Person("Kate", "Jones", 27, 1.6, 50.0);
        person4.printData();
        // System.out.println(person4.firstName);
        // System.out.println(person4.lastName);
        // System.out.println(person4.age);
        // System.out.println(person4.height);
        // System.out.println(person4.weight);

        //クラスフィールドへのアクセス
        Person person5 = new Person("aaa", "bbb", 25, 1.8, 60.0);
        person5.printData();
        System.out.println("合計は" + Person.count + "人です");

        //クラスに属するメゾット
        Person person6 = new Person("bbb", "ccc", 26, 1.9, 70.0);
        person6.printData();
        Person.printCount();

        //コンストラクタのオーバーロード
        Person person7 = new Person("mmm", "ddd", "eee", 27, 2.0, 80.0);
        person7.printData();
        System.out.println(person.fullName());
        //ゲッター
        Person person8 = new Person("mm", "dd", "ee", 28, 2.1, 80.1);
        person8.printData();
        System.out.println("person8のミドルネームは" + person8.getMiddleName() + "です");
        //セッター
        Person person9 = new Person("mm", "jj","ee", 28, 2.1, 80.1);
        person9.setMiddleName("Claire");
        person9.printData();
        System.out.println("ミドルネームを" + person9.getMiddleName() + "に変更しました");
    }
}
