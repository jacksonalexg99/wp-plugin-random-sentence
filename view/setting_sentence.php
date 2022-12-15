<div class="container mt-2 is">
    <h3>تنظیمات استایل دهی</h3>
    <form id="rs_form_setting" action="" class="mt-3">
        <div class="mb-3 col-3 col-lg-1 ">
            <label for="rs_fontsize" class="form-label">سایز جمله</label>
            <input type="number" class="form-control" value="<?php echo get_option( '_rs_fontsize', true ); ?>"
                   id="rs_fontsize">
        </div>
        <div class="mb-3  col-3 col-lg-1">
            <label for="rs_color" class="form-label">رنگ متن</label>
            <br>
            <input value="<?php echo get_option( '_rs_textcolor', true ); ?>" id="rs_color" data-jscolor="{}">
        </div>
        <div class="mb-3   col-3 col-lg-6">
	        <?php  $check = get_option( '_rs_transparent' ); ?>
            <label for="rs_bgcolor" class="form-label">رنگ پس زمینه</label>
            <br>
            <input class="ms-4" value="<?php echo get_option( '_rs_bgcolor', true ); ?>" id="rs_bgcolor"
                   data-jscolor="{}">


            <input type="checkbox" class="form-check-input" <?php echo $check==1 ? "checked" : '' ?>
                   id="check_transparent"  >


            <label class="form-check-label" for="check_transparent">شفاف</label>

            <br>
            <label class="rs_help mt-3">در صورت فعال بودن شفاف، رنگ پس زمینه غیر فعال خواهد شد</label>
        </div>
        <div class="mb-3  col-3 col-lg-1">

        </div>
        <input type="submit" class="btn btn-success w-25 mt-4" value="ذخیره">
    </form>
</div>