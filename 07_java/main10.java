public class main10 {
    public static void main(String[] args) {
        try{
            InputStreamReader reader = new InputStreamReader(new FileInputStream(args[0]));
            BufferedReader buff = new BufferedReader(reader);

            String text ;
        Map<String,String> map = new TreeMap<String,String>(new NameComparator());

            while ((text = buff.readLine()) != null) {
                String[] value = text.split(" ");
            map.put(value[0], value[1]);
            }
            reader.close();

        for(Map.Entry<String, String> e : map.entrySet()) {
                System.out.println(e.getKey() + " : " + e.getValue());
            }

        }catch(FileNotFoundException fnoe){
            fnoe.printStackTrace();
        }catch(IOException ioe){
            ioe.printStackTrace();
        }
    }
}
class NameComparator implements Comparator<String>{

    @Override
    public int compare(String o1, String o2) {
        if(o1.length() > o2.length()){
            return 1 ;
        }
        if(o1.length() < o2.length()){
            return -1 ;
        }
        return o1.compareTo(o2);
    }
}
