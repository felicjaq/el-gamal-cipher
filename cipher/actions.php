<?php

include __DIR__ . "/keys.php";
include __DIR__ . "/constants.php";


function encrypt_message($files) : void {
    $keys = keys_generation();
    $p = $keys[0]; $g = $keys[1]; $x = $keys[2]; $y = $keys[3];
    $ascii_message = [];
    foreach ($files as $part) {
        $ascii_message[] = unpack("C*", $part);
    }
    $k = get_k_value($keys[0]); $a = bcpowmod($g, $k, $p);
    $b = [];
    foreach ($ascii_message as $ascii_part) {
        var_dump($ascii_part);
        foreach ($ascii_part as $item) {
            $b[] = (int) $item * bcpowmod($y, $k, $p) % $p. " ";
        }
    }

    file_put_contents("../files/output/output_encrypt_message.txt", $b);


    echo "All keys: \np: ".$p."\n"."g: ".$g."\n"."x: ".$x."\n"."y: ".$y."\n"."k: ".$k."\n"."a: ".$a."\n";

    exit('Ваше сообщение успешно зашифровано');
}


function decrypt_message($message, $p, $a, $x) : void {
    $b = explode(" ", $message); $mes = [];
    array_pop($b);

    for($j = 0; $j < count($b); $j++) {
        $mes[$j] = $b[$j] * bcpowmod($a, $p - 1 - $x, $p) % $p;
    }

    $decrypted_message = [];
    for ($i = 0; $i < count($mes); ++$i)
        $decrypted_message[$i] =  chr($mes[$i]);

    file_put_contents("../files/output/output_decrypt_message.txt", implode($decrypted_message));
    exit('Ваше сообщение успешно расшифровано');
}

