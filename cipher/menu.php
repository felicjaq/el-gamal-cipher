<?php

include __DIR__ . "/actions.php";

function el_gamal_menu() : void {
    echo "Какую операцию вы хотите выполнить: \n1 - шифровать, 2 - расшифровать \nОперация: ";
    $stream = fgets(STDIN);
    if($stream == '1') {
        $files = array_diff(scandir("../files/input/input_parts"), array('..', '.'));
        $parts = [];
        foreach ($files as $file) {
            $parts[] = file_get_contents("../files/input/input_parts/" . $file);
        }
        encrypt_message($parts);
    } else if($stream == 2) {
        if(!get_task()) {
            exit('Вы робот, уходите');
        }
        echo "Укажите параметры p, a, x: ";
        $keys_stream = explode(" ", trim(fgets(STDIN)));
        $p = (int)$keys_stream[0]; $a = (int)$keys_stream[1]; $x = (int)$keys_stream[2];
        $message = file_get_contents("../files/output/output_encrypt_message.txt");
        decrypt_message($message, $p, $a, $x);
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