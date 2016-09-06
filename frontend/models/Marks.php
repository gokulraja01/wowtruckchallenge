<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marks".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $mark
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Student $student
 */
class Marks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id'], 'required', 'message' => 'Student Name cannot be blank.'],
            [['student_id'], 'integer'],
	    ['mark', 'each', 'rule' => ['number','max' => 100],'on' => 'create'],
            ['mark', 'each', 'rule' => ['required'],'on' => 'create'],
	    [['student_id'], 'unique','on' => 'create','message' => 'This Student mark has already been entered.'],
            [['created_at', 'updated_at'], 'safe'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'mark' => 'Mark',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
}
