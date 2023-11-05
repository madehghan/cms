
<style>
.logo_welcome{
    margin-top:20vh;
}
.title_welcome{
    font-family: YekanBakhBold;
    font-size: 30px;
    margin-top:20px;
}

.desc_welcome{
    font-family: YekanBakhRegular;
    font-size: 20px;
    margin-top:10px;
}

.title_pages{
    font-family: YekanBakhBold;
    border-bottom: 1px solid #d7d7d7;
    padding-bottom: 10px;
    color: #000054;
}
</style>
<div class="container">
    <div class="logo_welcome text-center">
        <img src="<?php echo $setting_site_logo ?>" class="w-50">
        <div class="title_welcome"><?php echo $setting_site_name ?></div>
        <div class="desc_welcome"><?php echo $setting_site_description ?></div>
    </div>
</div>

<div class="fixed-bottom text-center p-3">
    در حال بارگذاری اطلاعات...
</div>


<script type="text/javascript">
        setTimeout(function () {
            window.location.href = 'login.php'; // Replace with the URL you want to redirect to
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>

