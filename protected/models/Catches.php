<?php

/**
 * This is the model class for table "catches".
 *
 * The followings are the available columns in table 'catches':
 * @property integer $catch_id
 * @property integer $user_id
 * @property integer $lake_id
 * @property integer $lure_id
 * @property integer $fish_id
 * @property string $date
 * @property string $image_url
 * @property double $coord_latitude
 * @property double $coord_longitude
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Lakes $lake
 * @property Lures $lure
 * @property Fishes $fish
 */
class Catches extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'catches';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, lake_id, lure_id, fish_id', 'numerical', 'integerOnly' => true),
            array('coord_latitude, coord_longitude', 'numerical'),
            array('image_url', 'length', 'max' => 100),
            array('date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('catch_id, user_id, lake_id, lure_id, fish_id, date, image_url, coord_latitude, coord_longitude', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'lake' => array(self::BELONGS_TO, 'Lakes', 'lake_id'),
            'lure' => array(self::BELONGS_TO, 'Lures', 'lure_id'),
            'fish' => array(self::BELONGS_TO, 'Fishes', 'fish_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'catch_id' => 'Catch',
            'user_id' => 'User',
            'lake_id' => 'Lake',
            'lure_id' => 'Lure',
            'fish_id' => 'Fish',
            'date' => 'Date',
            'image_url' => 'Image Url',
            'coord_latitude' => 'Coord Latitude',
            'coord_longitude' => 'Coord Longitude',
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
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('catch_id', $this->catch_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('lake_id', $this->lake_id);
        $criteria->compare('lure_id', $this->lure_id);
        $criteria->compare('fish_id', $this->fish_id);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('image_url', $this->image_url, true);
        $criteria->compare('coord_latitude', $this->coord_latitude);
        $criteria->compare('coord_longitude', $this->coord_longitude);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Catches the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /*
     * Before save
     * add logged in user as an owner of new catch
     */

    public function beforeSave() {
        if (!Yii::app()->user->isGuest) {
            $this->user_id = Yii::app()->user->getId();
            if (isset($this->date)) {
                $this->date = date('Y-m-d', strtotime($this->date));
            }
            return true;
        } else {
            return false;
        }
    }

    public function isOwner() {
        return $this->user_id == Yii::app()->user->getId();
    }

}
