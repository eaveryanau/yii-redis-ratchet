<?php
/**
 * Created by PhpStorm.
 * User: smile
 * Date: 2/22/16
 * Time: 10:51 PM
 */

namespace app\models;

use Yii;
use yii\redis\ActiveRecord;

class Classroom extends ActiveRecord
{
    /**
     * Returns the list of all attribute names of the model.
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['id', 'users', 'updateTs'];
    }

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function keyPrefix()
    {
        return 'global:classroom';
    }

//  Get classroom (bad singletone).
    public static function getInstance()
    {
        $get_instance = self::find()->where(['id' => 1])->one();
        if ($get_instance) {
            return $get_instance;
        } else {
            $instance = new Classroom();
            $instance->updateTs = time();
            $instance->save();
            return $instance;
        }
    }

//  Update timesptamp.
    public static function updateTs()
    {
        $ins = self::getInstance();
        $ins->updateTs = time();
        $ins->save();
    }

//  Get all user in classroom.
    public static function getAllUserInClassroom()
    {
        return User::find()->all();
    }

//  Time for last change classroom.
    public static function getLastChangeTime()
    {
        $ins = self::getInstance();
        return date("Y-m-d H:i:s",$ins->updateTs);
    }

}