<?php
declare(strict_types=1);

namespace common\helpers;

use common\models\Pupil;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class PupilHelper
{
    public static function getStatusList(): array
    {
        return [
            Pupil::STATUS_ACTIVE => Yii::t('models', 'Active'),
            Pupil::STATUS_INACTIVE => Yii::t('models', 'Inactive'),
        ];
    }

    public static function getStatusName(int $name)
    {
        return ArrayHelper::getValue(self::getStatusList(), $name);
    }

    public static function getStatusLabel($status): string
    {
        switch ($status) {
            case Pupil::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case Pupil::STATUS_INACTIVE:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getStatusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function getGenderList(): array
    {
        return [
            Pupil::GENDER_MALE => Yii::t('models', 'Male'),
            Pupil::GENDER_FEMALE => Yii::t('models', 'Female'),
        ];
    }

    public static function getGenderName(int $gender): string
    {
        return ArrayHelper::getValue(self::getGenderList(), $gender);
    }
}
