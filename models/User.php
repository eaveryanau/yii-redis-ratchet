<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class User extends \yii\redis\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * Returns the list of all attribute names of the model.
     * @return array list of attribute names.
     */
    function attributes()
    {
        return ['id', 'name', 'handState'];
    }

//  These methods are not necessary for me.
    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    // Login method.
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this);
        }
        return false;
    }


//  This method is called at the end of inserting or updating a record.
    public function afterSave()
    {
        Classroom::updateTs();
    }

//  Raise hand up/down method.
    public static function changeState(){
        $user = self::findIdentity(Yii::$app->user->id);
        $user->handState = ($user->handState == 0) ? 1: 0;
        $user->save();
    }

}
