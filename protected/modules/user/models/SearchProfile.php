<?php

/**
 * This is the model class for table "search_profile".
 *
 * The followings are the available columns in table 'search_profile':
 * @property integer $id
 * @property integer $profileid
 * @property integer $searchby
 * @property string $search_time
 *
 * The followings are the available model relations:
 * @property Users $searchby0
 * @property Users $profile
 */
class SearchProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SearchProfile the static model class
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
		return 'search_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profileid, searchby, search_time', 'required'),
			array('profileid, searchby', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, profileid, searchby, search_time', 'safe', 'on'=>'search'),
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
			'searchby0' => array(self::BELONGS_TO, 'Users', 'searchby'),
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
			'searchby' => 'Searchby',
			'search_time' => 'Search Time',
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
		$criteria->compare('searchby',$this->searchby);
		$criteria->compare('search_time',$this->search_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}