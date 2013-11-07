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
}
