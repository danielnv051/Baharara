<?php
require_once '../func.php';
require_once 'jdf.php';
error_reporting(0)

?>
<link rel="stylesheet" href="../css/index.css" />
<style>
    @font-face {
        font-family: 'english';
        src: url(../font/EbbingPersonalUseOnly-maK9.ttf);
    }

    html {
        background-color: #fff;
    }

    .header {
        border: 1px solid silver;
        background-color: transparent;
        color: #000;
        margin: 0.5rem auto;
        width: 100%;
        border-radius: 0.4rem;
        position: relative;
    }

    .header td.border_left {
        border: 1px solid silver;
        width: 25%;
        text-align: center;
        border-left: none;
        border-top: none;
        border-bottom: none;
    }

    .header td.border_right {
        border: 1px solid silver;
        width: 25%;
        text-align: right;
        border-right: none;
        border-top: none;
        border-bottom: none;
        padding-right: 1rem;
    }

    .header img {
        width: 5rem;
        vertical-align: middle;
        filter: grayscale(1);
    }

    th {
        text-align: right;
        padding: 0rem;
        font-size: 0.8rem;
    }

    .factor_row td {
        padding: 0.2rem;
        border: 1px solid silver;
        text-align: center;
        font-size: 0.8rem;
    }

    .factor_row1 td {
        padding: 1rem;
        text-align: center;
        font-size: 0.8rem;
    }

    #map {
        border-radius: 1rem;
        box-shadow: 1px 1px 5px #8f8f8f;
        filter: brightness(1) contrast(1) grayscale(1) saturate(1) invert(1);
        width: 100%;
    }

    .english {
        font-family: Ebbing Personal Use Only;
        font-size: 1.2rem;
        font-weight: 600;
    }

    td {
        font-size: 0.9rem;
    }

    .watermark {
        color: #e1e1e138;
        font-family: b titr;
        font-size: 5rem;
        rotate: 0deg;
        position: absolute;
        margin: 8vh auto;
        z-index: 99;
        width: 100%;
        text-align: center;
    }

    .logos {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: flex-end;
    }

    .signs img {
        width: 15vw;
        filter: grayscale(1);
        height: 12vh;
    }

    .signs {
        width: 15vw;
        height: 15vh;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        gap: 0.3rem;
    }

    .free_sign {
        height: 15vh;
    }

    #seller_pic {
        outline: none;
        border: none;
        filter: brightness(1) contrast(1) grayscale(1);
        border-radius: 0.5rem;
        margin-left: 1rem;
        padding: 0.15rem;
        margin-right: 1rem;
    }

    .btn {
        cursor: pointer;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn:hover {
        box-shadow: 0 0 3px 1px #000;
    }


    .signs_btn {
        width: 10rem;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-around;
        gap: 1rem;
    }

    .supervisor_ok,
    .manager_ok,
    .admin_ok,
    .accountant_ok {
        background: #AED581;
    }

    #supervisor,
    #manager,
    #admin _img {
        display: none;
    }

    td.sign_date {
        border: none;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
    }

    @media print {
        .signs_btn {
            display: none;
        }

        .signs {
            gap: 0;
            height: 10vh;
        }

        .signs img {
            width: 8vw;
            height: 8vh;
        }

        #manager_del {
            display: none;
        }
    }

    #map_pic {
        width: 9rem;
        height: 8rem;
        border-top-left-radius: 0.6rem;
        border-bottom-right-radius: 0.6rem;
        box-shadow: 0 0 3px #161515;
    }

    #tarikh_saat h4 {
        margin-bottom: 0.4rem;
    }
</style>
<input type="hidden" id='f_id' value="<?php echo $_GET['f']; ?>" />
<?php
$timestamp = strtotime($_GET['d']);
$jalali_date = jdate("Y/m/d", $timestamp);
$f_id = $_GET['f'];
get_factor($f_id);


