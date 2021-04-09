<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "public.cruge_user".
 *
 * @property int $iduser
 * @property int|null $regdate
 * @property int|null $actdate
 * @property int|null $logondate
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property string|null $authkey
 * @property int|null $state
 * @property int|null $totalsessioncounter
 * @property int|null $currentsessioncounter
 */
class CrugeUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.cruge_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regdate', 'actdate', 'logondate', 'state', 'totalsessioncounter', 'currentsessioncounter'], 'default', 'value' => null],
            [['regdate', 'actdate', 'logondate', 'state', 'totalsessioncounter', 'currentsessioncounter'], 'integer'],
            [['username', 'password'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 45],
            [['authkey'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iduser' => 'Iduser',
            'regdate' => 'Regdate',
            'actdate' => 'Actdate',
            'logondate' => 'Logondate',
            'username' => 'Usuario',
            'email' => 'Correo',
            'password' => 'Password',
            'authkey' => 'Authkey',
            'state' => 'Estado de la cuenta',
            'totalsessioncounter' => 'Totalsessioncounter',
            'currentsessioncounter' => 'Currentsessioncounter',
        ];
    }
}
