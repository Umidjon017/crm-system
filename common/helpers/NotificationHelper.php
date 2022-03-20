<?php

namespace common\helpers;

use common\models\Notification;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class NotificationHelper
{
    public static function getGroupList(): array
    {
        return [
            Notification::GROUP_ALL => Yii::t('models', 'All'),
            Notification::GROUP_TEACHER => Yii::t('models', 'Teachers'),
            Notification::GROUP_PUPIL => Yii::t('models', 'Pupil'),
        ];
    }

    public static function getGroupName(int $name)
    {
        return ArrayHelper::getValue(self::getGroupList(), $name);
    }

    public static function getStatusList(): array
    {
        return [
            Notification::STATUS_ACTIVE => Yii::t('models', 'Active'),
            Notification::STATUS_INACTIVE => Yii::t('models', 'Inactive'),
        ];
    }

    public static function getStatusName(int $name)
    {
        return ArrayHelper::getValue(self::getStatusList(), $name);
    }

    public static function getStatusLabel($status): string
    {
        switch ($status) {
            case Notification::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case Notification::STATUS_INACTIVE:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getStatusList(), $status), [
            'class' => $class,
        ]);
    }
}