switch ($factor_ext[0][$f_id][0]['tasviye']) {
    case 0:
        $tasviye = 'نقدی پای بار (15%)';
        $percent = 0.15;
        break;
    case 20:
        $tasviye = 'نقدی پای بار (10%)';
        $percent = 0.10;
        break;
    case 1:
        $tasviye = 'چک 45 روزه (15%)';
        $percent = 0.15;
        break;
    case 10:
        $tasviye = 'چک 45 روزه (12%)';
        $percent = 0.12;
        break;
    case 3:
        $tasviye = 'چک 3 ماهه';
        $percent = 0;
        break;
    case 4:
        $tasviye = 'چک 4 ماهه';
        $percent = 0;
        break;
    case 5:
        $tasviye = 'چک 5 ماهه';
        $percent = 0;
        break;
    case 5.5:
        $tasviye = 'چک 5/5 ماهه';
        $percent = 0;
        break;
    case 6:
        $tasviye = 'چک 6 ماهه';
        $percent = 0;
        break;
    case 7:
        $tasviye = 'کتابی - نقدی پای بار (10%)';
        $percent = 0.1;
        break;
    case 200:
        $tasviye = 'نمونه بازاریابی';
        $percent = 0.45;
        break;
    case 100:
        $tasviye = 'بنکداری(5%)';
        $percent = 0.05;
        break;
    case 300:
        $tasviye = 'تعویضی';
        $percent = 0;
        break;
    case 400:
        $tasviye = 'خرید شخصی';
        $percent = 0;
}

$c = count($factor_ext[0][$f_id]);
$table = '';
$sum_total = 0;
$vat = 0;
$sum_pay = 0;
$num_prod = 0;
$num_offer = 0;
$num_tester = 0;

if ($c > 0) {
    for ($i = 0; $i < $c; $i++) {
        $total = $factor_ext[0][$f_id][$i]['total'];
        $pay = $factor_ext[0][$f_id][$i]['pay'];
        $tedad = $factor_ext[0][$f_id][$i]['tedad'];
        $offer = $factor_ext[0][$f_id][$i]['offer'];
        $tester = $factor_ext[0][$f_id][$i]['tester'];
        $num_prod += $tedad;
        $num_offer += $offer;
        $num_tester += $tester;

        $sum_total += (($tedad + $offer + $tester) * $total * 10);
        $vat += ((($offer + $tester) * $total) * 10);
        $sum_pay += ($tedad * $total * 10);

        $delpos = $factor_ext[0][$f_id][$i]['del_pos'];

        $tester_3w = substr($factor_ext[0][$f_id][$i]['prod_id'], -3);
        if ($tester >= 1) {
            if ($tester_3w >= 500) {
                $ttc = $factor_ext[0][$f_id][$i]['prod_id'] - 100;
                $tester_code = '<span class="tester_code">' . $ttc . '</span><br/>';
            } elseif ($tester_3w >= 200 && $tester_3w < 300) {
                $ttc = $factor_ext[0][$f_id][$i]['prod_id'] + 100;
                $tester_code = '<span class="tester_code">' . $ttc . '</span><br/>';
            }
        } else {
            $tester_code = '';
        }

        if (isset($_GET['store'])) {
            $tester_code = '';
            $dd = 'display:none;';
        } else {
            $dd = '';
        }

        $table .= '<tr>
    <td>' . ($i + 1) . '</td>
    <td>' . $factor_ext[0][$f_id][$i]['prod_id'] . '</td>
    <td style="text-align:right">' . $factor_ext[0][$f_id][$i]['parent'] . ' - ' . $factor_ext[0][$f_id][$i]['prod_name'] . '</td>
    <td>' . $tedad . '</td>
    <td>' . $offer . '</td>
    <td>' . $tester_code . $tester . '</td>
    <td style="' . $dd . '">' . sep3($total * 10) . '</td>
    <td style="' . $dd . '">' . sep3(($tedad + $offer + $tester) * $total * 10) . '</td>
    <td style="' . $dd . '">' . sep3(($offer + $tester) * $total * 10) . '</td>
    <td style="' . $dd . '">' . sep3(($tedad) * $total * 10) . '</td>
    </tr>
    ';
    }
}
$adress = 'https://perfumeara.com/webapp/app/panel/factor.php?f=' . $f_id . '&d=' . $_GET['d'];
$qr = 'https://api.qrserver.com/v1/create-qr-code/?data=' . $adress . '&size=100x100';

$factor_type = '';
$tasviyex = intval($factor_ext[0][$f_id][0]['tasviye']);
if ($tasviyex == 400 || $tasviye == 'خرید شخصی') {
    $factor_type = 'خــریـد شــخــصــی';
} else if ($tasviyex == 200 || $tasviye == 'نمونه بازاریابی') {
    $factor_type =  'نـمـونـه بـازاریـابـی';
} else if ($tasviyex == 100 || $tasviye == 'بنکداری') {
    $factor_type = 'بـنـکـداری';
} else if ($tasviyex == 300 || $tasviye == 'تعویضی') {
    $factor_type = 'تـعـویـضـی';
} else if ($tasviyex == 1) {
    $factor_type = ' ';
} else if ($tasviyex == 0 || $tasviye == 'نقدی') {
    $factor_type = 'نــقــدی';
}


