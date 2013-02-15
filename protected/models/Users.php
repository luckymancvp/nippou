<?php
class Users extends UsersBase
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public $repeat_password;


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.

        return array_merge(parent::rules(), array(
            array('username', 'unique'),
            array('repeat_password', 'required', 'on'=>'insert'),
            array('repeat_password', 'compare', 'compareAttribute'=>'password', 'on'=>'insert'),
        ));
    }

    /**
     * This method is invoked before validation starts.
     * The default implementation calls {@link onBeforeValidate} to raise an event.
     * You may override this method to do preliminary checks before validation.
     * Make sure the parent implementation is invoked so that the event can be raised.
     * @return boolean whether validation should be executed. Defaults to true.
     * If false is returned, the validation will stop and the model is considered invalid.
     */
    protected function beforeValidate()
    {

        return parent::beforeValidate();
    }

    /**
     * @return bool|void
     */
    public function beforeSave(){
        $this->password = md5($this->password);
        return true;
    }
}