<?php

namespace common\helpers;

use common\models\Group;
use common\models\Subject;
use common\models\SubjectPrice;
use common\models\Teacher;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class GroupHelper
{
    public static function getLevelList(): array
    {
        return [
            Group::LEVEL_1 => 1,
            Group::LEVEL_2 => 2,
            Group::LEVEL_3 => 3,
        ];
    }

    public static function getLevelName(int $name)
    {
        return ArrayHelper::getValue(self::getLevelList(), $name);
    }

    public static function getActionList(): array
    {
        return [
            Group::ACTION_PENDING => Yii::t('models', 'Pending'),
            Group::ACTION_IN_PROCESS => Yii::t('models', 'In process'),
            Group::ACTION_FINISHED => Yii::t('models', 'Finished'),
        ];
    }

    public static function getActionLabel($action): string
    {
        switch ($action) {
            case Group::ACTION_PENDING:
                $class = 'label label-warning';
                break;
            case Group::ACTION_IN_PROCESS:
                $class = 'label label-success';
                break;
            case Group::ACTION_FINISHED:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getActionList(), $action), [
            'class' => $class,
        ]);
    }

    public static function getTypeList(): array
    {
        return [
            Group::TYPE_INDIVIDUAL => Yii::t('models', 'Individual'),
            Group::TYPE_INTENSIVE => Yii::t('models', 'Intensive'),
            Group::TYPE_TYPICAL => Yii::t('models', 'Typical'),
        ];
    }

    public static function getTypeName(int $name)
    {
        return ArrayHelper::getValue(self::getTypeList(), $name);
    }

    public static function getDurationList(): array
    {
        return [
            Group::DURATION_1 => Yii::t('models', '1 month'),
            Group::DURATION_2 => Yii::t('models', '2 month'),
            Group::DURATION_3 => Yii::t('models', '3 month'),
            Group::DURATION_4 => Yii::t('models', '4 month'),
            Group::DURATION_5 => Yii::t('models', '5 month'),
            Group::DURATION_6 => Yii::t('models', '6 month'),
            Group::DURATION_7 => Yii::t('models', '7 month'),
            Group::DURATION_8 => Yii::t('models', '8 month'),
            Group::DURATION_9 => Yii::t('models', '9 month'),
            Group::DURATION_10 => Yii::t('models', '10 month'),
            Group::DURATION_11 => Yii::t('models', '11 month'),
            Group::DURATION_12 => Yii::t('models', '12 month'),
        ];
    }

    public static function getDurationName(int $name)
    {
        return ArrayHelper::getValue(self::getDurationList(), $name);
    }

    public static function getDayList(): array
    {
        return [
            Group::DAY_MONDAY => Yii::t('models', 'Monday'),
            Group::DAY_TUESDAY => Yii::t('models', 'Tuesday'),
            Group::DAY_WEDNESDAY => Yii::t('models', 'Wednesday'),
            Group::DAY_THURSDAY => Yii::t('models', 'Thursday'),
            Group::DAY_FRIDAY => Yii::t('models', 'Friday'),
            Group::DAY_SATURDAY => Yii::t('models', 'Saturday'),
            Group::DAY_SUNDAY => Yii::t('models', 'Sunday'),
        ];
    }

    public static function getDayName($name):array
    {
        return ArrayHelper::getValue(self::getDayList(), $name);
    }

    public static function getStatusList(): array
    {
        return [
            Group::STATUS_ACTIVE => Yii::t('models', 'Active'),
            Group::STATUS_INACTIVE => Yii::t('models', 'Inactive'),
        ];
    }

    public static function getStatusLabel($status): string
    {
        switch ($status) {
            case Group::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case Group::STATUS_INACTIVE:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getStatusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function getSubjectList(): array
    {
        $subjectList = Subject::find()
            ->select('_subject.id, _subject.name, sp.price AS subject_price')
            ->leftJoin('_subject_price AS sp', 'sp.subject_id=_subject.id')
            ->where(['sp.status' => SubjectPrice::STATUS_ACTIVE])
            ->active()
            ->asArray()
            ->all();

        return ArrayHelper::map($subjectList, 'id', function ($model) {
            return $model['name'] . ' (' . nf($model['subject_price']) . ')';
        });
    }

    public static function getTeacherList(): array
    {
        $teacherList = Teacher::find()
            ->select('_teacher.id, _teacher.full_name')
            ->active()
            ->asArray()
            ->all();

        return ArrayHelper::map($teacherList, 'id', function ($model) {
            return $model['full_name'];
        });
    }
}
