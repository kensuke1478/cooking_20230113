class Bicycle01 extends Vehicle {
    Bicycle01() {
        super();
        System.out.println("サブクラスのコンストラクタです");
    }

    Bicycle01(String name, String color) {
        super(name, color);
    }

    public void run(int distance) {
        System.out.println(distance + "km走ります");
        this.distance += distance;
        System.out.println("走行距離：" + this.distance + "km");
}
    }
