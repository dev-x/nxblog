<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	public static function tableName()
    {
        return 'users';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }

	public static function findIdentity($id)
	{
		return static::find($id);
	}

	public static function findByUsername($username)
	{
		return static::find(array('username' => $username));
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAuthKey()
	{
		return $this->auth_key;
	}

	public function validateAuthKey($authKey)
	{
		return $this->auth_key === $authKey;
	}

	public function validatePassword($password)
	{
        return \yii\helpers\BaseSecurity::validatePassword($password, $this->password_hash);
//		return $this->password === $password;
	}

    public function getUserImages()
    {
        return $this->hasMany(Image::className(), ['parent_id' => 'id'])->where("parent_type = 'user'");
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }
	public function getPcount() {
            $command = static::getDb()->createCommand("select count(*) as kilk from post where user_id = {$this->id}")->queryAll();
            return $command[0]['kilk'];
	}
}
