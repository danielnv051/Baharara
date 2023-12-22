<?php
require_once('public_css.php');
include_once('func.php');
$xx = getInfo($_COOKIE['uid']);
?>
<style>
    option {
        direction: ltr;
        text-align: center;
    }

    #l1,
    #l2 {
        display: none;
    }

    #return_cat {
        display: inline;
    }
</style>
<div class="show_factor" style="display: none;height: 100vh; overflow: auto;"></div>
<!-- Themes -->

<link rel="stylesheet" href="css_fa/persianDatepicker-default.css" />
<!-- <link rel="stylesheet" href="css_fa/persianDatepicker-dark.css" />
<link rel="stylesheet" href="css_fa/persianDatepicker-latoja.css" />
<link rel="stylesheet" href="css_fa/persianDatepicker-melon.css" />
<link rel="stylesheet" href="css_fa/persianDatepicker-lightorang.css" /> -->

<div class="final_factor">
    <span for="tasviyex" style="width: 5rem;">نحوه تسویه را انتخاب کنید: </span>
    <div id="payment_type">
        <select id="tasviyex" class="form-control">
            <option value='*'>نحوه تسویه را انتخاب کنید</option>
            <?php
            if ($xx['line'] == '100') {
                echo '
                <optgroup label="پرفیوم آرا" class="tasv">
                    <option value="0">نقدی پای بار (15%)</option>
                    <option value="1">چک 45 روزه (15%)</option>
                    <option value="7">کتابی - نقدی پای بار (10%)</option>
                </optgroup>
                <optgroup label="تاپوتی" class="tasv">
                    <option value="20">نقدی پای بار (10%)</option>
                    <option value="12">چک 45 روزه (12%)</option>
                </optgroup>';
            } else if ($xx['line'] == '1') {
                echo '
                <optgroup label="پرفیوم آرا" class="tasv">
                    <option value="0">نقدی پای بار (15%)</option>
                    <option value="1">چک 45 روزه (15%)</option>
                    <option value="7">کتابی - نقدی پای بار (10%)</option>
                </optgroup>';
            } else if ($xx['line'] == '2') {
                echo '
                <optgroup label="تاپوتی" class="tasv">
                    <option value="20">نقدی پای بار (10%)</option>
                    <option value="12">چک 45 روزه (12%)</option>
                </optgroup>';
            }
            ?>
            <optgroup label="سایر">
                <option value="300">تعویضی</option>
                <option value="400">خرید شخصی(22%)</option>
                <option value="200">(45%)نمونه بازاریابی</option>
                <option value="100">(5%)بنکداری</option>
            </optgroup>
            <optgroup label="چک">

                <option value="3">3 ماهه</option>
                <option value="4">4 ماهه</option>
                <option value="5">5 ماهه</option>
                <option value="5.5">5/5 ماهه</option>
                <option value="6">6 ماهه</option>
            </optgroup>
        </select>
        <!-- <input type="text" class="form-control" id="tasviyex"> -->

        <?php
        $f_id = $xx['factor_id']; ?>
        <input type="hidden" value="<?php echo $f_id; ?>" id="f_id" />
    </div>
    <!--     <div id="send_date">
        <span style="width:9rem">تاریخ ارسال: </span>
        <input type="text" placeholder="YYYY-0M-0D" id="pdpF2" pdp-id="pdp-1759247" class="pdp-el form-control" data-jdate="" data-gdate="">
    </div>
    <div id="send_time">
        <span>زمان ارسال: </span>
        <label for="send_time_m" style="margin-right: 1rem;"> صبح</label>
        <input type="radio" name="send_time" id="send_time_m" value="m" class="form-control">

        <label for="send_time_e"> عصر</label>
        <input type="radio" name="send_time" id="send_time_e" value="e" class="form-control">
    </div> -->
    <div id="desc">
        <label for="desc_factor" style="color:#fff"> توضیحات:</label>
        <textarea id="desc_factor" cols="30" rows="8" class="form-control"></textarea>
    </div>

</div>


<!-- jQuery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Main Script -->
<script src="js_fa/persianDatepicker.min.js"></script>

<script>
    $('#return_cat').css('display', 'inline');
    $('#final_save').css('display', 'inline');
    $('#final_pay_btn').css('display', 'none');
    $("#pdpF2").persianDatepicker({
        cellWidth: 40,
        cellHeight: 40,
        fontSize: 16,
        startDate: "today",
        endDate: "1402/05/29",
    });

    $('.show_factor').click(function() {
        $('.show_factor').hide();
        $('.final_pay_btn').css('display', 'flex');
    });

    $(".show_factor").html("");
    $(".show_factor").load("basket.php");
    factor_id = $('#basket_id').text();

    function final_save() {
        var factor_id = $('#f_id').val();
        var tasviyex = parseInt($('#tasviyex').val());
        var desc = $('#desc_factor').val();
        if (tasviyex > 0) {
            $.ajax({
                type: "GET",
                data: {
                    factor_id: factor_id,
                    tasviye: tasviyex,
                    desc: desc
                },
                url: 'https://perfumeara.com/webapp/app1/server.php',
                success: function(result) {
                    if (result == 1) {
                        open_page('p_sign');
                        $('#uids').hide();
                        $('.final_pay_btn').hide();
                        $('.hor').css('width', '98vw');
                    }
                }
            });
        } else {
            alert('نحوه تسویه را انتخاب کنید');
        }
    }
</script>