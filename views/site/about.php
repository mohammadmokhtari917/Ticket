<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use app\models\Details;
$details=Details::findOne(1);

$this->title = 'درباره ما';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= $details->description ?>
    </p>

</div>
