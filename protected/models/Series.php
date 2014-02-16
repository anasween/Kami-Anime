<?php

/**
 * This is the model class for table "series".
 *
 * The followings are the available columns in table 'series':
 * @property string $id
 * @property integer $number
 * @property string $name_ru
 * @property string $name_en
 * @property string $description
 * @property string $anime_id
 *
 * The followings are the available model relations:
 * @property Anime $anime
 */
class Series extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'series';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('number', 'numerical', 'integerOnly' => true),
            array('name_ru, name_en', 'length', 'max' => 100),
            array('anime_id', 'length', 'max' => 10),
            array('description', 'safe'),
            array('id, number, name_ru, name_en, description, anime_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'anime' => array(self::BELONGS_TO, 'Anime', 'anime_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yum::t('ID'),
            'number' => Yum::t('Number'),
            'name_ru' => Yum::t('Name Ru'),
            'name_en' => Yum::t('Name En'),
            'description' => Yum::t('Description'),
            'anime_id' => Yum::t('Anime'),
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
    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('number', $this->number);
        $criteria->compare('name_ru', $this->name_ru, true);
        $criteria->compare('name_en', $this->name_en, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('anime_id', $this->anime_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Series the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
