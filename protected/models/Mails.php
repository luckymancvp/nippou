<?php
class Mails extends MailsBase
{
    const STATUS_DRAFT = 0;
    const STATUS_SENT  = 1;
    const STATUS_SAVED = 2;
    const STATUS_LATER = 3;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Mails the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public static function saveSentMail($content)
    {
        $mail            = Mails::getDraftEmail();
        $mail->content   = CJSON::encode($content);
        $mail->send_time = new CDbExpression("NOW()");
        $mail->status    = self::STATUS_SENT;
        $mail->save();
    }

    public static function saveLaterMail($content)
    {
        $mail            = Mails::getDraftEmail();
        $mail->content   = CJSON::encode($content);

        $laterTime = date('Y-m-d'). " ".$content["later-time"].":00";
        $mail->send_time = $laterTime;
        $mail->status    = self::STATUS_LATER;
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

    public static function getDraftEmail($user_id = null)
    {
        if (!$user_id)
            $user_id = Yii::app()->user->id;

        $today = date('Y-m-d');
        $tomorrow = $today. " 25";

        $criteria = new CDbCriteria();
        $criteria->order = "save_time DESC";
        $criteria->addCondition("user_id = '$user_id'");
        $criteria->addCondition("status = '".self::STATUS_DRAFT."'");
        $criteria->addCondition("save_time between '$today' and '$tomorrow'");

        $mail = Mails::model()->find($criteria);

        if (!$mail){
            $mail = new  Mails;
            $mail->user_id = $user_id;

            $previousMail = Mails::getLastestMail();
            $mail->content = $previousMail->content;
        }

        return $mail;
    }

    public function saveDraftEmail($content)
    {
        $this->content   = CJSON::encode($content);
        $this->save_time  = new CDbExpression("NOW()");

        $this->save();

        die(var_dump($this->errors));
    }

    public static function getLastestMail()
    {
        $user_id = Yii::app()->user->id;

        $mail = Mails::model()->findByAttributes(array("user_id"=>$user_id), array("order"=>"save_time desc"));

        if (!$mail){
            $mail = new Mails();
        }

        return $mail;
    }

    public static function isTodaySentMail()
    {
        $user_id = Yii::app()->user->id;
        $today = date('Y-m-d');
        $tomorrow = $today. " 25";

        $criteria = new CDbCriteria();
        $criteria->addCondition("user_id = '$user_id'");
        $criteria->addCondition("status = '".self::STATUS_SENT."'");
        $criteria->addCondition("send_time > '$today' and send_time < '$tomorrow'");

        return Mails::model()->exists($criteria);
    }

    public static function getNowLaterMail()
    {
        $now = date('Y-m-d h:i:s');
        $next_minute = date("Y-m-d h:i:s", strtotime("+1 minute"));

        $criteria = new CDbCriteria();
        $criteria->addCondition("status = '".self::STATUS_LATER."'");
        $criteria->addCondition("send_time >= '$now' and send_time < '$next_minute'");

        return Mails::model()->findAll($criteria);
    }

    public static function getTodayLaterMail()
    {
        $today = date('Y-m-d');
        $tomorrow = $today. " 25";

        $criteria = new CDbCriteria();
        $criteria->addCondition("status = '".self::STATUS_LATER."'");
        $criteria->addCondition("send_time > '$today' and send_time < '$tomorrow'");

        return Mails::model()->findAll($criteria);
    }

}