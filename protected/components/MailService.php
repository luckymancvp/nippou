<?php
/**
 * Created by JetBrains PhpStorm.
 * User: luckymancvp
 * Date: 2/18/13
 * Time: 6:46 PM
 * To change this template use File | Settings | File Templates.
 */
class MailService
{
    /**
     * @param $mail Mails
     */
    public static function sendMail($mail)
    {
        // Get login user id
        $user_id = $mail->user_id;

        /**
         * Get setting and form
         * @var $setting Settings
         * @var $form Forms
         */
        $setting = Settings::model()->findByAttributes(array("user_id"=>$user_id));
        $form    = Forms::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$setting || !$form) {
            //throw new CHttpException(404, "Can't find your settings");
            return ;
        }


        // Change status of mail
        $mail->send_time = new CDbExpression('NOW()');
        $mail->status = Mails::STATUS_SENT;
        $mail->save();

        $today = date("Y/m/d");
        $title = "【日報】{$setting->name}　$today";

        $headers = array(
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=utf8'
        );
        Yii::app()->email->send(
            $setting->from_mail,
            $setting->to_email,
            $title,
            MailService::genMailContent($form->content, CJSON::decode($mail->content)),
            $headers
        );
    }

    public static function genMailContent($contentForm, $params){
        foreach ($params as $key=>$val){
            $contentForm = str_replace("{{$key}}", $val, $contentForm);
        }

        return $contentForm;
    }
}
