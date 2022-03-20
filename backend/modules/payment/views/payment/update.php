<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Payment $model
 */

$this->title = Yii::t('models', 'Payment').': '. $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Payment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="payment-update">

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . Yii::t('ui', "More information"), ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . Yii::t('ui', "Full list"), ['index'], ['class' => 'btn btn-warning']) ?>
        </div>
    </div>

    <hr/>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
