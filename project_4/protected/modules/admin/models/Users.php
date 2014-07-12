<?php

/**
 * This is the model class for table "{{_users}}".
 *
 * The followings are the available columns in table '{{_users}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $DateCreated
 * @property string $LastUpdate
 * @property integer $role_id
 *
 * The followings are the available model relations:
 * @property Roles $role
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $confirm_password;
	
	public function tableName()
	{
		return '{{_users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, confirm_password, role_id', 'required','on'=>'insert'),
			array('password, confirm_password','safe','on'=>'update'),
			array('role_id', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>20),
                        array('username', 'match', 'pattern'=>'/^([a-zA-Z0-9_]{5,20}$)/','message'=>'Username không hợp lệ, phải có it nhất 5 kí tự và không có kí tự đặc biệt'),
                        array('password', 'match', 'pattern'=>'/^([a-zA-Z0-9_!@#$]{8,20}$)/','message'=>'Password không hợp lệ, phải có it nhất 8 kí tự và có thể có kí tự đặc biệt !,@,#,$'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,username, password, DateCreated, LastUpdate, role_id', 'safe', 'on'=>'search'),
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
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Tên đăng nhập',
			'password' => 'Mật khẩu',
			'DateCreated' => 'Ngày tạo',
			'LastUpdate' => 'Cập nhật lần cuối',
			'role_id' => 'Nhóm người dùng',
			'confirm_password' => 'Nhập lại mật khẩu',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('DateCreated',$this->DateCreated,true);
		$criteria->compare('LastUpdate',$this->LastUpdate,true);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        //'pagination'=>array('pageSize' => 50),
			));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Get parent category name
	 */
	public function getRoleName()
	{
		$model = Roles::model()->findByPk($this->role_id);		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');	
		
		return $model->description;
	}

	protected function beforeSave() {
		if(parent::beforeSave())
		{						
			if($this->isNewRecord)
			{
				if($this->password != $this->confirm_password)
				{
					$this->addError('confirm_password','Confirm password and confirm password does not match');
					return false;
				}
				$this->password = hash('sha256', Yii::app()->params['hashSalt'].$this->password);
				$this->DateCreated = $this->LastUpdate = time();
                                
			}
			else
			{
                                $this->removeAsign($this->id);
				if($this->password != $this->confirm_password)
				{
					$this->addError('confirm_password','Confirm password and confirm password does not match');
					return false;
				}
				else if($this->password === '' && $this->confirm_password === '')
				{
					unset($this->password);
				}
				else
				{
					$this->password = hash('sha256', Yii::app()->params['hashSalt'].$this->password);
                                        
				}
				$this->LastUpdate = time();
			}
			return true;
		}		
		return false;
	}
        
        protected function afterSave() {
            parent::afterSave();
            //if($this->isNewRecord){
                $role = $this->role;
                $auth = Yii::app()->authManager;
                $auth->assign($role->description,$this->id);
           // }
        }
        
        public function removeAsign($id){
            $assign = Yii::app()->authManager->getRoles($id);
            if(!empty($assign)){
                $auth = Yii::app()->authManager;
                foreach($assign as $as=>$role):
                    if(Yii::app()->authManager->revoke($as,$id))
                            $auth->save();
                endforeach;
            }
        }
        protected function beforeDelete() {
            $this->removeAsign($this->id);
            parent::beforeDelete();
            return TRUE;
        }
}
