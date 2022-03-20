<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Room $model
 */

$this->title = Yii::t('models', 'Room');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create">

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(Yii::t('ui', 'Cansel'), ['index'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
