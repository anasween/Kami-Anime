<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $autor_id
 * @property string $title
 * @property string $text
 * @property string $create_Date
 *
 * The followings are the available model relations:
 * @property YumUser $autor
 * @property Comments $comments
 */
class News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
            return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
            return array(
                array('text, autor_id, title', 'required'),
                array('autor_id, views', 'numerical', 'integerOnly'=>true),
                array('title', 'length', 'max'=>100),
                array('id, autor_id, title, text, create_Date', 'safe', 'on'=>'search'),
            );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
            return array(
                'autor' => array(self::BELONGS_TO, 'YumUser', 'autor_id'),
                'comments'=>array(self::HAS_MANY, 'Comments', 'news_id'),
            );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
            return array(
                'id' => Yum::t('ID'),
                'autor_id' => Yum::t('Autor'),
                'autor_username' => Yum::t('Autor'),
                'title' => Yum::t('Title'),
                'text' => Yum::t('Text'),
                'create_Date' => Yum::t('Create date'),
                'views' => Yum::t('Views')
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
            $criteria=new CDbCriteria;

            $criteria->together = true; //without this you wont be able to search the second table's data
            $criteria->with = array('autor');
            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.title',$this->title,true);
            $criteria->compare('autor.username',$this->autor_id,true);
            $criteria->compare('t.text',$this->text,true);
            $criteria->compare('t.create_Date',$this->create_Date,true);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'sort'=>array(
                    'defaultOrder'=>'t.id DESC',
                ),
                'pagination' => array(
                    'pageSize' => 100,
                ),
            ));
	}
        
        public function getCommentsDataProvider() 
        {
            $criteria = new CDbCriteria;
            $criteria->compare('news_id', $this->id);

            return new CActiveDataProvider('Comments', array('criteria' => $criteria));
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
            return parent::model($className);
	}
}
