<?php

function text_preprocessing(): void {
    echo "Укажите относительный путь к файлу для предобработки и делиметр: ";
    $stream = explode(" ", trim(fgets(STDIN)));
    echo "Укажите относительный путь к директории, в которую вы хотите сохранить обработанный текст: ";
    $dir = trim(fgets(STDIN));
    if(!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    $input_file = $stream[0]; $delimiter = $stream[1];
    if (file_exists($input_file)) {
        $message = explode($delimiter, file_get_contents($input_file));
        for ($i = 0; $i < count($message); $i++) {
            file_put_contents($dir. "/part_" . $i . ".txt", $message[$i]);
        }
    } else {
        exit("Вы ввели неправильный путь, попробуйте еще раз: \n");
    }
}


text_preprocessing();
