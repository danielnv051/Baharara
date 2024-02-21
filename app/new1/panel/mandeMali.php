<link rel="stylesheet" href="../css/bootstrap-rtl.min.css" />

<?php
require_once '../func.php';
error_reporting(0);

$region = [];
$mandeha = [];
$mandehaa = [];
$visitor_name = [];

function regions()
{
    db();
    $s = "SELECT DISTINCT(region) FROM `moshtari`";
    $r = mysqli_query($GLOBALS['conn'], $s);
    if ($r) {
        $num = mysqli_num_rows($r);
        for ($i = 0; $i < $num; $i++) {
            $rows = mysqli_fetch_assoc($r);
            $GLOBALS['region'][$i] = $rows['region'];
        }
    }
}

function visitor($customer)
{
    db();
    $s = "SELECT * FROM `remain_cash` WHERE `customer` = '" . $customer . "'";
    $r = mysqli_query($GLOBALS['conn'], $s);
    if ($r) {
        $num = mysqli_num_rows($r);
        if ($num > 0) {
            $rows = mysqli_fetch_assoc($r);
            return $rows['seller'] . ',' . $rows['tarikh'];
        }
    }
}

function mande_customer($code)
{
    db();
    $sql = "SELECT * FROM `mande` WHERE `code` = " . $code;
    $w = mysqli_query($GLOBALS['conn'], $sql);
    if ($w) {
        $num = mysqli_num_rows($w);
        if ($num > 0) {
            $rows = mysqli_fetch_assoc($w);
            $mande = $rows['mande'];
            return $mande;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function mande_customer_name($name, $region)
{
    db();
    $sql = "SELECT * FROM `moshtari` WHERE `esm` LIKE '%" . $name . "%' AND `region` = '" . $region . "'";
    $w = mysqli_query($GLOBALS['conn'], $sql);
    if ($w) {
        $num = mysqli_num_rows($w);
        if ($num > 0) {
            $rows = mysqli_fetch_assoc($w);
            $code = $rows['code'];

            $sql = "SELECT * FROM `mande` WHERE `code` LIKE '%" . $code . "%'";
            $w = mysqli_query($GLOBALS['conn'], $sql);
            if ($w) {
                $num = mysqli_num_rows($w);
                if ($num > 0) {
                    $rows = mysqli_fetch_assoc($w);
                    $mande = $rows['mande'];
                    return $mande;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }
    }
}

function mande_by_region($region)
{
    db();
    $sql = "SELECT * FROM `moshtari` WHERE `region` = '" . $region . "'";
    $w = mysqli_query($GLOBALS['conn'], $sql);
    if ($w) {
        $num = mysqli_num_rows($w);
        for ($i = 0; $i < $num; $i++) {
            $rows = mysqli_fetch_assoc($w);
            $code = $rows['code'];
            $esm = $rows['esm'];
            $addr = $rows['addr'];
            $mande = mande_customer($code);
            $ww = visitor("$esm");
            $www = explode(',', $ww);
            if (intval($mande) > 0) {
                $GLOBALS['mandeha'][$region][$code] = ['name' => $esm, 'mande' => $mande, 'addr' => $addr, 'seller' => $www[0]];
            }
        }
    }
}

function mande_by_visitor($visitor_name, $region)
{
    db();
    $sql = "SELECT * FROM `remain_cash` WHERE `seller` = '" . $visitor_name . "'";
    $w = mysqli_query($GLOBALS['conn'], $sql);
    if ($w) {
        $num = mysqli_num_rows($w);
        for ($i = 0; $i < $num; $i++) {
            $rows = mysqli_fetch_assoc($w);
            $customer = $rows['customer'];
            if ($visitor_name != '-') {
                $mande = mande_customer_name("$customer", $region);
                if (intval($mande) > 0) {
                    $GLOBALS['mandehaa']["$visitor_name"]['mande'] += $mande;
                }
            }
        }
    }
}

if (isset($_GET['region'])) {
    regions();
    $count = count($region);
    $regions = $_GET['region'];
    for ($i = 0; $i < $count; $i++) {
        mande_by_region("$regions");
    }
} else {
    regions();
    $count = count($region);
    for ($i = 0; $i < $count; $i++) {
        mande_by_region("$region[$i]");
    }
}

$man = $region;


function final_report()
{
    $mantaghe = '';
    $sum = 0;
    $sum_region = 0;

    db();
    $s = "SELECT DISTINCT(region) FROM `moshtari`";
    $r = mysqli_query($GLOBALS['conn'], $s);
    if ($r) {
        $num = mysqli_num_rows($r);
        for ($i = 0; $i < $num; $i++) {
            $rows = mysqli_fetch_assoc($r);
            $reg = $rows['region'];

            if (isset($GLOBALS['mandeha']["$reg"])) {
                $count = count(array_keys($GLOBALS['mandeha']["$reg"]));
                $keys = array_keys($GLOBALS['mandeha']["$reg"]);
                if (isset($count) && $count > 0) {
                    if ($mantaghe != $reg) {
                        echo '
                            <tr style="background: #EEEEEE;">
                                <th colspan="5" style="text-align: center;">شهر/منطقه: ' . $reg . '</th>
                            </tr>
                            <tr>
                                <th>کد مشتری</th>
                                <th>نام مشتری</th>
                                <th>مانده بدهی(ریال)</th>
                                <th>تاریخ</th>
                                <th>بازاریاب</th>
                            </tr>
                        ';
                        $mantaghe = $reg;
                    }
                    for ($k = 0; $k < $count; $k++) {
                        $cus_code = $keys[$k];
                        $cus_name = $GLOBALS['mandeha']["$reg"][$keys[$k]]['name'];
                        $cus_mande = $GLOBALS['mandeha']["$reg"][$keys[$k]]['mande'];
                        $cus_addr = $GLOBALS['mandeha']["$reg"][$keys[$k]]['addr'];

                        $remain = visitor("$cus_name");
                        if ($remain) {
                            $c = explode(',', $remain);
                            $visitor = $c[0];
                            $tarikh = $c[1];
                            $GLOBALS['visitor_name'][$visitor] = $visitor;
                        } else {
                            $visitor = '-';
                            $tarikh = '-';
                        }

                        $esm = explode('(', $cus_name);
                        if (strlen($tarikh) > 2) {
                            $zaman = '<td rowspan="1" style="text-align:center">' . substr($tarikh, 0, 4) . '/' . substr($tarikh, 4, 2) . '/' . substr($tarikh, 6, 2) . '</td>';
                        } else {
                            $zaman = '<td rowspan="1" style="text-align:center">-</td>';
                        }

                        if ($visitor != '-') {
                            $sum_region += $cus_mande;

                            echo '
                            <tr>
                                <td rowspan="1" style="text-align:center">' . $cus_code . '</td>
                                <td rowspan="1" style="text-align:right;font-weight:bold">' . $esm[0] . ' (' . $cus_addr . ')</td>
                                <td rowspan="1" style="text-align:center">' . sep3($cus_mande) . '</td>
                                ' . $zaman . '
                                <td rowspan="1" style="text-align:center">' . $visitor . '</td>
                            </tr>
                        ';
                        }
                    }
                    echo '
                        <tr>
                            <th colspan="5" style="text-align: center;background: #757575; color: #fff;">جمع کل بدهی ' . $reg . ': ' . sep3($sum_region) . ' ریال</th>
                        </tr>
                        <tr class="sep">
                            <td colspan="5"></td>
                        </tr>
                    ';
                    $sum_region = 0;
                }
            }
        }
    }
}
?>

<table>
    <?php
    final_report();
    ?>
</table>

<?php
/* $keyss = array_keys($visitor_name);
$cc = count($keyss);
for ($ll = 0; $ll < $cc; $ll++) {
    $vv = $_GET['region'];
    mande_by_visitor("$keyss[$ll]", "$vv");
} */

?>
<table>
    <tr>
        <th>نام بازاریاب</th>
        <th>مانده به تفکیک بازاریاب در منطقه
            <?php
            if (isset($_GET['region'])) {
                $makan = $_GET['region'];
            } else {
                $makan = 'همه مناطق';
            };
            echo $makan;

            $v_n = '';
            $re = array_keys($mandeha)[0];
            $re_code = array_keys($mandeha[$re])[0];
            $re_code_detail = array_keys($mandeha[$re][$re_code]);
            echo ($mandeha[$re][$re_code]['seller']);

            ?>
        </th>
    </tr>

</table>

<table class="from_">
    <tr>
        <td>
            <form action="mandeMali.php" method="get">
                <select name="region" class="form-control">
                    <?php
                    regions();
                    $count = count($region);
                    $key = array_keys($region);
                    for ($i = 0; $i < $count; $i++) {
                        echo '<option value="' . $region[$i] . '">' . $region[$i] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="نمایش" class="btn btn-success">
            </form>
        </td>
    </tr>
</table>

<style>
    @font-face {
        font-family: 'iransans';
        src: url('./fonts/IRANSansWeb(FaNum).ttf');
    }


    table,
    th,
    td {
        border: 1px solid silver;
        font-family: 'iransans';
        font-size: 0.8rem;
    }

    td {
        padding: 0.2rem;
    }

    table {
        width: -webkit-fill-available;
        border: none;
        margin: 0.5rem;
    }

    .sep td {
        border: none;
        height: 0.3rem;
    }

    form {
        text-align: center;
    }

    .btn {
        margin: 1rem auto;
        width: 30%;
        height: 2.5rem;
    }

    select {
        width: 30%;
        margin: 0 auto;
    }

    th {
        text-align: center;
    }

    @media print {

        table.form_,
        form {
            display: none;
        }
    }
</style>
<script src="../js/bootstrap.min.js"></script>