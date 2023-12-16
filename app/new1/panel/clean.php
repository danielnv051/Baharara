<?php
require_once '../func.php';
db();

$n = 0;

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
            echo 'cbd: ' . $row['id'] . '    factor:' . $row['factor_id'];
        }
    }
}

echo '<br/>number: ' . $n;

$sqlb = "DELETE FROM `cbd` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);
$sqlb = "DELETE FROM `factor` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);
$sqlb = "DELETE FROM `seller_loc` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);
