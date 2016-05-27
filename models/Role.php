<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_role".
 *
 * @property integer $id
 * @property string $title
 *
 * @property TblUser[] $tblUsers
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsers()
    {
        return $this->hasMany(TblUser::className(), ['role_id' => 'id']);
    }
}
