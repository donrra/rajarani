<?php

/**
 * This is the model class for table "userfeedback".
 *
 * The followings are the available columns in table 'userfeedback':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $comment
 * @property string $browser
 * @property string $platform
 * @property integer $rating
 * @property string $reason1
 * @property string $reason2
 * @property string $reason3
 * @property string $reason4
 * @property string $reason5
 * @property string $reason6
 */
class Userfeedback extends CActiveRecord
{
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
			array('user_id, name, comment, rating, reason1, reason2, reason3, reason4, reason5, reason6', 'required'),
			array('user_id, rating', 'numerical', 'integerOnly'=>true),
			array('name, comment, browser, platform, reason1, reason2, reason3, reason4, reason5, reason6', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, comment, browser, platform, rating, reason1, reason2, reason3, reason4, reason5, reason6', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'comment' => 'Comment',
			'browser' => 'Browser',
			'platform' => 'Platform',
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
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('browser',$this->browser,true);
		$criteria->compare('platform',$this->platform,true);
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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Userfeedback the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
