<?php

$words = ['red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 'gold', 'gray', 'tomato'];
$count = count($words) - 1;

for ($i = 0; $i < 25; $i++) {
    do {
        $color = rand(0, $count);
        $word = rand(0, $count);
    } while ($word == $color);

    echo '<span style="color:' . $words[$color] . '">' . $words[$word] . '</span>';

    /*Переход на новую строку после 5 слова*/
    if (($i + 1) % 5 == 0){
        echo '</br>';
    } else{
      echo '';
    }
}
?>
