<?php

$database = new mysqli('localhost', 'root', '', 'test_amasty');

$balances = 'SELECT (100 -
            (SELECT IF(SUM(amount) IS NULL, 0, SUM(amount)) FROM transactions as mt WHERE pf.id = mt.from_person_id) +
            (SELECT IF(SUM(amount) IS NULL, 0, SUM(amount)) FROM transactions as pt WHERE pf.id = pt.to_person_id)
        ) as balance, pf.fullname
    FROM transactions
             RIGHT JOIN persons AS pf ON from_person_id = pf.id
    GROUP BY pf.fullname';

$res = $database->query($balances);

while($row = $res->fetch_assoc())
    echo $row['fullname'].' '.round($row['balance'], 4, PHP_ROUND_HALF_UP).'<br>';

$cities = 'SELECT c.name
    as name FROM persons as p
        INNER JOIN cities AS c ON c.id = p.city_id
    WHERE c.id = (SELECT MAX(
                (SELECT COUNT(tt.transaction_id) FROM transactions AS tt WHERE p.id = tt.to_person_id) +
                (SELECT COUNT(tf.transaction_id) FROM transactions AS tf WHERE p.id = tf.from_person_id)))';

$res = $database->query($cities);

while($city = $res->fetch_row())
    echo $city[0].'<br>';

$same_cities = 'SELECT t.transaction_id, t.from_person_id, t.to_person_id, t.amount FROM transactions as t
        RIGHT JOIN persons AS p ON p.id = t.from_person_id
        RIGHT JOIN cities AS c on p.city_id = c.id
        RIGHT JOIN persons AS pt ON pt.id = t.to_person_id
        RIGHT JOIN cities AS ct on pt.city_id = ct.id
    WHERE c.id = ct.id';

$res = $database->query($same_cities);

while($transaction = $res->fetch_assoc()){
    print_r($transaction);
    echo '<br>';
}