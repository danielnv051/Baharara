<style>
    @font-face {
        font-family: 'iransans';
        src: url('fonts/IRANSansWeb(FaNum).ttf');
    }

    h1 {
        margin: 20% auto;
        width: 80%;
        font-size: 2rem;
        text-align: center;
        padding: 1rem;
        background: #000;
        color: #fff;
        border-radius: 1rem;
        box-shadow: 1px 1px 9px 0px #2f2f2f;
        font-family: 'iransans';
    }
</style>
<?php

require_once '../func.php';
require_once 'jdf.php';
error_reporting(0);
$data_user = [];

$num_1 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-1-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002H7.971L6.072 5.385v1.271l1.834-1.318h.065V12h1.312V4.002Z"/></svg>';
$num_2 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-2-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24c0-.691.493-1.306 1.336-1.306.756 0 1.313.492 1.313 1.236 0 .697-.469 1.23-.902 1.705l-2.971 3.293V12h5.344v-1.107H7.268v-.077l1.974-2.22.096-.107c.688-.763 1.287-1.428 1.287-2.43 0-1.266-1.031-2.215-2.613-2.215-1.758 0-2.637 1.19-2.637 2.402v.065h1.271v-.07Z"/></svg>';
$num_3 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-3-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-8.082.414c.92 0 1.535.54 1.541 1.318.012.791-.615 1.36-1.588 1.354-.861-.006-1.482-.469-1.54-1.066H5.104c.047 1.177 1.05 2.144 2.754 2.144 1.653 0 2.954-.937 2.93-2.396-.023-1.278-1.031-1.846-1.734-1.916v-.07c.597-.1 1.505-.739 1.482-1.876-.03-1.177-1.043-2.074-2.637-2.062-1.675.006-2.59.984-2.625 2.12h1.248c.036-.556.557-1.054 1.348-1.054.785 0 1.348.486 1.348 1.195.006.715-.563 1.237-1.342 1.237h-.838v1.072h.879Z"/></svg>';
$num_4 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-4-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM7.519 5.057c-.886 1.418-1.772 2.838-2.542 4.265v1.12H8.85V12h1.26v-1.559h1.007V9.334H10.11V4.002H8.176c-.218.352-.438.703-.657 1.055ZM6.225 9.281v.053H8.85V5.063h-.065c-.867 1.33-1.787 2.806-2.56 4.218Z"/></svg>';
$num_5 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-5-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-8.006 4.158c1.74 0 2.924-1.119 2.924-2.806 0-1.641-1.178-2.584-2.56-2.584-.897 0-1.442.421-1.612.68h-.064l.193-2.344h3.621V4.002H5.791L5.445 8.63h1.149c.193-.358.668-.809 1.435-.809.85 0 1.582.604 1.582 1.57 0 1.085-.779 1.682-1.57 1.682-.697 0-1.389-.31-1.53-1.031H5.276c.065 1.213 1.149 2.115 2.72 2.115Z"/></svg>';
$num_6 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-6-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.21 3.855c-1.868 0-3.116 1.395-3.116 4.407 0 1.183.228 2.039.597 2.642.569.926 1.477 1.254 2.409 1.254 1.629 0 2.847-1.013 2.847-2.783 0-1.676-1.254-2.555-2.508-2.555-1.125 0-1.752.61-1.98 1.155h-.082c-.012-1.946.727-3.036 1.805-3.036.802 0 1.213.457 1.312.815h1.29c-.06-.908-.962-1.899-2.573-1.899Zm-.099 4.008c-.92 0-1.564.65-1.564 1.576 0 1.032.703 1.635 1.558 1.635.868 0 1.553-.533 1.553-1.629 0-1.06-.744-1.582-1.547-1.582Z"/></svg>';
$num_7 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-7-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM5.37 5.11h3.972v.07L6.025 12H7.42l3.258-6.85V4.002H5.369v1.107Z"/></svg>';
$num_8 = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-8-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-5.03 1.803c0-1.248-.943-1.84-1.646-1.992v-.065c.598-.187 1.336-.72 1.336-1.781 0-1.225-1.084-2.121-2.654-2.121-1.57 0-2.66.896-2.66 2.12 0 1.044.709 1.589 1.33 1.782v.065c-.697.152-1.647.732-1.647 2.003 0 1.39 1.19 2.344 2.953 2.344 1.77 0 2.989-.96 2.989-2.355Zm-4.347-3.71c0 .739.586 1.255 1.383 1.255s1.377-.516 1.377-1.254c0-.733-.58-1.23-1.377-1.23s-1.383.497-1.383 1.23Zm-.281 3.645c0 .838.72 1.412 1.664 1.412.943 0 1.658-.574 1.658-1.412 0-.843-.715-1.424-1.658-1.424-.944 0-1.664.58-1.664 1.424Z"/></svg>';

