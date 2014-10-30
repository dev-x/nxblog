<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Masseges".
 *
 * @property integer $id
 * @property string $content
 * @property integer $user_id
 */
class Masseges extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Masseges';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'user_id' => 'User ID',
        ];
    }
}
