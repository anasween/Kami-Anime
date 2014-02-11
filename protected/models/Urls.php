<?php

/**
 * This is the model class for table "urls".
 *
 * The followings are the available columns in table 'urls':
 * @property string $id
 * @property string $anime_id
 * @property string $site_id
 * @property string $url
 *
 * The followings are the available model relations:
 * @property Anime $anime
 * @property Sites $site
 */
class Urls extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'urls';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('anime_id, site_id, url', 'required'),
            array('anime_id, site_id', 'length', 'max' => 10),
            array('url', 'length', 'max' => 250),
            array('anime_id, site_id, url', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'anime' => array(self::BELONGS_TO, 'Anime', 'anime_id'),
            'site' => array(self::BELONGS_TO, 'Sites', 'site_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yum::t('ID'),
            'anime_id' => Yum::t('Anime'),
            'site_id' => Yum::t('Site'),
            'url' => Yum::t('Url'),
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
        $criteria->compare('anime_id', $this->anime_id, true);
        $criteria->compare('site_id', $this->site_id, true);
        $criteria->compare('url', $this->url, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Urls the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
