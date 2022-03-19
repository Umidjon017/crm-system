<?php

use dmstr\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;


/**
 * @var yii\web\View $this
 * @var common\models\Subject $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Subject'). ': ' .$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="subject-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('ui', 'Edit'),
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-info']) ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('ui', "Add"),
                ['create'],
                ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . Yii::t('ui', "Full list"), ['index'], ['class' => 'btn btn-warning']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('common\models\Subject'); ?>


    <?= DetailView::widget([
        'model' => $model,
        'template' => "<tr><th style='width: 20%'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'name',
            'viewActivePrice'
        ],
    ]); ?>


    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 'Удалить', ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data-confirm' => '' . 'Are you sure that you want to delete this data?' . '',
            'data-method' => 'post',
        ]); ?>
    <?php $this->endBlock(); ?>



    <?= Tabs::widget(
        [
            'id' => 'relation-tabs',
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => '<b> <i class="fa fa-info-circle"></i> ' . Yii::t('ui', "More information") . '</b>',
                    'content' => $this->blocks['common\models\Subject'],
                    'active' => true,
                ],
            ]
        ]
    );
    ?>
</div>
