public class ArrayExample {
    public static void main(String[] args) {
        // Definir un array de números
        int[] numeros = {1, 2, 3, 4, 5};

        // Inicializar una variable para almacenar la suma de los números pares
        int sumaPares = 0;

        // Recorrer el array y sumar los números pares
        for (int i = 0; i < numeros.length; i++) {
            if (numeros[i] % 2 == 0) {
                sumaPares += numeros[i];
            }
        }

        // Imprimir la suma de los números pares
        System.out.println("La suma de los números pares es: ");
        System.out.println(sumaPares);
    }
}
