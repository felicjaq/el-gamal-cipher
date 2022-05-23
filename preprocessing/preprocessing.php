<?php

function text_preprocessing(): void {
    echo "Укажите путь к файлу для предобработки и делиметр: ";
    $stream = explode(" ", trim(fgets(STDIN)));
    $input_file = $stream[0]; $delimiter = $stream[1];
    if (file_exists($input_file)) {
        $message = explode($delimiter, file_get_contents($input_file));
        for ($i = 0; $i < count($message); $i++) {
            file_put_contents("../files/input/input_parts/part_" . $i . ".txt", $message[$i]);
        }
    } else {
        exit("Неверный путь");
    }
}


text_preprocessing();
