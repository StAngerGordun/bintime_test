<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public function getAddresses()
    {
        return $this->hasMany(Addresses::className(), ['user_id' => 'id']);
    }
    
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' =>'gender_id']);
    }
}
