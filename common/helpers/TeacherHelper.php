<?php

namespace common\helpers;

use common\models\Subject;
use common\models\Teacher;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class TeacherHelper
{
    public static function getStatusList(): array
    {
        return [
            Teacher::STATUS_ACTIVE => Yii::t('models', 'Active'),
            Teacher::STATUS_INACTIVE => Yii::t('models', 'Inactive'),
        ];
    }

    public static function getStatusName(int $name)
    {
        return ArrayHelper::getValue(self::getStatusList(), $name);
    }

    public static function getStatusLabel($status): string
    {
        switch ($status) {
            case Teacher::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case Teacher::STATUS_INACTIVE:
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
            Teacher::GENDER_MALE => Yii::t('models', 'Male'),
            Teacher::GENDER_FEMALE => Yii::t('models', 'Female'),
        ];
    }

    public static function getSubjectList(): array
    {
        $subjectList = Subject::find()
            ->select('_subject.id, _subject.name, sp.price AS subject_price')
            ->leftJoin('_subject_price AS sp', 'sp.subject_id=_subject.id')
            ->active()
            ->asArray()
            ->all();

        return ArrayHelper::map($subjectList, 'id', function ($model) {
            return $model['name'] . ' (' . nf($model['subject_price']) . ')';
        });
    }

    public static function getGenderName(int $gender): string
    {
        return ArrayHelper::getValue(self::getGenderList(), $gender);
    }
}
