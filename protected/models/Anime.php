<?php

/**
 * This is the model class for table "anime".
 *
 * The followings are the available columns in table 'anime':
 * @property string $id
 * @property string $name_ru
 * @property string $name_en
 * @property string $name_jp
 * @property string $poster
 * @property string $autor_id
 * @property string $create
 * @property string $modify
 * @property integer $year
 * @property integer $views
 * @property string $description
 *
 * The followings are the available model relations:
 * @property YumUser $autor
 * @property AnimeZhanrs[] $animeZhanrs
 */
class Anime extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'anime';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name_ru, name_en, name_jp, poster, autor_id, modify, year, description', 'required'),
            array('year, views', 'numerical', 'integerOnly'=>true),
            array('name_ru, name_en, name_jp', 'length', 'max'=>100),
            array('poster', 'length', 'max'=>255),
            array('autor_id', 'length', 'max'=>10),
            array('create', 'safe'),
            array('id, name_ru, name_en, name_jp, poster, autor_id, create, modify, year, views, description', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'autor' => array(self::BELONGS_TO, 'YumUser', 'autor_id'),
            'animeZhanrs' => array(self::HAS_MANY, 'AnimeZhanrs', 'anime_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yum::t('ID'),
            'name_ru' => Yum::t('Name Ru'),
            'name_en' => Yum::t('Name En'),
            'name_jp' => Yum::t('Name Jp'),
            'poster' => Yum::t('Poster'),
            'autor_id' => Yum::t('Autor'),
            'create' => Yum::t('Create'),
            'modify' => Yum::t('Modify'),
            'year' => Yum::t('Year'),
            'views' => Yum::t('Views'),
            'description' => Yum::t('Description'),
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

        $criteria->together = true;
        $criteria->with = array('autor');
        $criteria->compare('id',$this->id,true);
        $criteria->compare('name_ru',$this->name_ru,true);
        $criteria->compare('name_en',$this->name_en,true);
        $criteria->compare('name_jp',$this->name_jp,true);
        $criteria->compare('poster',$this->poster,true);
        $criteria->compare('autor.username',$this->autor_id,true);
        $criteria->compare('create',$this->create,true);
        $criteria->compare('modify',$this->modify,true);
        $criteria->compare('year',$this->year);
        $criteria->compare('views',$this->views);
        $criteria->compare('description',$this->description,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Anime the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
