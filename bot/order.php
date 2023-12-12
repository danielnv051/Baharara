<?php
require_once 'functions.php';
require_once 'jdf.php';

$data = [];
if ($_GET['date'] == '') {
    $zaman = date("Y-m-d");
} else {
    $zaman = $_GET['date'];
}

$bottle_100 = 0;
$bottle_30 = 0;
$bottle_5 = 0;
$b_5 = 0;
$b_30 = 0;
$b_100 = 0;
$vol = 0;
$haml = 0;

function sefaresh($tedad, $prod)
{
    $sefaresh = '';
    for ($p = 0; $p < $tedad; $p++) {
        $order = explode('*', $prod[$p]);
        $tedad_ev = count($order);
        for ($j = 0; $j < $tedad_ev; $j++) {
            if ($order[$j] == '') {
                $sefaresh .= '';
            } else {

                if ($j == 0) {
                    $sefaresh .= $order[0] . "<br>";
                } elseif ($j == 1) {
                    $sefaresh .= $order[1] . "میل <br>";
                } elseif ($j == 2) {
                    $x = explode(' ', $order[2]);
                    $te = explode(' ', $order[1]);
                    switch (intval($x[0])) {
                        case 5:
                            $GLOBALS['b_5'] += intval($te[0]);
                            break;
                        case 30:
                            $GLOBALS['b_30'] += intval($te[0]);
                            break;
                        case 100:
                            $GLOBALS['b_100'] += intval($te[0]);
                            break;
                    }
                    $sefaresh .= $order[2] . ' <br>';
                } elseif ($j == 3) {
                    $sefaresh .= $order[3] . '  درصد';
                } elseif ($j == 4) {
                    if ($order[4] == 1) {
                        $GLOBALS['haml'] = '✅';
                    } else {
                        $GLOBALS['haml'] = '❌';
                    }
                }
            }
        }
        $sefaresh .= "<span id='sep2'></span>";
    }
    return $sefaresh;
}

function order_info($zaman)
{
    db();
    global $order_data;
    $order_data = [];

    $sql = "SELECT * FROM `insta` WHERE zaman LIKE '%" . $zaman . "%' ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        $vaght = explode(' ', $row['zaman']);
        $prod = explode('$', $row['prod']);
        $tedad = count($prod);
        $id = $row['id'];

        $x = getFile($row['pic'], $id, 'img');
        if ($x == 1) {
            $img_file = $GLOBALS['file_path'];
        } else {
            $img_file = '';
        }


        $factor_pos = $row['factor'];
        if (isset($_GET['factor']) || $factor_pos == 'on') {
            $factor_input = "<input type='checkbox' name='factor' id='factor' class='form-control' checked/>";
        } else {
            $factor_input = "<input type='checkbox' name='factor' id='factor' class='form-control'/>";
        }

        $reject_pos = $row['reject'];
        if (isset($_GET['reject']) || $reject_pos == 'on') {
            $reject_input = "<input type='checkbox' name='reject' id='reject' class='form-control' checked/>";
        } else {
            $reject_input = "<input type='checkbox' name='reject' id='reject' class='form-control'/>";
        }

        $send_pos = $row['send'];
        if (isset($_GET['send']) || $send_pos == 'on') {
            $send_input = "<input type='checkbox' name='send' id='send' class='form-control' checked/>";
        } else {
            $send_input = "<input type='checkbox' name='send' id='send' class='form-control'/>";
        }

        $desc_pos = $row['desc'];
        $post_pos = $row['post'];

        $peygiri = $id . '0' . substr($row['tel_num'], 5) . substr($row['post_code'], 5);
        /*$sqp = "UPDATE insta SET peygiri = '" . $peygiri . "' WHERE id = " . $id;
        $resultqq = mysqli_query($GLOBALS['conn'], $sqp);*/

        $o_name = $row['full_name'];
        $o_city = $row['city'];
        $o_tel = $row['tel_num'];

        echo "<tr>
        <td>" . $id . "</td>
        <td>" . $row['full_name'] . "</td>
        <td>" . $row['state'] . "</td>
        <td>" . $row['city'] . "</td>
        <td>" . $row['addr'] . "</td>
        <td>" . $peygiri . "</td>
        <td>" . $row['post_code'] . "</td>
        <td>" . $row['tel_num'] . "</td>
        <td><a href='" . $img_file . "' target='_blank'><img src='" . $img_file . "' style='width:100px;border: 1px solid silver; border-radius: 0.5rem; box-shadow: 1px 1px 5px #000;'/></a></td>
        <td>" . $vaght[1] . "</td>";

        echo "<td>" . sefaresh($tedad, $prod) . "</td></tr>";

        echo "<form method='get' action='order.php?date=" . $zaman . "'>
        <tr style='background: #f0f8ff91;'>
        <td>
        *
        <td>
            <label for='factor'> صدور فاکتور " . $factor_input . "</label>
        </td>
        <td>
            <label for='send'> ارسال سفارش " . $send_input . "</label>
            <input type='hidden' value='" . $id . "' name='id' class='form-control'/>
            <input type='hidden' value='" . $zaman . "' name='date' class='form-control'/>
            <input type='hidden' value='" . $peygiri . "' name='factorNum' class='form-control'/>
            <input type='hidden' value='" . $o_tel . "' name='tel' class='form-control'/>
            <input type='hidden' value='" . $o_name . "' name='esm' class='form-control'/>
            <input type='hidden' value='" . $o_city . "' name='dest' class='form-control'/>
        </td>
        <td>
            <label for='send'> مرجوع "  . $reject_input . "</label>
        </td>
        <td>
            <label for='peygiri'> کد پیگیری <input type='number' name='peygiri' id='peygiri' class='form-control' style='height: 60px; width: 100px;' value='" . $post_pos . "'/></label>
        </td>
        <td>
            <label for='desc'> توضیحات <textarea name='desc' id='desc' class='form-control' style='width:80px; height:60px'>" . $desc_pos . "</textarea></label>
        </td>
        <td>100 <br>" . $GLOBALS['b_100'] . "</td>

        <td>30 <br>" . $GLOBALS['b_30'] . "</td>

        <td>5 <br>" . $GLOBALS['b_5'] . "</td>

        <td style='padding:0.2rem'>هزینه حمل<br>" . $GLOBALS['haml'] . "</td>

        <td>
            <input type='submit' value='ذخیره' class='btn btn-success'/>
        </td>
        </tr></form>";
    }
}


