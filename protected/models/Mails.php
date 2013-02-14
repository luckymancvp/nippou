<?php
class Mails extends MailsBase
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Mails the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public static function saveNewMail($content)
    {
        $user_id = Yii::app()->user->id;
        $mail = new Mails();
        $mail->user_id = $user_id;
        $mail->content = CJSON::encode($content);
        $mail->time    = new CDbExpression("NOW()");
        $mail->save();
    }

    /**
     * @return bool
     */
    public function isToday()
    {
        $now = date('Y-m-d');
        return $now <= $this->time;
    }

}