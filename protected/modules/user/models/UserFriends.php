<?php

/**
 * This is the model class for table "user_friends".
 *
 * The followings are the available columns in table 'user_friends':
 * @property integer $id
 * @property integer $user_id
 * @property integer $friend_id
 * @property string $activkey
 * @property integer $status
 */
class UserFriends extends CActiveRecord
{
	
	public $hasfriends;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFriends the static model class
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
		return 'user_friends';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{ 
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, friend_id, status', 'required'),
			array('user_id, friend_id, status', 'numerical', 'integerOnly'=>true),
			array('activkey', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, friend_id, activkey, status', 'safe', 'on'=>'search'),
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
			'friend_id' => 'Friends',
			'activkey' => 'Activkey',
			'status' => 'Status',
		);
	}


	public function denycount($ruserid,$rfriendsid)
        {
		 $dbCommand= "select * from `user_friends` where `user_id`=$ruserid AND `friend_id`=$rfriendsid AND `status`=2";
         $denycountset = Yii::app()->db->createCommand($dbCommand)->queryAll();
		 return $denycountset;	
        }
	
	public function havefriends($ruserid,$rfriendsid)
        {
		$dbCommand= 'select ismyfriend('.$ruserid.','.$rfriendsid.') as isfriend';
        $hasfriends = Yii::app()->db->createCommand($dbCommand)->queryAll();
		 return $hasfriends;	
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
		$criteria->compare('friend_id',$this->friend_id);
		$criteria->compare('activkey',$this->activkey,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}