?>
</table>
<!doctype html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Title -->
    <title>سامانه سفارشات اینستاگرام</title>

    <!-- Favicon -->

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="style.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/public.js"></script>
    <style>
        body {
            direction: rtl;
        }

        table {
            text-align: center;
        }

        tr {
            border: 1px solid silver;
        }

        #first_row {
            font-weight: bold;
        }

        td {
            border: 1px solid silver;
            padding: 0.5rem;
            font-family: sans-serif;
            font-weight: bold;
        }

        button {
            margin: 1rem auto;
            margin-right: 1rem;
            border: none;
        }

        form {
            margin: 0 auto;
        }

        #sep {
            width: 100%;
            margin-bottom: 1rem;
            display: inline-block;
        }

        #sep2 {
            width: 100%;
            margin-bottom: 0.3rem;
            display: inline-block;
            border: 1px dashed red;
            margin-top: 0.6rem;
        }

        .middle-box input[type="checkbox"],
        .middle-box input[type="radio"] {
            display: inline;
        }

        .login-area .form-control {
            height: 27px;
        }

        textarea {
            height: 84px;
        }
    </style>
</head>

<body class="login-area">

    <!-- Preloader -->
    <!--     <div id="preloader">
        <div id="ctn-preloader" class="ont-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
            </div>


            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Preloader -->
    <!-- ======================================
    ******* Page Wrapper Area Start **********
    ======================================= -->
    <div class="main-content- h-100vh">
        <div class="container-fluid h-100">
            <!--             <div class="ba-logo" style="text-align: center;">
                <img src="../img/logo-ba.png" title="logo" id="logo"
                    style="max-width: 100px; height: auto; background: #01815f; border-radius: 50%; box-shadow: 0px 0px 6px #01815f4f; padding: 1rem;" />
            </div> -->
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-12 col-lg-12" style="width: inherit;">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4">

                                <!-- Logo -->

                                <h4 class="font-24 mb-1">سفارشات ثبت شده تاریخ :
                                    <?php
                                    $tarikh = explode('-', $zaman);
                                    $tt =  gregorian_to_jalali($tarikh[0], $tarikh[1], $tarikh[2]);
                                    echo $tt[0] . '/' . $tt[1] . '/' . $tt[2];
                                    ?></h4>
                                <p class="mb-30"></p>
                                <table>
                                    <tr id="first_row">
                                        <td>کد</td>
                                        <td>نام مشتری</td>
                                        <td>استان</td>
                                        <td>شهر</td>
                                        <td>آدرس</td>
                                        <td>کد پیگیری</td>
                                        <td>کدپستی</td>
                                        <td>موبایل</td>
                                        <td>تصویر وایز وجه</td>
                                        <td>زمان ثبت</td>
                                        <td>لیست سفارشات</td>
                                    </tr>
                                    <?php order_info($zaman);
                                    $b_100 = 0;
                                    $b_30 = 0;
                                    $b_5 = 0;
                                    ?>
                                </table>


                                <!-- end card -->
                            </div>
                            <div class="row" style="width: max-content; margin: 0 auto;">
                                <form method="get" action="order.php">
                                    <label>تاریخ مورد نظر را وارد کنید: <input type="date" name="date" id="day" class="form-control"> </label>
                                    <button type="submit" class="btn btn-warning">نمایش</button>
                                    <button><a href="https://barjio.com/label.php?date=<?php echo $_GET['date']; ?>" class="btn btn-primary">دانلود لیبل</a></button>
                                </form>
                            </div>
                            <input type="hidden" id="zaman" value="<?php echo $_GET['date']; ?> name=" date" />
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="">©</span>
                        <label class="font-12">
                            تمامی حقوق سایت، متعلق به شرکت بهار آرا خراسان می باشد.
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================
    ********* Page Wrapper Area End ***********
    ======================================= -->
    <!-- Must needed plugins to the run this Template -->

    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/bundle.js"></script>
    <script src="./js/user_login.js"></script>
    <!-- Active JS -->
    <script src="./js/default-assets/active.js"></script>


