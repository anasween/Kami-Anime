<?php

/**
 * This is the model class for table "connections".
 *
 * The followings are the available columns in table 'connections':
 * @property string $id
 * @property string $title
 * @property string $wa_url
 *
 * The followings are the available model relations:
 * @property Anime[] $animes
 */
class Connections extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'connections';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('title', 'required'),
            array('title', 'length', 'max' => 100),
            array('wa_url', 'length', 'max' => 255),
            array('id, title, wa_url', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'animes' => array(self::MANY_MANY, 'Anime', 'anime_connections(connection_id, anime_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'wa_url' => 'Wa Url',
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
        $criteria->compare('wa_url', $this->wa_url, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Connections the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
