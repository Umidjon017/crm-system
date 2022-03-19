<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\Pupil $model
*/

$this->title = Yii::t('models', 'Pupil');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Pupils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud pupil-create">

    <h1>
        <?= Yii::t('models', 'Pupil') ?>
        <small>
                        <?= Html::encode($model->id) ?>
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
