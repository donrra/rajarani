<?php

/**
 * This is the model class for table "systemmails_lang".
 *
 * The followings are the available columns in table 'systemmails_lang':
 * @property integer $id
 * @property string $lang
 * @property string $name
 * @property string $description
 * @property string $subject
 * @property string $message
 * @property string $mailattributes
 */
class SystemmailsLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SystemmailsLang the static model class
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
		return 'systemmails_lang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id,lang, name, description, subject, message, mailattributes,msg_id', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('lang', 'length', 'max'=>12),
			array('name', 'length', 'max'=>128),
			array('description', 'length', 'max'=>256),
			array('subject', 'length', 'max'=>64),
			array('mailattributes', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, lang, name, description, subject, message, mailattributes,msg_id', 'safe', 'on'=>'search'),
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
			'lang' => 'Lang',
			'name' => 'Name',
			'description' => 'Description',
			'subject' => 'Subject',
			'message' => 'Message',
			'mailattributes' => 'Mailattributes',
			'msg_id' => 'Message Id'
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
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('mailattributes',$this->mailattributes,true);
		$criteria->compare('msg_id',$this->msg_id,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}