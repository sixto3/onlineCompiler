public class Main {
    public static void main(String[] args) {
        SubClass sub = new SubClass();
        sub.display();
        
        int result = sub.addd(5, 3);
        System.out.println("Result of addition: " + result)
    }
}

class SubClass {
    void display() {
        System.out.println("This is a method of the SubClass.");
    }
    
    int add(int a, int b) {
        return a + b;
    }
}