switch ($_GET['g']) {
    case '5cd7e7e835a2e78c9d0bec2a62cc0a87':
        $head = 'احمدی';
        $GLOBALS['line'] = 2;
        break;
    case '91b3c2641e0f1cabef06ca395113c99c':
        $head = 'معمار';
        $GLOBALS['line'] = 5;
        break;
    case '45c48cce2e2d7fbdea1afc51c7c6ad26':
        $head = 'جاهدی';
        $GLOBALS['admin'] = '99';
        $GLOBALS['line'] = '*';
        break;
    case '45c48cce2e2d7fbdea1afc51c7c6ad2':
        $head = 'اکبری';
        $GLOBALS['admin'] = '99';
        $GLOBALS['line'] = '*';
        break;
    case 'cfcd208495d565ef66e7dff9f98764d':
        $head = 'نواری';
        $GLOBALS['admin'] = '99';
        $GLOBALS['line'] = '*';
        break;
    case 'c4ca4238a0b923820dcc509a6f75849b':
        $head = 'مشهدی';
        $GLOBALS['line'] = 1;
        break;
    case 'b8e0f272c78fbcb1944a56f5e37158a2':
        $head = 'اسدی';
        $GLOBALS['line'] = '*';
        break;
    case 's.m':
        $head = 'محمد نیا';
        $GLOBALS['line'] = '*';
        break;
}


$conn = '';
$mission = [];
$city_list = '';

$no = '<svg id="neg_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path> </svg>';

$ok = '<svg id="plus_svg" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path> </svg>';

function masir($id)
{
    $sql = "SELECT * FROM masir WHERE `id` = $id";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $r = mysqli_fetch_assoc($result);
    return $r['city'];
}

function mission($date)
{
    db();
    $sql = "SELECT * FROM mission WHERE `date` LIKE '%" . $date . "%' ORDER BY id ASC";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        for ($i = 0; $i < $num; $i++) {
            $r = mysqli_fetch_assoc($result);
            $GLOBALS['mission'][$i] = [
                'id' => $r['id'],
                'uid' => $r['uid'],
                'mission_name' => $r['mission_name'],
                'date' => $r['date'],
                's_fa' => $r['start_fa'],
                'e_fa' => $r['end_fa'],
                'route' => $r['route'],
                'vehicle_name' => $r['vehicle_name'],
                'vehicle_num' => $r['vehicle_num'],
                'home' => $r['home'],
                'food' => $r['food'],
                'travel' => $r['travel'],
                'sign' => $r['sign'],
                'accept_time' => $r['accept_time'],
            ];
        }
    }
}

function users($uid)
{
    db();
    $sql = "SELECT * FROM customers WHERE `uid`=" . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $r = mysqli_fetch_assoc($result);
    return $r['family'] . ',' . $r['mtel'] . ',' . $r['sign'] . ',' . $r['semat'] . ',' . $r['line'];
}

