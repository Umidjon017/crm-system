<?php
namespace common\helpers;

use common\models\Payment;
use kartik\helpers\Html;
use Yii;
use yii\helpers\ArrayHelper;

class PaymentHelper
{
    public static function getStatusList(): array
    {
        return [
            Payment::STATUS_ACTIVE => Yii::t('models', 'Active'),
            Payment::STATUS_INACTIVE => Yii::t('models', 'Inactive'),
        ];
    }

    public static function getStatusName(int $name)
    {
        return ArrayHelper::getValue(self::getStatusList(), $name);
    }

    public static function getStatusLabel($status): string
    {
        switch ($status) {
            case Payment::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case Payment::STATUS_INACTIVE:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getStatusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function getTypeLabel($name): string
    {
        switch ($name) {
            case Payment::TYPE_INCOME:
                $class = 'label label-success';
                break;
            case Payment::TYPE_OUTCOME:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getTypeList(), $name), [
            'class' => $class,
        ]);
    }

    public static function getTypeList(): array
    {
        return [
            Payment::TYPE_INCOME => Yii::t('models', 'Income'),
            Payment::TYPE_OUTCOME => Yii::t('models', 'Outcome'),
        ];
    }

    public static function getTypeName(int $type): string
    {
        return ArrayHelper::getValue(self::getTypeList(), $type);
    }
}
