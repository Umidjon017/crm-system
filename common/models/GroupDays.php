<?php

namespace common\models;

use common\models\base\GroupDays as BaseGroupDays;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "group_days".
 */
class GroupDays extends BaseGroupDays
{
    const DAY_1 = 1;
    const DAY_2 = 2;
    const DAY_3 = 3;
    const DAY_4 = 4;
    const DAY_5 = 5;
    const DAY_6 = 6;
    const DAY_7 = 7;

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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $related = $this->getRelatedRecords();
            /** @var Group $group */
            if (isset($related['group']) && $group = $related['group']) {
                $group->save();
                $this->group_id = $group->id;
            }
            return true;
        }
        return false;
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

    public static function create(
        Group $group,
              $day_number
    )
    {
        $model = new GroupDays();
        $model->populateRelation('group', $group);
        $model->day_number = $day_number;
        $model->status = self::STATUS_ACTIVE;
        return $model;
    }


}
