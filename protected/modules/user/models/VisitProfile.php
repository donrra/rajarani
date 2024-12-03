<?php

/**
 * This is the model class for table "visit_profile".
 *
 * The followings are the available columns in table 'visit_profile':
 * @property integer $id
 * @property integer $profileid
 * @property integer $visitby
 * @property string $visit_time
 *
 * The followings are the available model relations:
 * @property Users $visitby0
 * @property Users $profile
 */
class VisitProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VisitProfile the static model class
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
		return 'visit_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profileid, visitby', 'required'), //, visit_time
			array('profileid, visitby', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, profileid, visitby, visit_time', 'safe', 'on'=>'search'),
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
			'visitby0' => array(self::BELONGS_TO, 'Users', 'visitby'),
			'profile' => array(self::BELONGS_TO, 'Users', 'profileid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'profileid' => 'Profileid',
			'visitby' => 'Visitby',
			'visit_time' => 'Visit Time',
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
		$criteria->compare('profileid',$this->profileid);
		$criteria->compare('visitby',$this->visitby);
		$criteria->compare('visit_time',$this->visit_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}