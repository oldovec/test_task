<?php
require_once 'lib/simple_html_dom.php';

if(!$_POST['team']){ ?>
    <form action="4.php" method="post">
        <input type="text" name="team" placeholder="Введите название команды">
        <input type="submit" value="Ok">
        <input type="reset" value="Reset">
    </form>
<?
    die();
}
$tables = array(
    '2019-20'   => 'https://terrikon.com/football/italy/championship/table',
    '2009-10'   => 'https://terrikon.com/football/italy/championship/2009-10/table'
);

for($i = 10; $i < 19; $i++)
    $tables['20'.$i.'-'.($i + 1)] = 'https://terrikon.com/football/italy/championship/20'.$i.'-'.($i + 1).'/table';

krsort($tables);

foreach($tables as $key => $table){
    foreach (file_get_html($table)->find('tr') as $item){
        $position = stripos($item->innertext, trim($_POST['team']));
        if($position == 80 || $position == 79)
            echo $key.' '.explode('.', $item->innertext)[0].'<br>';
    }
}