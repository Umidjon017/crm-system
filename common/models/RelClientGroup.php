<?php

namespace common\models;

use Yii;
use \common\models\base\RelClientGroup as BaseRelClientGroup;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rel_client_group".
 */
class RelClientGroup extends BaseRelClientGroup
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

    #region iSOLID
    public static function createByClient($client_id, $group_id)
    {
        $newModel = new RelClientGroup();

        $newModel->client_id = $client_id;
        $newModel->group_id = $group_id;
        $newModel->status = RelClientGroup::STATUS_ACTIVE;

        return $newModel;
    }
    #endregion
}