$seller_pic = 'https://perfumeara.com/webapp/app1/img/users/' . $factor_ext[0][$f_id][0]['uid'] . '.jpg';
$seller_sign = $factor_ext[0][$f_id][0]['seller_sign'];
$sign = $factor_ext[0][$f_id][0]['sign'];

$login = explode(' ', $factor_ext[0][$f_id][0]['login']);
$timestamp1 = strtotime($login[0]);
$timestamp2 = ($login[1]);
$customer_signs = jdate("d F", $timestamp1);
$customer_sign_ = $timestamp2;

$logout = explode(' ', $factor_ext[0][$f_id][0]['login']);
$timestamp2 = strtotime($login[0]);
$seller_signs = jdate("d F", $timestamp2);
$seller_ = $login[1];

$accept_time = explode(',', $factor_ext[0][$f_id][0]['accept_time']);
if (isset($accept_time[0])) {
    $a1 = explode(' ', $accept_time[0]);
    $timestamp11 = strtotime($a1[0]);
    $supervisor_signs = jdate("d F", $timestamp11);
    $supervisor_ = $a1[1];
}

if (isset($accept_time[1])) {
    $a2 = explode(' ', $accept_time[1]);
    $timestamp22 = strtotime($a2[0]);
    $manager_signs = jdate("d F", $timestamp22);
    $manager_ = $a2[1];
}

if (isset($accept_time[2]) && strlen($accept_time[2]) > 0) {
    $a3 = explode(' ', $accept_time[2]);
    $timestamp33 = strtotime($a3[0]);
    $hesabdari_signs = jdate("d F", $timestamp33);
    $hesabdari_ = $a3[1];
}

if (isset($hesabdari_)) {
} else {
    $hesabdari_ = '';
    $login[1] = '';
    $logout[1] = '';
}

if (isset($seller_signs)) {
} else {
    $seller_signs = '';
    $login[1] = '';
    $logout[1] = '';
}

if (isset($customer_signs)) {
} else {
    $customer_signs = '';
}

if (isset($supervisor_signs)) {
} else {
    $supervisor_signs = '';
}

if (isset($manager_signs)) {
} else {
    $manager_signs = '';
}

if (isset($hesabdari_signs)) {
} else {
    $hesabdari_signs = '';
}

?>

