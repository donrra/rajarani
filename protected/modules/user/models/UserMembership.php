<?php

/**
 * This is the model class for table "user_membership".
 *
 * The followings are the available columns in table 'user_membership':
 * @property integer $id
 * @property integer $user_id
 * @property string $membe_fees
 * @property string $duration
 * @property string $token
 * @property string $start_date
 * @property string $end_date
 * @property string $status
 */
class UserMembership extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserMembership the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_membership';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('membe_fees, duration, token, start_date, end_date, status', 'required'),
			array('id, user_id', 'numerical', 'integerOnly'=>true),
			array('membe_fees', 'length', 'max'=>10),
			array('duration, token', 'length', 'max'=>255),
			array('status', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, membe_fees, duration, token, start_date, end_date, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'membe_fees' => 'Membe Fees',
			'duration' => 'Duration',
			'token' => 'Token',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('membe_fees',$this->membe_fees,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}