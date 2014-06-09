<?php

/**
 * This is the model class for table "lures".
 *
 * The followings are the available columns in table 'lures':
 * @property integer $lure_id
 * @property string $brand
 * @property string $model
 * @property double $weight
 * @property string $color
 *
 * The followings are the available model relations:
 * @property Catches[] $catches
 */
class Lures extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lures';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brand, model', 'required'),
			array('weight', 'numerical'),
			array('brand, model', 'length', 'max'=>50),
			array('color', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lure_id, brand, model, weight, url, color', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'catches' => array(self::HAS_MANY, 'Catches', 'lure_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lure_id' => 'Lure',
			'brand' => 'Brand',
			'model' => 'Model',
			'weight' => 'Weight',
			'color' => 'Color',
                        'url' => 'Url',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('lure_id',$this->lure_id);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('color',$this->color,true);
                $criteria->compare('url',$this->url,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lures the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