<div class="watermark"><?php echo $factor_type; ?></div>
<div class="factor_detail">
    <table class="header">
        <tr>
            <th class="border_left" style="text-align: center;">
                <div class="logos">
                    <img src="../img/bgh.png" />
                </div>
            </th>
            <th class="border_left" style="padding:1rem;border-left: 1px dashed silver;text-align: center;">
                <!--                 <img id="seller_pic" src="" style="outline: none; border: none;" />
 --> <span id="seller_name"><?php echo $factor_ext[0][$f_id][0]['seller_name']; ?></span>
                <?php echo $factor_ext[0][$f_id][0]['seller_tel']; ?>
            </th>

            <th style="width:30rem;text-align: center;border-left: 1px dashed silver;">
                <h3>پیش فاکتور</h3>
                <h3 class="english">Invoice</h3>
            </th>

            <th class="border_right" style="width: 10rem; text-align: right;border-left: 1px dashed silver;direction: rtl;">
                <h5>شماره پیش فاکتور: </h5><br />
                <h2 style="background-color: #000;color:#fff;text-align:center"><?php echo $GLOBALS['pish_id']; ?></h2>
            </th>

            <th id="tarikh_saat" class="border_right" style="width: 16vw;border-left: 1px dashed silver;padding-right: 1rem;">
                <h4><?php echo $jalali_date; ?></h4>
                <h4><?php echo $factor_ext[0][$f_id][0]['zaman']; ?></h4>
                <h4>مشتری : <?php echo $factor_ext[0][$f_id][0]['shop_type']; ?></h4>
                <h4>شهر : <?php echo $factor_ext[0][$f_id][0]['city']; ?></h4>
            </th>
        </tr>
    </table>
    <table class="header " style="direction: rtl; padding: 0.5rem;">
        <tr>
            <td style="width: 25%;">نام مشتری : </td>
            <th><span id="customer_name"><?php echo $factor_ext[0][$f_id][0]['shop_manager']; ?> (<?php echo $factor_ext[0][$f_id][0]['codem']; ?>)</span></th>
            <td rowspan="4" style="text-align: left">
                <!--                 <img id="map_pic" src="https://api.neshan.org/v4/static?key=service.wEM7HjVHSAsKcAYPBfNpEaqNuQqvSpHo3tvLNrsG&type=neshan&width=200&height=200&zoom=15&center=36.2989256,59.5313372&markerToken=541121.vJwtxcHK" alt="map">
 -->
            </td>
        </tr>
        <tr>
            <td>نشانی : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['addr']; ?></th>
        </tr>
        <!-- <tr>
            <td>آدرس سیستمی : </td>
            <th><?php echo $factor_ext[0][$f_id][0]['sys_addr']; ?></th>
        </tr> -->
        <tr>
            <td>نام فروشگاه:</td>
            <th><?php echo $factor_ext[0][$f_id][0]['shop_name']; ?></th>
        </tr>
        <tr>
            <td>تلفن مشتری : </td>
            <th style="direction: ltr;"><?php echo $factor_ext[0][$f_id][0]['shop_tel']; ?></th>
        </tr>
    </table>
    <table class="header factor_row" style="direction: rtl; padding: 0.5rem;">
        <tr style="background-color:transparent">
            <td>ردیف</td>
            <td>کد کالا</td>
            <td>شرح</td>
            <td>تعداد</td>
            <td>آفر</td>
            <td>تستر</td>
            <td style="<?php echo $dd; ?>">مبلغ واحد</td>
            <td style="<?php echo $dd; ?>">مبلغ کل</td>
            <td style="<?php echo $dd; ?>">مبلغ تخفیف</td>
            <td style="<?php echo $dd; ?>">جمع کل</td>
        </tr>
        <?php echo $table; ?>
        <tr style="background-color:transparent;">
            <th colspan="3" style="text-align: center; background: #ededed;border: 1px solid silver;">
                جمع کل
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <?php echo ($num_prod); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <?php echo ($num_offer); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <?php echo ($num_tester); ?>
            </th>
            <th colspan="1" style="text-align: center; background: #ededed; border: 1px solid silver; <?php echo $dd; ?>"></th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;<?php echo $dd; ?>">
                <?php echo sep3($sum_total); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center; <?php echo $dd; ?>">
                <?php echo sep3($vat); ?>
            </th>
            <th colspan="1" style="border: 1px solid silver; font-size: 0.8rem;text-align: center; <?php echo $dd; ?>">
                <?php echo sep3($sum_pay); ?>
            </th>

        </tr>
        <tr style="<?php echo $dd; ?>">
            <th colspan="10" style="padding:0.3rem">
                مانده بدهکاری حساب قبلی : <span id="remain_debt"><?php echo sep3($factor_ext[0][$f_id][0]['bed']); ?> ریال</span>
            </th>
        </tr>
        <tr style="<?php echo $dd; ?>">
            <th colspan="10" style="padding:0.3rem">
                مانده بستانکاری حساب قبلی : <span id="remain_debt"><?php echo sep3($factor_ext[0][$f_id][0]['bes']); ?> ریال</span>
            </th>
        </tr>
        <tr style="background-color:transparent; <?php echo $dd; ?>">
            <th colspan="10" style="padding:0.3rem">
                نحوه پرداخت : <span><?php echo $tasviye; ?></span>
            </th>
        </tr>
        <tr>
            <th colspan="10" style="padding:0.3rem">
                <span id="factor_desc">توضیحات بازاریاب: <?php echo $factor_ext[0][$f_id][0]['desc']; ?></span>
            </th>
        </tr>
        <tr style="background-color:transparent;">
            <th colspan="6" style="text-align: right;padding:0.3rem">توضیحات سرپرست : <?php echo $factor_ext[0][$f_id][0]['supervisor_desc']; ?></th>
            <th colspan="2" style="text-align: left;<?php echo $dd; ?>"> جمع فاکتور</th>
            <th colspan="2" style="<?php echo $dd; ?>;border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span><?php echo sep3($sum_pay); ?> ریال</span>
            </th>
        </tr>
        <tr style="background-color:transparent;">
            <th colspan="6" style="text-align: right;padding:0.3rem">توضیحات مدیر فروش : <?php echo $factor_ext[0][$f_id][0]['manager_desc']; ?></th>
            <th colspan="2" style="text-align: left; <?php echo $dd; ?>">تخفیف تسویه</th>
            <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;<?php echo $dd; ?>">
                <span><?php echo sep3($sum_pay * $percent); ?> ریال</span>
            </th>
        </tr>
        <tr style="background-color:transparent; <?php echo $dd; ?>">
            <th colspan="8" style="text-align: left;"> قابل پرداخت</th>
            <th colspan="2" style="border: 1px solid silver; font-size: 0.8rem;text-align: center;">
                <span><?php echo sep3($sum_pay * (1 - $percent)); ?> ریال</span>
            </th>
        </tr>
    </table>

    <table class="factor_row" style="direction: rtl;margin:0 auto;">
        <tr>

            <th style="width:14rem;text-align: center;">
                <div class="signs">
                    <p>مشتری:</p>
                    <img src="<?php echo $sign; ?>">
                </div>
            </th>

            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs">
                    <p>بازاریاب:</p>
                    <img src="<?php echo $seller_sign; ?>">
                </div>
            </th>

            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs" id="supervisor">
                    <p>سرپرست فروش:</p>
                    <input type="hidden" id="cancel" value="<?php echo $delpos; ?>" />
                    <img src="" class="_img">
                    <div class="signs_btn supervisor">
                        <button class="btn supervisor_ok" id="supervisor_desc">تایید</button>
                    </div>
                </div>
            </th>

            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs" id="manager">
                    <p>مدیر فروش:</p>
                    <img src="" class="_img">
                    <div class="manager_accept">
                        <div class="signs_btn manager">
                            <button class="btn manager_ok" id="manager_desc">تایید</button>
                        </div>
                        <a class="btn btn-danger" id="manager_del" onclick="delFactor('<?php echo $_GET['f']; ?>')">حذف فاکتور</a>
                    </div>
                </div>
            </th>

            <th style="width:14rem;text-align: center;border-right: 1px dashed silver;">
                <div class="signs" id="accountant">
                    <p>حسابداری :</p>
                    <img src="" class="_img" style="display: none;width: 9rem; height: 4rem; rotate: -20deg; margin-top: 1rem;">
                    <div class="signs_btn accountant" style="display: none;">
                        <button class="btn accountant_ok">تایید</button>
                    </div>
                </div>
            </th>

        </tr>
        <tr>
            <td class="sign_date">
                <span><?php if ($seller_) {
                            echo $seller_signs;
                        } ?></span><br />
                <span><?php echo $customer_sign_; ?></span><br />
            </td>

            <td class="sign_date">
                <span><?php if ($seller_) {
                            echo $seller_signs;
                        } ?></span><br />
                <span><?php echo $seller_; ?></span>
            </td>

            <td class="sign_date">
                <span><?php if ($supervisor_) {
                            echo $supervisor_signs;
                        } ?></span><br />
                <span><?php echo $supervisor_; ?></span>
            </td>

            <td class="sign_date">
                <span><?php if ($manager_) {
                            echo $manager_signs;
                        } ?></span><br />
                <span><?php echo $manager_; ?></span>
            </td>

            <td class="sign_date">
                <span><?php if ($hesabdari_) {
                            echo $hesabdari_signs;
                        } ?></span><br />
                <span><?php echo $hesabdari_; ?></span>
            </td>
        </tr>

    </table>
