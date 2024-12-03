<?php

/**
 * This is the model class for table "lang_source".
 *
 * The followings are the available columns in table 'lang_source':
 * @property integer $id
 * @property string $category
 * @property string $message
 */
class LangSource extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LangSource the static model class
	 */
	public $translation;
	public $language;

	public $translation2;
	public $language2;
	public $danish;
	public $swedish;
	public $english;
	public $norwegian;


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lang_source';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category', 'length', 'max'=>32),
			array('message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, message,translation,language,danish,swedish,norwegian', 'safe', 'on'=>'search'),
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
			'category' => 'Category',
			'message' => 'Message',
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
		$criteria->select="t.id,t.category,t.message,u.language AS language,u.translation AS danish,u2.language AS language2,u2.translation AS swedish,u3.translation AS norwegian ";//,u.id,u.translation";
		$criteria->join=" left join lang u on t.id=u.id  AND u.language='dk'";
		$criteria->join.=" left join lang u2 on t.id=u2.id AND u2.language='se'";
		$criteria->join.=" left join lang u3 on t.id=u3.id AND u3.language='no'";
		$criteria->condition="u.translation!=''";

		$criteria->compare('id',$this->id);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('u.translation',$this->danish,true);
		$criteria->compare('u.language',$this->language,true);
		$criteria->compare('u2.translation',$this->swedish,true);
		$criteria->compare('u3.translation',$this->norwegian,true);
		$criteria->compare('message',$this->message,true);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}