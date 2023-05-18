<?php

/** @var yii\web\View $this */
use app\models\Details;
$details=Details::findOne(1);
$this->title = $details->name;
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="">پنل ادمین</h1>

        <p class="lead">سایت خود را شخصی سازی  کنید</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
        </div>

    </div>
</div>
