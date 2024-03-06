<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");


    $language = strtolower($_POST['language']);
    $code = $_POST['code'];    

    

    if ($language == "java"){
        // Extract the public class name from the code
        preg_match('/public class (\w+)/', $code, $matches);
        $className = $matches[1] ?? null;

        if ($className) {
            // Use the class name as the filename
            $filePath = "temp/" . $className . "." . $language;
            $programFile = fopen($filePath, "w");
            fwrite($programFile, $code);
            fclose($programFile);
        }

        // Compile the Java code and capture the output
        $compileOutput = shell_exec("javac $filePath 2>&1");

        // Check if the compilation was successful
        if (strpos($compileOutput, 'error') !== false) {
            // If there was an error, return the compilation output
            $output = $compileOutput;
        } else {
            // If the compilation was successful, execute the Java program and capture the output
            $output = shell_exec("java -cp temp $className 2>&1");
        }

        // Replace \n with <br> in the output
        $output = str_replace("\n", "<br>", $output);

        // Echo the output
        echo $output;
    } else {
        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = "temp/" . $random . "." . $language;
        $programFile = fopen($filePath, "w");
        fwrite($programFile, $code);
        fclose($programFile);
    }
