<?php

namespace common\models;

use common\models\base\Group as BaseGroup;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "group".
 * @property \common\models\GroupDays[] $groupDays
 */
class Group extends BaseGroup
{
    const LEVEL_1 = 1;
    const LEVEL_2 = 2;
    const LEVEL_3 = 3;

    const ACTION_PENDING = 0;
    const ACTION_IN_PROCESS = 1;
    const ACTION_FINISHED = 9;

    const TYPE_INDIVIDUAL = 1;
    const TYPE_INTENSIVE = 2;
    const TYPE_TYPICAL = 3;

    const DURATION_1 = 1;
    const DURATION_2 = 2;
    const DURATION_3 = 3;
    const DURATION_4 = 4;
    const DURATION_5 = 5;
    const DURATION_6 = 6;
    const DURATION_7 = 7;
    const DURATION_8 = 8;
    const DURATION_9 = 9;
    const DURATION_10 = 10;
    const DURATION_11 = 11;
    const DURATION_12 = 12;

    const DAY_MONDAY = 1;
    const DAY_TUESDAY = 2;
    const DAY_WEDNESDAY = 3;
    const DAY_THURSDAY = 4;
    const DAY_FRIDAY = 5;
    const DAY_SATURDAY = 6;
    const DAY_SUNDAY = 7;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'teacher_id' => Yii::t('ui', 'Teacher name'),
                'subject_id' => Yii::t('ui', 'Subject name'),
            ]
        );
    }

    public function getDaysText()
    {
        $result = '';
        foreach ($this->groupDays as $groupDay) {
            switch ($groupDay->day_number)
            {
                case 1:$result.="Monday; "; break;
                case 2:$result.="Tuesday; "; break;
                case 3:$result.="Wednesday; "; break;
                case 4:$result.="Thursday; "; break;
                case 5:$result.="Friday; "; break;
                case 6:$result.="Saturday; "; break;
                case 7:$result.="Sunday; "; break;
            }
        }
        return $result;
    }

    public function addGroupDays($groupModel, $group_days)
    {
        foreach ($group_days as $day){
            $groupDayModel = new GroupDays;
            $groupDayModel->group_id = $groupModel->id;
            $groupDayModel->day_number = $day;
            $groupDayModel->save();
        }
    }

    public static function create(
        $name,
        $subject_id,
        $teacher_id,
        $level,
        $action,
        $type,
        $price,
        $period_start,
        $duration,
        $start,
        $end,
        $status
    )
    {
        $model = new Group;

        $model->name = $name;
        $model->subject_id = $subject_id;
        $model->teacher_id = $teacher_id;
        $model->level = $level;
        $model->action = $action;
        $model->type = $type;
        $model->price = $price;
        $model->period_start = $period_start;
        $model->duration = $duration;
        $model->start_hour = $start;
        $model->end_hour = $end;
        $model->status=$status;

        return $model;
    }

    public function editData(
        $name,
        $subject_id,
        $teacher_id,
        $level,
        $action,
        $type,
        $price,
        $period_start,
        $duration,
        $start,
        $end,
        $status
    )
    {
        $this->name = $name;
        $this->subject_id = $subject_id;
        $this->teacher_id = $teacher_id;
        $this->level = $level;
        $this->action = $action;
        $this->type = $type;
        $this->price = $price;
        $this->period_start = $period_start;
        $this->duration = $duration;
        $this->start_hour = $start;
        $this->end_hour = $end;
        $this->status = $status;
    }

}
