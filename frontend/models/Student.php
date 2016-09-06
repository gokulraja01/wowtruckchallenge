<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $student_name
 * @property string $father_name
 * @property string $email
 * @property string $created_at
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_name', 'father_name', 'email'], 'required'],
            ['student_name', 'unique', 'message' => 'This Studentname has already been taken.'],
	    ['student_name', 'string'],
            ['email', 'unique', 'message' => 'This Studentemail has already been taken.'],
	    ['email', 'email'],
            [['created_at'], 'safe'],
            [['student_name', 'father_name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_name' => 'Student Name',
            'father_name' => 'Father Name',
            'email' => 'Email',
            'created_at' => 'Created At',
        ];
    }
}
