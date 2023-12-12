<?php
require_once('public_css.php');
require_once('func.php');
$infos = getUidInfo($_COOKIE['uid']);
$x = getRemainCash($infos['family']);

$z = '';
$sum = 0;

$y = count($x);
for ($i = 0; $i < $y; $i++) {
    $no = $x[$i]['no'];
    $cat = $x[$i]['cat'];
    $tarikh = $x[$i]['tarikh'];
    $fee = $x[$i]['fee'];
    $customer = $x[$i]['customer'];
    $pos = $x[$i]['pos'];
    $date_pos = $x[$i]['date_pos'];
    $desc_pos = $x[$i]['desc_pos'];
    $desc = $x[$i]['desc'];

    $sum += intval($fee);

    $j = $i + 1;
    $z .= '        
    <table id="ttarget" style="user-select: none;">
    <tr>
        <td rowspan="7" style="padding: 1rem;font-size: 2rem;border: 1px solid #fff;">
        ' . $j . '
        </td>
        <th>
            شماره فاکتور: ' . $no . ' <br/>
            نوع فاکتور: ' . $cat . '
        </th>
    </tr>
    <tr>
        <th colspan="2">
            تاریخ فاکتور: ' . $tarikh . '
        </th>  
    </tr>
    <tr>
        <th colspan="2">
            مشتری: ' . $customer . '
        </th>
    </tr>
    <tr>
        <th colspan="2">
            کل مانده: ' . sep3($fee) . ' ریال
        </th>
    </tr>
    <tr>
        <th colspan="2">
            آخرین مانده: ' . sep3(intval($desc_pos)) . ' ریال
        </th>
    </tr>
    <tr>
        <th colspan="2">
            تاریخ آخرین پیگیری: ' . $date_pos . '
        </th>
    </tr>
    <tr>
        <th style="color:#00eefb" colspan="2">
        توضیحات: ' . $desc . '
        </th>   
    </tr>
</table>';
}

?>
<style>
    fieldset {
        height: fit-content;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-around;
    }

    table {
        margin: 1rem auto;
        width: 90% !important;
        font-size: 0.9rem;
    }

    th {
        padding: 0.2rem;
        border: 1px solid #fff;
        color: white;
    }

    a,
    a:visited {
        color: greenyellow;
        cursor: pointer;
        text-decoration: none;
    }
</style>

<div class="items">
    <fieldset class='hor'>
        <legend>لیست همه مانده حساب ها</legend>
        <h5>جمع کل: <span><?php echo sep3($sum); ?> ریال</span></h5>
        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
        <?php echo $z; ?>
    </fieldset>
</div>

<script>
    $('li').click(function() {
        $('li').removeClass('active');
        $(this).addClass('active');
    });
</script>

<?php
$page_title = 'مانده حساب های من';
$back = 1;
require_once('slider.php'); ?>