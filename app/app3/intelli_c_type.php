<style>
    .result_pos {
        display: none;
    }

    div#buy_pos {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin: 2rem;
    }
</style>
<fieldset class='hor' style="height: inherit;" id="cdb_form">
    <legend>ثبت گزارش ویزیت</legend>

    <div id="buy_pos">
        <button disabled class="btn btn-warning" id="old_" style="background: silver; border-color: silver; color: #fff;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
            </svg>
            مشتری قدیم</button>
        <button class="btn btn-warning" id="new_">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
            </svg>
            مشتری جدید</button>
    </div>
</fieldset>
<button class="btn btn-info" id="return" onclick="open_page('cbd')">بازگشت</button>


<script>
    $('#new_').click(function() {
        open_page('visit', 'c', 'ok', 1, true);
    });

    $('#old_').click(function() {
        open_page('visit', 'int', 'ok', 1, true);
    });
</script>