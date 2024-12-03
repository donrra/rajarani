<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $id
 * @property integer $internalname
 * @property string $created
 * @property string $updated
 * @property string $created_by
 * @property string $modified_by
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $page_title
 * @property string $content
 * @property string $published
 *
 * The followings are the available model relations:
 * @property Users $modifiedBy
 * @property Users $createdBy
 */
class Page extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Page the static model class
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
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_title,internalname', 'required'),
			array('created, updated, meta_title, meta_keywords, meta_description, content, published,internalname','safe' ),
			 array('internalname','unique', 'message'=>'This is already exists.'),

			array('created_by, modified_by', 'length', 'max'=>11),
			array('meta_title, meta_keywords, meta_description, page_title,internalname', 'length', 'max'=>255),
			array('published', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created, updated, created_by, modified_by, meta_title, meta_keywords, meta_description, page_title, content, published', 'safe', 'on'=>'search'),
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
			'modifiedBy' => array(self::BELONGS_TO, 'Users', 'modified_by'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Oprettet',
			'updated' => 'Opdateret',
			'created_by' => 'Oprettet af',
			'modified_by' => 'Redigeret af',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'page_title' => 'Sidetitel',
			'internalname'=> 'Internal Name',
			'content' => 'Indhold',
			'published' => 'Publiceret',
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
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified_by',$this->modified_by,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('published',$this->published,true);
    
	
	return new CActiveDataProvider(get_class($this), array(
        'criteria' => $criteria,
        'pagination' => array(
            'pageSize' => 25,
        ),
    ));
	/*	return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			
		));*/
		
		
	}

	public function behaviors()
	{
		return array(
		'behaviorName'=>array(
		'class'=>'application.components.SystemDateTimeConversionBehavior',
		));
	}

	public function beforeValidate()
	{
		if ($this->isNewRecord)
		{
			$this->created 		= date('d-m-Y h:i:s');//new CDbExpression('NOW()');
			$this->created_by 	= Yii::app()->user->id; 
			//$this->created_by = UserModule::t()->user->id;
		}
		else
		{
			$this->modified_by 	= Yii::app()->user->id;
		//	$this->modified_by 	= UserModule::t()->user->id;
			$this->updated 		= date('d-m-Y h:i:s');//new CDbExpression('NOW()');
		}

		return parent::beforeValidate();
	}
}