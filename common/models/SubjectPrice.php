<?php

namespace common\models;

use Yii;
use \common\models\base\SubjectPrice as BaseSubjectPrice;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "_subject_price".
 */
class SubjectPrice extends BaseSubjectPrice
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $related = $this->getRelatedRecords();
            /** @var Subject $subject */
            if (isset($related['subject']) && $subject = $related['subject']) {
                $subject->save();
                $this->subject_id = $subject->id;
            }
            return true;
        }
        return false;
    }

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

    #region iSOLID
    public static function create(
        Subject $subject,
                $price
    )
    {
        $model = new SubjectPrice();
        $model->populateRelation('subject', $subject);
        $model->price = $price;
        $model->status = self::STATUS_ACTIVE;
        return $model;
    }

    public static function createBySubjectId(
        $subject_id,
        $price
    )
    {
        $model = new SubjectPrice();
        $model->subject_id = $subject_id;
        $model->price = $price;
        $model->status = self::STATUS_ACTIVE;
        return $model;
    }

    public function inactivate()
    {
        $this->status = self::STATUS_INACTIVE;
    }
    #endregion
}
