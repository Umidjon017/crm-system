<?php

use common\helpers\TeacherHelper;
use common\models\Teacher;
use dmstr\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Teacher $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Teacher') . ': ' . $model->full_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Teachers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="teacher-view">

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

    <?php $this->beginBlock('common\models\Teacher'); ?>

    <?= DetailView::widget([
        'template' => "<tr><th style='width: 20%'>{label}</th><td>{value}</td></tr>",
        'model' => $model,
        'attributes' => [
            'full_name',
            [
                'attribute' => 'gender',
                'value' => function (Teacher $model) {
                    return TeacherHelper::getGenderName($model->gender);
                },
            ],
            [
                'attribute' => 'subjectList',
                'value' => function (Teacher $model) {
                    return $model->getSubjectsText();
                },
            ],
            'birth_date',
            'phone',
            [
                'attribute' => 'photo',
                'value' => $model->getPhotoSrc(),
                'format' => ['image', ['width' => 100, 'height' => 100]]
            ],
            'address',
            [
                'attribute' => 'status',
                'value' => function (Teacher $model) {
                    return TeacherHelper::getStatusLabel($model->status);
                },
                'format' => 'raw'
            ],

        ],
    ]); ?>

    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('ui', "Delete"), ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data-confirm' => 'Are you sure that you want to delete this data?',
            'data-method' => 'post',
        ]);
    ?>

    <?php $this->endBlock(); ?>

    <?= Tabs::widget(
        [
            'id' => 'relation-tabs',
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => '<b> <i class="fa fa-info-circle"></i> ' . Yii::t('ui', "More information") . '</b>',
                    'content' => $this->blocks['common\models\Teacher'],
                    'active' => true,
                ],
            ]
        ]
    ); ?>
</div>
