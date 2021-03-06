<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property string $id
 * @property string $name
 * @property string $answer
 * @property string $other
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property CustomerQuestion[] $customerQuestions
 */
class Customer extends CActiveRecord
{
    public $question_ids;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name, answer, other, create_date', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, answer, other, create_date', 'safe', 'on'=>'search'),
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
                    'customerQuestions' => array(self::HAS_MANY, 'CustomerQuestion', 'customer_id'),
                    'questions' => array(self::MANY_MANY, 'Question', 'customer_question(question_id, customer_id)', 'together'=>true),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'answer' => 'Answer',
			'other' => 'Other',
			'create_date' => 'Create Date',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('other',$this->other,true);
		$criteria->compare('create_date',$this->create_date,true);
                if(!empty($this->question_ids)){
                      $criteria->compare('question_id', array_values((array)$this->question_ids));
                }
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave() {
            if(parent::beforeSave()){
                $this->create_date = time();
                return true;
            }
            return false;
        }
        
        public function getQuestionName()
	{
		if(count($this->questions))
		{
			$questions_name = '';
			foreach($this->questions as $question){
				//$categories_name .= $category->name.', ';
                                $questions_name .= CHtml::link($question->text,  Yii::app()->createUrl('admin/question/update/id/'.$question->id) ).', ';
			}

			$questions_name = rtrim($questions_name,', ');
			return $questions_name;
		}
		return 'None';
	}	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
