<?php

require("./preprocessing/preprocessing.php");

function main() : void {
    echo "C предобработкой или нет? 1 - да, 2 - нет";
    $stream = fgets(STDIN);
    if ($stream == '1') {
        text_preprocessing();
    } else if ($stream == '2') {
        el_gamal_menu();
    } else {
        exit("косяк");
    }
}

main();