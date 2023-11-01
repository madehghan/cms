
<?php if(isset($my_profile_id)){ header('location:home.php');}?>
<div class="container">
<style>
.login_form_bg{
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    background: #fff;
    padding:15px;
    margin: 10px;
    margin-top:30vh;
    border-radius: 8px;
}
</style>

<div class="login_form_bg">
<?php include 'modules/login2.php' ?>
<form action="" method="POST">
<label class="p-3">کد دریافت شده را وارد نمایید!</label>
<input type="number" name="password" class="form-control mt-2" placeholder="کد دریافت شده">
<button type="submit" class="btn btn-primary mt-2 w-100 btn-sm" name="login_submit">ورود به نرم افزار</button>
</form>
</div>

<div class="fixed-bottom text-center p-3">
<a href="tel:<?php echo $setting_support_number ?>">تماس با پشتیبانی</a>
</div>
</div>
