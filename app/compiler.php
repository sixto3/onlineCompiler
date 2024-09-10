<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

    // Verifica si la solicitud es un POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica si se ha enviado el parámetro 'language'
        if (!isset($_POST['language'])) {
            echo "Error: Debe seleccionar un lenguaje.";
            exit;
        }

        $language = strtolower($_POST['language']);
        $code = $_POST['code'] ?? null;

        // Verifica si se ha enviado el parámetro 'code'
        if ($code === null) {
            echo "Error: El código no puede estar vacío.";
            exit;
        }

        if ($language == "java") {
            // Extrae el nombre de la clase pública del código
            preg_match('/public class (\w+)/', $code, $matches);
            $className = $matches[1] ?? null;

            if ($className) {
                // Usa el nombre de la clase como nombre del archivo
                $filePath = "temp/" . $className . "." . $language;
                $programFile = fopen($filePath, "w");
                fwrite($programFile, $code);
                fclose($programFile);

                // Compila el código Java y captura la salida
                $compileOutput = shell_exec("javac $filePath 2>&1");

                // Verifica si la compilación fue exitosa
                if (strpos($compileOutput, 'error') !== false) {
                    // Si hubo un error, devuelve la salida de la compilación
                    $output = $compileOutput;
                } else {
                    // Si la compilación fue exitosa, ejecuta el programa Java y captura la salida
                    $output = shell_exec("java -cp temp $className 2>&1");
                }

                // Reemplaza \n con <br> en la salida
                $output = str_replace("\n", "<br>", $output);

                // Imprime la salida
                echo $output;
            } else {
                echo "Error: No se pudo encontrar el nombre de la clase en el código.";
            }
        } else {
            // Para otros lenguajes, no hace nada
            echo "Código recibido para otro lenguaje, pero no se procesará.";
        }
    } else {
        // Mensaje para cuando no se realiza una solicitud POST
        echo "Por favor, envíe una solicitud POST con los parámetros necesarios.";
    }
?>

