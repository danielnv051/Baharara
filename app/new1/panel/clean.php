<?php
require_once '../func.php';
db();

$sql = "SELECT * FROM `cbd` WHERE `buy_pos` = '+' ORDER BY `id` DESC";
$result = mysqli_query($GLOBALS['conn'], $sql);
$num = mysqli_num_rows($result);
$n = 0;
for ($i = 0; $i < $num; $i++) {
    $row = mysqli_fetch_array($result);

    $sqli = "SELECT * FROM `factor` WHERE `factor_id` = " . $row['factor_id'] . " ORDER BY `id` DESC";
    $resulti = mysqli_query($GLOBALS['conn'], $sqli);
    $numi = mysqli_num_rows($resulti);
    if ($numi == 0) {
        $n++;
        $sqlw = "UPDATE `cbd` SET `buy_pos` = '-' WHERE `cbd`.`id` =" . $row['id'];
        $resultw = mysqli_query($GLOBALS['conn'], $sqlw);
        if ($resultw) {
            echo 'cbd: ' . $row['id'] . '    factor:' . $row['factor_id'] . '<br/>';
        }
    }
}

$sqlb = "DELETE FROM `cbd` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);
$sqlb = "DELETE FROM `factor` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);
$sqlb = "DELETE FROM `seller_loc` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);

$sqlq = "SELECT * FROM `factor` WHERE 1 ORDER BY `id` DESC";
$resultq = mysqli_query($GLOBALS['conn'], $sqlq);
$nums = mysqli_num_rows($resultq);
$m = 0;
for ($j = 0; $j < $nums; $j++) {
    $rowq = mysqli_fetch_array($resultq);

    $sqli = "SELECT * FROM `cbd` WHERE `factor_id` = " . $rowq['factor_id'] . " ORDER BY `id` DESC";
    $resulti = mysqli_query($GLOBALS['conn'], $sqli);
    $numi = mysqli_num_rows($resulti);
    if ($numi == 0) {
        $m++;
    }
}

echo '<br/>SUM:' . $m;
