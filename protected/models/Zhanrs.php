<?php

/**
 * This is the model class for table "zhanrs".
 *
 * The followings are the available columns in table 'zhanrs':
 * @property string $id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property AnimeZhanrs[] $animeZhanrs
 */
class Zhanrs extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'zhanrs';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('title', 'required'),
            array('title', 'length', 'max' => 255),
            array('id, title', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'anime' => array(self::MANY_MANY, 'Anime', 'anime_zhanrs(zhanr_id, anime_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yum::t('ID'),
            'title' => Yum::t('Title'),
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
        $criteria->compare('title', $this->title, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Zhanrs the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
