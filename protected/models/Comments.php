<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $id
 * @property integer $autor_id
 * @property string $text
 * @property string $createTime
 * @property integer $news_id
 * @property integer $group_id
 * @property integer $profile_id
 * @property integer $anime_id
 *
 * The followings are the available model relations:
 * @property News $news
 * @property YumUser $autor
 * @property YumUsergroup $groups
 * @property YumProfile $profiles
 * @property Anime $anime
 */
class Comments extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comments';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('autor_id, text, createtime', 'required'),
            array('autor_id, news_id, group_id, anime_id', 'numerical', 'integerOnly' => true),
            array('id, autor_id, text, createtime, news_id, group_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'news' => array(self::BELONGS_TO, 'News', 'news_id'),
            'autor' => array(self::BELONGS_TO, 'YumUser', 'autor_id'),
            'groups' => array(self::BELONGS_TO, 'YumUsergroup', 'group_id'),
            'profiles' => array(self::BELONGS_TO, 'YumProfile', 'profile_id'),
            'anime' => array(self::BELONGS_TO, 'Anime', 'anime_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yum::t('ID'),
            'autor_id' => Yum::t('Autor'),
            'text' => Yum::t('Text'),
            'createtime' => Yum::t('Create date'),
            'news_id' => Yum::t('New'),
            'group_id' => Yum::t('Group'),
            'profile_id' => Yum::t('Profile'),
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

        $criteria->together = true;
        $criteria->with = array('autor');
        $criteria->compare('id', $this->id);
        $criteria->compare('autor.username', $this->autor_id);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('createtime', $this->createtime, true);
        $criteria->compare('news_id', $this->news_id);
        $criteria->compare('group_id', $this->group_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Comments the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