?>

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
    <title>سامانه مشاهده فرم های اداری</title>

    <!-- Favicon -->

    <link rel="stylesheet" href="./css/style.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/public.js"></script>
    <style>
        .btn-hesabdari {
            background: #E91E63;
            color: #fff;
        }

        .btn-hesabdari:hover {
            color: #fff;
            background-color: #880E4F;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #01579B;
            border-color: #007bff;
        }

        body {
            direction: rtl;
            color: #58595a;
            font-family: 'IranSans';
        }

        audio {
            width: 100%;
        }

        table {
            text-align: center;
            margin: 1rem auto;

        }

        tr {
            border: 1px solid silver;
        }

        td {
            padding: 1rem;
            border: 1px solid silver;
        }

        #first_row {
            font-weight: bold;
        }

        td {
            border: 1px solid silver;
            padding: 0.5rem;
            font-family: iransans;
            font-size: 11pt;
        }

        button {
            margin: 1rem auto;
            margin-right: 1rem;
            border: none;
        }

        form {
            margin: 0 auto;
        }

        .card-body {
            text-align: center;
        }

        .zaman {
            text-align: center;
            margin-top: 1rem;
            border-bottom: 1px solid silver;
            padding: 0.2rem;
            position: relative;
        }

        h3 {
            margin-left: 1rem;
        }

        h5 {
            font-size: 0.8rem;
            margin-top: 0.8rem;
            color: #fff;
            background: #000;
            padding: 0.5rem;
            margin-bottom: 4rem;
        }

        .font-24 {
            display: inline;
            font-size: 14pt !important;
        }

        img {
            max-width: 160px;
        }

        .qr img,
        .logo img {
            width: inherit;
        }

        #route {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: flex-start;
            align-items: center;
        }

        #route .loc {
            display: none;
        }

        .qr {
            width: 90px;
            position: absolute;
            top: -46px;
            left: 50px;
        }

        .logo {
            width: 120px;
            position: absolute;
            top: -46px;
            right: 50px;
        }

        .factor th {
            border: 1px solid silver;
        }

        .sep {
            padding: 0.2rem;
        }

        svg#plus_svg {
            color: green;
        }


        svg#neg_svg {
            color: orangered;
        }
    </style>
    <link rel="stylesheet" media="print" href="print.css" />

</head>

