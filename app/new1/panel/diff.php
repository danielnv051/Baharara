<style>
    @font-face {
        font-family: 'iransans';
        src: url('fonts/IRANSansWeb(FaNum).ttf');
    }

    table {
        font-family: 'iransans';
    }

    td {
        border: 1px solid silver;
        text-align: center;
    }
</style>

<table>
    <tr>
        <td>کد مشتری</td>
        <td>نام مشتری</td>
        <td>مانده(مالی)</td>
        <td>مانده(پیگیری مالی فاکتور ها)</td>
    </tr><?php

            require_once '../func.php';

            db();
            $sql = "SELECT * FROM mande WHERE 1";
            $r = mysqli_query($GLOBALS['conn'], $sql);
            if ($r) {
                $n = mysqli_num_rows($r);
                for ($i = 0; $i < $n; $i++) {
                    $rr = mysqli_fetch_assoc($r);
                    $code = $rr['code'];
                    $customer_name = $rr['desc'];
                    $mande = $rr['mande'];

                    $sqla = "SELECT * FROM remain_cash WHERE customer LIKE '%$customer_name%'";
                    $ra = mysqli_query($GLOBALS['conn'], $sqla);
                    $nn = mysqli_num_rows($ra);
                    if ($nn > 0) {
                        $jam = 0;
                        for ($k = 0; $k < $nn; $k++) {
                            $ww = mysqli_fetch_assoc($ra);
                            $remain_cash = $ww['fee'];
                            $seller = $ww['seller'];
                            $jam += intval($remain_cash);
                        }
                        if ($mande < $jam) {
                            echo '
                        <tr>
                            <td>' . $code . '</td>
                            <td>' . $customer_name . '</td>
                            <td>' . sep3($mande) . '</td>
                            <td>' . sep3($jam) . '</td>
                        </tr>
                    ';
                        }
                    }
                }
            }
            ?>
</table>