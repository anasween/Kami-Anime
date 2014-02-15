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
 * @property integer $autor_id
 * @property string $createtime
 * @property string $modify
 * @property integer $year
 * @property integer $views
 * @property string $description
 * @property string $type
 * @property integer $series_count
 *
 * The followings are the available model relations:
 * @property YumUser $autor
 * @property Zhanrs[] $zhanrs
 * @property Urls[] $urls
 */
class Anime extends CActiveRecord {

    /**
     * Path to poster.
     * @var string
     */
    public $poster;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'anime';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name_ru, name_en, name_jp, autor_id, year, description, type, series_count', 'required'),
            array('year, views, series_count', 'numerical', 'integerOnly' => true),
            array('name_ru, name_en, name_jp', 'length', 'max' => 100),
            array('year', 'length', 'max' => 4),
            array('autor_id', 'length', 'max' => 10),
            array('createtime', 'safe'),
            array('name_ru, name_en, name_jp, autor_id', 'safe', 'on' => 'search'),
            array('poster', 'file', 'types' => 'jpg, png', 'allowEmpty' => true),
        );
    }

    /**
     * Delete old poster before save new. 
     * @return boolean
     */
    protected function beforeSave() {
        if (!parent::beforeSave()) {
            return false;
        }
        $poster = CUploadedFile::getInstance($this, 'poster');
        if ($poster) {
            $this->deletePoster();

            $this->poster = $poster;
            $ext = pathinfo($poster, PATHINFO_EXTENSION);
            $newName = md5(rand(1, 9999) . time()) . '.' . $ext;
            $this->poster->saveAs(Yii::getPathOfAlias('webroot.media') . DIRECTORY_SEPARATOR . $newName);
            $this->poster = $newName;
        }
        return true;
    }

    /**
     * Delete poster before delete document.
     * @return boolean
     */
    protected function beforeDelete() {
        if (!parent::beforeDelete()) {
            return false;
        }
        $this->deletePoster();
        return true;
    }

    /**
     * Delete poster.
     */
    public function deletePoster() {
        $posterPath = Yii::getPathOfAlias('webroot.media') . DIRECTORY_SEPARATOR .
                $this->poster;
        if (is_file($posterPath)) {
            unlink($posterPath);
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'autor' => array(self::BELONGS_TO, 'YumUser', 'autor_id'),
            'zhanrs' => array(self::MANY_MANY, 'Zhanrs', 'anime_zhanrs(anime_id, zhanr_id)'),
            'urls' => array(self::HAS_MANY, 'Urls', 'anime_id'),
            'connections' => array(self::MANY_MANY, 'Connections', 'anime_connections(anime_id, connection_id)'),
            'comments' => array(self::HAS_MANY, 'Comments', 'news_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name_ru' => Yum::t('Name ru'),
            'name_en' => Yum::t('Name en'),
            'name_jp' => Yum::t('Name jp'),
            'poster' => Yum::t('Poster'),
            'autor_id' => Yum::t('Autor'),
            'createtime' => Yum::t('Create time'),
            'modify' => Yum::t('Modify'),
            'year' => Yum::t('Year'),
            'views' => Yum::t('Views'),
            'description' => Yum::t('Description'),
            'series_count' => Yum::t('Series count'),
            'type' => Yum::t('Type'),
            'zhanrs' => Yum::t('Zhanrs')
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
        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.name_ru', $this->name_ru, true);
        $criteria->compare('t.name_en', $this->name_en, true);
        $criteria->compare('t.name_jp', $this->name_jp, true);
        $criteria->compare('autor.username', $this->autor_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Anime the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Returns path to poster.
     * @return string
     */
    public function getPosterPath() {
        return '/media/' . $this->poster;
    }

    public function getPoster() {
        if ($this->poster) {
            return BSHtml::imageThumbnail($this->getPosterPath());
        }
    }

    /**
     * Synchronise zhanrs.
     * @param array $zhanrs
     */
    public function syncZhanrs($zhanrs = null) {
        $query = sprintf("delete from %s where anime_id = %s", 'anime_zhanrs', $this->id);
        $result = Yii::app()->db->createCommand($query)->execute();
        if ($zhanrs) {
            foreach ($zhanrs as $zhanr) {
                $query = sprintf("insert into %s (anime_id, zhanr_id) values(%s, %s)", 'anime_zhanrs', $this->id, $zhanr);
                $result = Yii::app()->db->createCommand($query)->execute();
            }
        }
    }

    public static function getTypes() {
        return array(
            'ТВ' => 'ТВ',
            'ТВ-спэшл' => 'ТВ-спэшл',
            'OVA' => 'OVA',
            'ONA' => 'ONA',
            'полнометражный фильм' => 'полнометражный фильм',
            'короткометражный фильм' => 'короткометражный фильм',
            'музыкальное видео' => 'музыкальное видео',
            'рекламный ролик' => 'рекламный ролик'
        );
    }

    public function getZhanrs() {
        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('anime');
        $criteria->condition = 'anime.id = ' . $this->id;
        return Zhanrs::model()->findAll($criteria);
    }

    public function getCommentsDataProvider() {
        $criteria = new CDbCriteria;
        $criteria->compare('anime_id', $this->id);

        return new CActiveDataProvider('Comments', array('criteria' => $criteria));
    }

}
