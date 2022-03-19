<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\Notification $model
*/

$this->title = Yii::t('models', 'Notification');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Notifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud notification-create">

    <h1>
        <?= Yii::t('models', 'Notification') ?>
        <small>
                        <?= Html::encode($model->title) ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=             Html::a(
            'Cancel',
            \yii\helpers\Url::previous(),
            ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
