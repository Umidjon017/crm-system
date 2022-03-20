<?php

namespace common\helpers;

use common\models\Client;
use common\models\ClientPhone;
use common\models\Group;
use common\models\Pupil;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ClientHelper
{
    public static function getStatusList(): array
    {
        return [
            Client::STATUS_ACTIVE => Yii::t('models', 'Active'),
            Client::STATUS_INACTIVE => Yii::t('models', 'Inactive'),
        ];
    }

    public static function getStatusName(int $name)
    {
        return ArrayHelper::getValue(self::getStatusList(), $name);
    }

    public static function getStatusLabel($status): string
    {
        switch ($status) {
            case Client::STATUS_ACTIVE:
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
            Client::GENDER_MALE => Yii::t('models', 'Male'),
            Client::GENDER_FEMALE => Yii::t('models', 'Female'),
        ];
    }

    public static function getGenderName(int $gender): string
    {
        return ArrayHelper::getValue(self::getGenderList(), $gender);
    }

    public static function getPhoneTypeList(): array
    {
        return [
            ClientPhone::MOBILE_PHONE => Yii::t('models', 'mobile'),
            ClientPhone::HOME_PHONE => Yii::t('models', 'home phone'),
        ];
    }

    public static function getPhoneTypeName(int $type): string
    {
        return ArrayHelper::getValue(self::getPhoneTypeList(), $type);
    }

    public static function getGroupList(): array
    {
        $groupList = Group::find()
            ->select( 'group.id, name, price, _teacher.full_name')
            ->leftJoin( '_teacher', 'group.teacher_id=_teacher.id')
            ->active()
            ->asArray()
            ->all();


        return ArrayHelper::map($groupList, 'id', function ($model) {
            return $model['name'] . ' (' . nf($model['price']) . ') ' . ($model['full_name']);
        });
    }
}