<?php
/**
 * @var string $argv
 */

$array = array_map('intval', array_filter(explode(' ', $argv[1]), 'is_numeric'));

$array = array_unique($array);

asort($array);

foreach ($array as $value){
    echo $value.' ';
}