<?php

/**
 * This is the model class for table "userfeedback".
 *
 * The followings are the available columns in table 'userfeedback':
 * @property integer $id
 * @property integer $user_id
 * @property integer $rating
 * @property string $reason
 */
class Userfeedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userfeedback the static model class
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
		return 'userfeedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, rating', 'numerical', 'integerOnly'=>true),
			array('reason1, reason2, reason3, reason4, reason5, reason6', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, rating, reason1, reason2, reason3, reason4, reason5, reason6', 'safe', 'on'=>'search'),
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
			'rating' => 'Rating',
			'reason1' => 'Reason1',
			'reason2' => 'Reason2',
			'reason3' => 'Reason3',
			'reason4' => 'Reason4',
			'reason5' => 'Reason5',
			'reason6' => 'Reason6',
			
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
		$criteria->compare('rating',$this->rating);
		$criteria->compare('reason1',$this->reason1,true);
		$criteria->compare('reason2',$this->reason2,true);
		$criteria->compare('reason3',$this->reason3,true);
		$criteria->compare('reason4',$this->reason4,true);
		$criteria->compare('reason5',$this->reason5,true);
		$criteria->compare('reason6',$this->reason6,true);

		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}