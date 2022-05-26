<?php

include __DIR__ . "/actions.php";

function el_gamal_menu() : void {
    echo "Какую операцию вы хотите выполнить: \n1 - зашифровать, 2 - расшифровать \nОперация: ";
    $stream = fgets(STDIN);
    if($stream == '1') {
        echo "Укажите путь до директории с предобработанным текстом: ";
        $input_dir = trim(fgets(STDIN));
        echo "Куда вы хотите сохранить зашифрованное сообщение? Укажите путь: ";
        $output_file = trim(fgets(STDIN));
        $files = array_diff(scandir($input_dir), array('..', '.'));
        $parts = [];
        foreach ($files as $file) {
            $parts[] = file_get_contents($input_dir . "/" . $file);
        }
        encrypt_message($parts, $output_file);
    } else if($stream == 2) {
        if(!get_task()) {
            exit("Неправильный ответ, попробуйте еще раз");
        }
        echo "Укажите путь до файла с сообщением, которое нужно расшифровать: ";
        $input_file = trim(fgets(STDIN));
        if(!file_exists($input_file)) {
            exit("Неправильный путь, попробуйте еще раз \n");
        }
        echo "Куда вы хотите сохранить расшифрованное сообщение? Укажите путь: ";
        $output_file = trim(fgets(STDIN));
        echo "Укажите параметры { p, a, x }, необходимые для расшифровки: ";
        $keys_stream = explode(" ", trim(fgets(STDIN)));
        $p = (int)$keys_stream[0]; $a = (int)$keys_stream[1]; $x = (int)$keys_stream[2];
        $message = file_get_contents($input_file);
        decrypt_message($message, $p, $a, $x, $output_file);
    } else {
        exit("Неправильный номер операции");
    }
}

el_gamal_menu();

function get_task() : bool {
    $number_1 = rand(5, 10); $number_2 = rand(1, 5);
    $operations = array("+", "-");
    $rand_operation = array_rand($operations);
    if($rand_operation == 0) {
        $answer = $number_1 + $number_2;
    } else {
        $answer = $number_1 - $number_2;
    }
    echo "А вы точно не робот?\n";
    echo  $number_1 . " " . $operations[$rand_operation] . " " . $number_2 . " = ";
    $stream = trim((int)fgets(STDIN));
    if ($stream == $answer) {
        return true;
    }

    return false;
}