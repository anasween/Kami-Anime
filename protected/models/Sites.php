<?php

/**
 * This is the model class for table "sites".
 *
 * The followings are the available columns in table 'sites':
 * @property string $id
 * @property string $title
 * @property string $logo
 *
 * The followings are the available model relations:
 * @property Urls[] $urls
 */
class Sites extends CActiveRecord {

    /**
     * Path to logo.
     * @var string
     */
    public $logo;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sites';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('title', 'required'),
            array('title', 'length', 'max' => 100),
            array('logo', 'length', 'max' => 255),
            array('title', 'safe', 'on' => 'search'),
            array('logo', 'file', 'types' => 'jpg, png, gif', 'allowEmpty' => true),
        );
    }
    
     /**
     * Delete old logo before save new. 
     * @return boolean
     */
    protected function beforeSave() {
        if (!parent::beforeSave()) {
            return false;
        }
        $logo = CUploadedFile::getInstance($this, 'logo');
        if ($logo) {
            $this->deleteLogo();

            $this->logo = $logo;
            $ext = pathinfo($logo, PATHINFO_EXTENSION);
            $newName = md5(rand(1,9999).time()) . '.' . $ext;
            $this->logo->saveAs(Yii::getPathOfAlias('webroot.media.logo') . DIRECTORY_SEPARATOR . $newName);
            $this->logo = $newName;
        }
        return true;
    }

    /**
     * Delete logo before delete document.
     * @return boolean
     */
    protected function beforeDelete() {
        if (!parent::beforeDelete()) {
            return false;
        }
        $this->deleteLogo();
        return true;
    }

    /**
     * Delete logo.
     */
    public function deleteLogo() {
        $logoPath = Yii::getPathOfAlias('webroot.media.logo') . DIRECTORY_SEPARATOR .
                $this->logo;
        if (is_file($logoPath)) {
            unlink($logoPath);
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'urls' => array(self::HAS_MANY, 'Urls', 'site_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yum::t('ID'),
            'title' => Yum::t('Title'),
            'logo' => Yum::t('Logo'),
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
        
        $criteria->compare('title', $this->title, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Sites the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    /**
     * Returns path top logo.
     * @return string
     */
    public function getLogoPath() {
        return '/media/logo/' . $this->logo;
    }
    
    /**
     * Returns generated site logo html.
     * @return string
     */
    public function getLogo() {
        if ($this->logo) {
            return BSHtml::imageThumbnail($this->getLogoPath());
        }
    }

}
