<?php

namespace common\models;

use Yii;
use \common\models\base\ClientPhone as BaseClientPhone;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "client_phone".
 */
class ClientPhone extends BaseClientPhone
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const MOBILE_PHONE = 1;
    const HOME_PHONE = 0;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $related = $this->getRelatedRecords();
            /** @var Client $client */
            if (isset($related['client']) && $client = $related['client']) {
                $client->save();
                $this->client_id = $client->id;
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
        Client $client,
               $phone
    )
    {
        $model = new ClientPhone();
        $model->populateRelation('client', $client);
        $model->phone = $phone;
        $model->type = self::MOBILE_PHONE;
        $model->status = self::STATUS_ACTIVE;
        return $model;
    }

    public static function createByClientId(
        $client_id,
        $phone,
        $type
    )
    {
        $model = new ClientPhone();
        $model->client_id = $client_id;
        $model->phone = $phone;
        $model->type = $type;
        $model->status = self::STATUS_ACTIVE;
        return $model;
    }

    public function inactivate()
    {
        $this->status = self::STATUS_INACTIVE;
    }
    #endregion
}
