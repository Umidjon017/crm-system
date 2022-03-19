<?php

namespace common\models;

use Yii;
use \common\models\base\Subject as BaseSubject;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "subject".
 */
class Subject extends BaseSubject
{
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
                'viewActivePrice' => Yii::t('ui', 'Сумма')
            ]
        );
    }

    #region Checkers
    public function isCurrentPrice($price)
    {
        return $this->getActivePrice() === $price;
    }
    #endregion

    #region Getter
    public function getActivePrice()
    {
        return $this->getSubjectPrices()
            ->select('price')
            ->active()
            ->scalar();
    }
    #endregion

    #region Viewer
    public function getViewActivePrice()
    {
        return nf($this->getActivePrice());
    }
    #endregion

    #region iSOLID
    public static function create($name, $status)
    {
        $model = new Subject;
        $model->name = $name;
        $model->status = $status;

        return $model;
    }

    public function editData($name, $status)
    {
        $this->name = $name;
        $this->status = $status;
    }
    #endregion
}
