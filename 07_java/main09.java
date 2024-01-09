public class main09 {
    public static void main(String[] args) throws Exception {
        try {
            String name = null;
            name = name.substring(0);//①
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        try {
            String values[] = new String[2];
            values[2] = "value";//②
        } catch (Exception ex) {
            ex.printStackTrace();
        }

        try {
            Object value = "value";
            Integer number = (Integer) value;//③
        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }
}
