import java.util.Scanner;
class Main07 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        Person person = new Person("Kate","Jones",27,1250,800.0);
        Car01 car01 = new Car01("ランボルギーニ", "黒");
        Vehicle vehicle = new Car01("ランボルギーニ", "黒");
        car01.setOwner(person);
        car01.getOwner().printData();
        person.buy(car01);
        //System.out.println(car01.getFuel());
        // car01.setName("ランボルギーニ");
        // car01.setColor("黒");
        Bicycle01 bicycle01 = new Bicycle01();
        bicycle01.setName("モンキー");
        bicycle01.setColor("黄");

        System.out.println("【車の情報】");
        car01.printData();
        System.out.println("-----------------");
        System.out.print("走る距離を入力してください：");
        int carDistance = scanner.nextInt();
        car01.run(carDistance);
        System.out.println("【車の所有者の情報】");
        car01.getOwner().printData();

        System.out.println("-----------------");
        System.out.print("給油する量を入力してください：");
        int litre = scanner.nextInt();
        car01.charge(litre);

        System.out.println("=================");
        System.out.println("【自転車の情報】");
        bicycle01.printData();
        System.out.println("-----------------");
        System.out.print("走る距離を入力してください：");
        int bicycleDistance = scanner.nextInt();
        bicycle01.run(bicycleDistance);
    }
}