<body class="login-area">
    <input type="hidden" value="<?php echo $GLOBALS['line']; ?>" id="users_lines" />
    <!-- Preloader -->
    <!-- ======================================
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
                                <h3 class="font-24 mb-1">لیست فرم های اداری پرسنل
                                </h3>
                                <h5>کاربر سامانه : <?php echo $head; ?> </h5>
                                <div class="doc">
                                    <table>
                                        <tr>
                                            <td><button id="all" class="btn btn-success">همه فرم ها</button></td>
                                            <td><button id="super" class="btn btn-warning" onclick="show_super('<?php echo $GLOBALS['line']; ?>')">عدم تایید سرپرست</button></td>
                                            <td><button id="manager" class="btn btn-primary">عدم تایید مدیر فروش</button></td>
                                            <td><button id="both" class="btn btn-danger">عدم تایید مدیریت</button></td>
                                            <td><button id="acc" class="btn btn-hesabdari" onclick="show_acc()">عدم تایید حسابداری</button></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="zaman">
                                    <p class="mb-30"></p>

                                    <table style="margin: 0 auto;">
                                        <tr style="background: #4DB6AC; color: #353535;font-weight:bold">
                                            <td colspan="10">فرم ماموریت</td>
                                        </tr>
                                        <tr id="first_row">
                                            <td>ردیف</td>
                                            <td>بازاریاب</td>
                                            <td>عنوان فرم</td>
                                            <td>تاریخ</td>
                                            <td>شماره سند</td>
                                            <td>مبلغ(ریال)</td>
                                            <td>تایید سرپرست</td>
                                            <td>تایید مدیر</td>
                                            <td>تایید مدیریت</td>
                                            <td>تایید حسابداری</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            mission($_GET['date']);
                                            $c_m = count($mission);
                                            for ($i = 0; $i < $c_m; $i++) {
                                                $sign = explode(',', $mission[$i]['sign']);
                                                if (count($sign) - 1 > 0) {
                                                    if ($sign[0] > 0) {
                                                        $super_ = $ok;
                                                        $super = 'super_ok';
                                                    } else {
                                                        $super_ = $no;
                                                        $super = 'super_no';
                                                    }

                                                    if (isset($sign[1]) && $sign[1] > 0) {
                                                        $manager_ = $ok;
                                                        $manager = 'manager_ok';
                                                    } else {
                                                        $manager_ = $no;
                                                        $manager = 'manager_no';
                                                    }

                                                    if (isset($sign[2]) && $sign[2] > 0) {
                                                        $both_ = $ok;
                                                        $both = 'both_ok';
                                                    } else {
                                                        $both_ = $no;
                                                        $both = 'both_no';
                                                    }

                                                    if (isset($sign[3]) && $sign[3] > 0) {
                                                        $acc_ = $ok;
                                                        $acc = 'acc_ok';
                                                    } else {
                                                        $acc_ = $no;
                                                        $acc = 'acc_no';
                                                    }
                                                } else {
                                                    $super = 'super_no';
                                                    $manager = 'manager_no';
                                                    $both = 'both_no';
                                                    $acc = 'both_no';
                                                    $super_ = $no;
                                                    $manager_ = $no;
                                                    $both_ = $no;
                                                    $acc_ = $no;
                                                }


                                                $rtr = explode(',', $mission[$i]['route']);
                                                $rt = count($rtr) - 1;
                                                for ($k = 0; $k < $rt; $k++) {
                                                    if ($k == $rt - 1) {
                                                        $city_list .= masir($rtr[$k]);
                                                    } else {
                                                        $city_list .= masir($rtr[$k]) . ' > ';
                                                    }
                                                }

                                                $sum_this_mission = $mission[$i]['home'] + $mission[$i]['food'] + $mission[$i]['travel'];

                                                $j = $i + 1;
                                                $timestamp = strtotime($_GET['date']);
                                                $jalali_date = jdate("Y/m/d", $timestamp);
                                                $m_id = $mission[$i]['id'];

                                                if ($mission[$i]['mission_name'] == '') {
                                                    $mission_name = '-';
                                                } else {
                                                    $mission_name = $mission[$i]['mission_name'];
                                                }

                                                $user_datas = users($mission[$i]['uid']);
                                                $ud = explode(',', $user_datas);
                                                $user_line = $ud[5];

                                                echo "
                                            <tr class='mission l" . $user_line . " " . $super . " " . $manager . " " . $both . " " . $acc . "'>
                                                <td>" . $j . "</td>
                                                <td>" . $ud[0] . "</td>
                                                <td>" . $mission_name . "</td>
                                                <td>" . $jalali_date . "</td>
                                                <td><a target='_blank' href='formDetail1.php?id=" . $m_id . "&type=mission'>" . $mission[$i]['id'] . "</a></td>
                                                <td>" . sep3($sum_this_mission) . "</td>
                                                <td>" . $super_ . "</td>
                                                <td>" . $manager_ . "</td>
                                                <td>" . $both_ . "</td>
                                                <td>" . $acc_ . "</td>
                                            </tr>
                                            <tr class='mission l" . $user_line . " " . $super . " " . $manager . " " . $acc . " " . $both . "'>
                                                <td colspan='10' class='desc' style='background: #EEEEEE;'>مسیر: " . $city_list . " | رفت: " . $mission[$i]['s_fa'] . " - برگشت: " . $mission[$i]['e_fa'] . " | خودرو: " . $mission[$i]['vehicle_name'] . "</td>
                                            </tr>
                                            ";
                                                $city_list = '';
                                                $sum_this_mission = 0;
                                            }
                                            ?>
                                        </tr>
                                    </table>

                                    <table style="text-align: center;display:none;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">

                                    </table>

                                </div>
                                <div class=" row" style="width: max-content; margin: 0 auto;">
                                    <form method="get" action="forms.php" class="print">
                                        <label>تاریخ مورد نظر را وارد کنید: <input type="date" name="date" id="day" class="form-control"> </label>
                                        <input type="hidden" name="g" value="<?php echo $_GET['g']; ?>" />
                                        <button type="submit" class="btn btn-warning">نمایش</button>
                                        <button>
                                            <a href="javascript:if(window.print)window.print()" class="btn btn-primary">چاپ</a>
                                        </button>
                                    </form>
                                </div>
                                <input type="hidden" id="uid" value="<?php echo $_GET['uid']; ?> name=" uid" />
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

        <input type="hidden" id="tarikh" value="<?php echo $_GET['date']; ?>">
        <input type="hidden" id="g" value="<?php echo $_GET['g']; ?>">

        <!-- ======================================
    ======================================= -->
        <!-- Must needed plugins to the run this Template -->


        <script>
            let g = $('#g').val();
            let tarikh = $('#tarikh').val();
            let masir = 'https://perfumeara.com/webapp/app_new/panel/forms.php?date=' + tarikh + '&g=' + g;
            let pos = '';

            $('#all').click(function() {
                pos = '&t=all';
                window.location.assign(masir + pos);
            });

            $('#manager').click(function() {
                pos = '&t=manager';
                $('tr.super_ok').show();
                $('tr.super_no').hide();
                $('tr.manager_ok').hide();
                //window.location.assign(masir + pos);
            });

            $('#both').click(function() {
                pos = '&t=both';
                $('tr.manager_ok').show();
                $('tr.manager_no').hide();
                $('tr.both_ok').hide();
                //window.location.assign(masir + pos);
            });

            $('#acc').click(function() {
                pos = '&t=acc';
                //window.location.assign(masir + pos);
            });

            function show_factor(x) {
                $("tr[class*='l']").hide();

                if (x == '*') {
                    let line = '';
                    $('tr').show();
                } else {
                    let line = x;
                    $('tr.l' + x).show();
                }
                pos = '&t=factor';

                $('tr.nofactor').hide();
                $('tr.d1').hide();
                //window.location.assign(masir + pos);
            }

            function show_acc() {
                $('tr').show();
                $("tr.acc_no").show();
                $('tr.nofactor').hide();
                $('tr.acc_ok').hide();
                $('tr.both_no').hide();
                $('tr.d1').hide();
            }

            function show_super(x) {
                show_factor('<?php echo $GLOBALS['line']; ?>');
                $('tr.nofactor').hide();
                $('tr.super_ok').hide();
                $('tr.d1').hide();
            }
        </script>

        <input type="hidden" id="parent_" value="<?php echo $GLOBALS['line']; ?>" />
        <script>
            $(document).ready(function() {
                let parent = $('#parent_').val();
                if (parent == '*') {
                    $('.data').show();
                } else {
                    $('.data').hide();
                    $('.l' + parent).show();
                }

                $('tr.d1').hide();

                let al_cbd = $('*').find('.data').length / 2;
                let al_fac = $('*').find('.factor').length / 2;
                let al_insta = $('*').find('.l5').length / 2;
                let no_super = $('*').find('.super_no').length / 2;
                let no_manager = $('*').find('.manager_no').length / 2;
                let no_acc = $('*').find('.acc_no').length / 2;


            });

            var users_lines = $('#users_lines').val();
            if (users_lines == '*') {
                $('tr').show();
            } else {
                $('tr.mission').hide();
                $('tr.l' + users_lines).show();
            }
        </script>

        <style>
            .desc {
                text-align: right;
                font-weight: bold;
                color: #00695C;
                font-size: 0.8rem;
            }

            .doc {
                position: relative;
            }

            .doc table {
                position: absolute;
                top: -5rem;
                right: -1.4rem;
                border: none;
            }

            .doc table td:nth-child(1) {
                width: 8.5rem;
            }

            .doc table td:nth-child(2) {
                width: 10rem;
            }

            .doc table td:nth-child(3) {
                width: 10.4rem;
            }

            .doc table td:nth-child(4) {
                width: 11.3rem;
            }

            .doc table td:nth-child(5) {
                width: 10.2rem;
            }

            .doc table td:nth-child(6) {
                width: 10.8rem;
            }

            .doc td,
            .doc tr,
            .doc table {
                border: none;
            }

            .doc button {
                width: 140px;
                height: 60px;
            }
        </style>

        <?php
        if ($_GET['g'] == 'b8e0f272c78fbcb1944a56f5e37158a2') {
            echo '<script>
            $(document).ready(function() {
                $("*").find(".l100").hide();
            });</script>';
        }

        ?>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bundle.js"></script>
        <script src="../js/user_login.js"></script>
        <!-- Active JS -->
        <script src="./js/default-assets/active.js"></script>
</body>

</html>