class Person {
    public static void printData(String name, int age, double height, double weight) {
        System.out.println("私の名前は" + name + "です");
        System.out.println("年齢は" + age + "歳です");
        System.out.println("身長は" + height + "mです");
        System.out.println("体重は" + weight + "kgです");

        double bmi = bmi(height, weight);
        System.out.println("BMIは" + bmi + "です");

        // isHealthyメソッドの結果で条件分岐を行ってください
        if (isHealthy(bmi)) {
            System.out.println("健康です");
        } else {
            System.out.println("健康ではありません");
        }
    }

    public static String fullName(String firstName, String lastName) {
        return firstName + " " + lastName;
    }

    public static String fullName(String firstName, String middleName, String lastName) {
        return firstName + " " + middleName + " " + lastName;
    }

    public static double bmi(double height, double weight) {
        return weight / height / height;
    }

    // isHealthyメソッドを定義してください
    public static boolean isHealthy(double bmi) {
        return bmi >= 18.5 && bmi < 25.0;
    }

    //インスタンスメソッドの定義
    public void hello() {
        System.out.println("こんにちは");
    }

    //インスタンスフィールドの定義
    public String name;

    //this
    public void morning() {
        System.out.println("おはようございます、私は" + this.name + "です");
    }

    //コンストラクタの具体例
    Person() {
        System.out.println("インスタンスが生成されました");
    }

    //コンストラクタでフィールドをセットする
    Person(String name) {
        this.name = name;
    }

    //コンストラクタを作ろう
    //クラスフィールドの具体例
    public static int count = 0;
    public String firstName;
    public String middleName;
    public String lastName;
    //カプセル化
    private int age;
    public double height;
    public double weight;

    Person(String firstName, String lastName, int age, double height, double weight) {
        Person.count++;
        this.firstName = firstName;
        this.lastName = lastName;
        this.age = age;
        this.height = height;
        this.weight = weight;
    }
    //インスタンスメソッドに書き換える
    // public String fullName() {
    //     return this.firstName + " " + lastName;
    // }

    public double bmi() {
        return this.weight / this.height / this.height;
    }

    //他のインスタンスメソッドを呼びだそう
    public void printData() {
        System.out.println("私の名前は" + this.fullName() + "です");
        System.out.println("年齢は" + this.age + "歳です");
        System.out.println("身長は" + this.height + "mです");
        System.out.println("体重は" + this.weight + "kgです");
        System.out.println("BMIは" + Math.round(this.bmi()) + "です");
    }

    //クラスに属するメゾット
    public static void printCount() {
        System.out.println("合計" + Person.count + "人です");
    }

    //コンストラクタのオーバーロード
    Person(String firstName, String middleName, String lastName, int age, double height, double weight) {
        // Person.count++;
        // this.firstName = firstName;
        // this.middleName = middleName;
        // this.lastName = lastName;
        // this.age = age;
        // this.height = height;
        // this.weight = weight;
        //他のコンストラクタを呼び出す
        this(firstName, lastName, age, height, weight);
        this.middleName = middleName;
    }

    //fullNameメソッドの書き換え
    public String fullName() {
        if (this.middleName == null) {
            return this.firstName + " " + this.lastName;
        } else {
            return this.firstName + " " + this.middleName + " " + this.lastName;
        }
    }

    //ゲッター
    public String getMiddleName() {
        return this.middleName;
    }

    //セッター
    public void setMiddleName(String middleName) {
        this.middleName = middleName;
    }

    public void buy(Car01 car01) {
        car01.setOwner(this);
    }

    public void buy(Bicycle01 bicycle01) {
        bicycle01.setOwner(this);
    }

    public void buy(Vehicle vehicle) {
        vehicle.setOwner(this);
    }
}
