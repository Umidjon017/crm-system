<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Payment $model
 */

$this->title = Yii::t('models', 'Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-create">
    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(Yii::t('ui', 'Cancel'), ['index'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>