</div>

<input type="hidden" id="click_name" value="" />
<input type="hidden" id="super_permission" value="<?php echo $super_permission; ?>" />
<input type="hidden" id="manager_permission" value="<?php echo $manager_permission; ?>" />

<script src="../js/jquery.min.js"></script>

<script>
    desc = $('#factor_desc').text();
    customer_name = $('#customer_name').text();
    seller_name = $('#seller_name').text();
    var chang_item = desc.indexOf('تعویض');
    if (chang_item >= 0) {
        $('.watermark').text('تـعـویـضـی');
    } else if (customer_name == seller_name) {
        $('.watermark').text('خــریـد شــخــصــی');
    }

    var chang_item = desc.indexOf('نمونه بازاریابی');
    if (chang_item >= 0) {
        $('.watermark').text('نـمـونـه بـازاریـابـی');
    }

    function set_admin_sign(code, post_title) {
        $.ajax({
            type: "GET",
            data: {
                sign: code,
            },
            url: 'https://perfumeara.com/webapp/app1/server.php',
            success: function(result) {
                $('#' + post_title + ' ._img').attr('src', result);
                $('.' + post_title).hide();

                let cnsl = $('#cancel').val();
                if (cnsl == 1) {
                    $('.manager_accept').hide();
                    $('#manager img').attr('src', 'cancel.png').show();
                }
            }
        });
    }

    var f_id = $('#f_id').val();
    $.ajax({
        type: "GET",
        data: {
            accept: f_id,
        },
        url: 'https://perfumeara.com/webapp/app1/server.php',
        success: function(result) {
            if (result == '') {
                $('#supervisor').show();
                $('#manager').show();
                $('#admin').show();

                $('#supervisor ._img').hide();
                $('#manager ._img').hide();
                $('#admin ._img').hide();

                $('.manager').hide();
                $('.manager_accept').hide();
                $('.admin').hide();

            } else {
                accpt = result.split(',');

                if (isNaN(parseInt(accpt[0]))) {
                    $('#supervisor').show();
                    $('#supervisor ._img').hide();
                } else {
                    set_admin_sign(accpt[0], 'supervisor');
                    $('#supervisor').show();
                }

                if (isNaN(parseInt(accpt[1]))) {
                    $('#manager').show();
                    $('.manager_accept').show();
                    $('#manager ._img').hide();
                    $('.admin').hide();
                } else {
                    set_admin_sign(accpt[1], 'manager');
                    $('#manager').show();
                    $('#accountant').show();
                    $('.accountant').show();
                    $('.admin').show();
                    $('.manager_accept').hide();
                }

                if (isNaN(parseInt(accpt[2]))) {
                    $('#accountant').show();
                    $('#accountant ._img').hide();
                } else {
                    set_admin_sign(accpt[2], 'accountant');
                    $('#accountant').show();
                    $('#accountant ._img').show();
                }
            }

        }
    });

    function delFactor(factor_id) {
        event.preventDefault();
        let c = confirm('آیا از حذف فاکتور مطمئن هستید؟');
        if (c == true) {
            var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
            if (!isNaN(supervisor_code)) {
                f_id = $('#f_id').val();

                $.ajax({
                    type: "GET",
                    data: {
                        emza: supervisor_code,
                        factor_id: f_id
                    },
                    url: 'https://perfumeara.com/webapp/app1/server.php',
                    success: function(result) {
                        $.ajax({
                            type: "GET",
                            data: {
                                delfactor: f_id,
                            },
                            url: 'https://perfumeara.com/webapp/app_new/server.php',
                            success: function(result) {
                                if (result > 0) {
                                    alert('فاکتور با موفقیت حذف شد');
                                    $('#manager_accept').hide();
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });
            }
        }
    }

    $('.signs button').click(function() {
        var click_name = $(this).attr('id');
        $('#click_name').val(click_name);

        var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
        if (!isNaN(supervisor_code)) {
            if (parseInt(supervisor_code) < 1) {
                var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
            } else {
                f_id = $('#f_id').val();
                $.ajax({
                    type: "GET",
                    data: {
                        emza: supervisor_code,
                        factor_id: f_id
                    },
                    url: 'https://perfumeara.com/webapp/app1/server.php',
                    success: function(result) {
                        if (result == 0) {
                            alert('کد تایید وارد شده نادرست می باشد');
                        } else if (result > 0) {

                            var sign_desc = prompt('توضیحات فاکتور را وارد کنید');
                            $.ajax({
                                type: "GET",
                                data: {
                                    tozih: sign_desc,
                                    click_names: click_name,
                                    f_id: f_id
                                },
                                url: 'https://perfumeara.com/webapp/app1/server.php',
                                success: function(result) {
                                    alert('فاکتور با موفقیت تایید شد');
                                    window.location.reload();
                                }
                            });

                        }
                    }
                });
            }
        }
    });
</script>

<style>
    .tester_code {
        width: 100%;
        background: #e0e0e0;
        color: #000;
        padding: 0.05rem;
        text-align: center;
        display: block;
        margin-bottom: -1rem;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .manager_accept {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        flex-wrap: nowrap;
        gap: 1rem;
    }
</style>