</body>

</html>

<?php
if (isset($_GET['peygiri'])) {
    require_once 'functions.php';

    if (isset($_GET['factor'])) {
        $factor = $_GET['factor'];
    } else {
        $factor = 'off';
    }

    if (isset($_GET['send'])) {
        $send = $_GET['send'];
    } else {
        $send = 'off';
    }

    $id = $_GET['id'];
    $peygiri = $_GET['peygiri'];
    $desc = $_GET['desc'];
    $factorNum = $_GET['factorNum'];
    $tel = $_GET['tel'];
    $esm = $_GET['esm'];
    $dest = $_GET['dest'];
    $reject = $_GET['reject'];

    if ($factor == 'on') {
        $pos = 1;
    } else {
        $pos = 0;
    }

    if ($reject == 'on') {
        $pos = 3;
    } else {
        $pos = 0;
    }

    if ($send == 'on') {
        $pos = 2;
    }

    db();
    $sql = "UPDATE `insta` SET `factor` = '" . $factor . "', `send` = '" . $send . "', `reject` = '" . $reject . "', `post` = '" . $peygiri . "', `desc` = '" . $desc . "' WHERE `id` = " . $id;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $z = $_GET['date'];

    $sq = "SELECT * FROM track WHERE factor = '" . $factorNum . "' ORDER BY id DESC";
    $resultv = mysqli_query($GLOBALS['conn'], $sq);
    $num = mysqli_num_rows($resultv);

    if ($num > 0) {
        $sqlm = "UPDATE `track` SET `trac` = '" . $peygiri . "', `pos` = '" . $pos . "' WHERE `factor` = " . $factorNum;
        $result = mysqli_query($GLOBALS['conn'], $sqlm);
    } else {
        $sqlm = "INSERT INTO track(id,factor,trac,mobile,esm,destination,pos) VALUES(NULL,
        '" . $factorNum . "', '" . $peygiri . "', '" . $tel . "', '" . $esm . "', '" . $dest . "', '" . $pos . "')";
        $result = mysqli_query($GLOBALS['conn'], $sqlm);
    }

    echo '
    <script>window.location.href="https://barjio.com/order.php?date=' . $z . '";</script>
    ';
}

?>