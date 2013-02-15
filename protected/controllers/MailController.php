<?php

class MailController extends Controller
{
    public function actionIndex()
    {
        // Get login user id
        $user_id = Yii::app()->user->id;

        /** @var $mail Mails */
        $mail = Mails::getLastestMail();

        if (!isset($_POST["resent"]) && Mails::isTodaySentMail()){
            $this->render('index');
            return;
        }

        $form = Forms::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$form){
            Yii::app()->user->setFlash("error", "Please create form before send mail");
            $this->redirect(array("/mail/createForm"));
        }

        if (!$mail->content)
            $mail->content = "{}";

        $this->render('send', array(
            'form'=>$form,
            'contentForm'  => $this->escapeCharacter($form->content),
            'previousValue'=> $mail->content,
        ));
    }

    public function actionSend()
    {
        // Get login user id
        $user_id = Yii::app()->user->id;

        $form = Forms::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$form){
            Yii::app()->user->setFlash("error", "Please create form before send mail");
            $this->redirect(array("/mail/createForm"));
        }


        if (isset($_POST["params"])){
            $mailContent = $this->genMailContent($form->content, $_POST["params"]);
            $this->sendMail($mailContent);
            Mails::saveSentMail($_POST["params"]);
            $this->redirect(array("/mail"));
        }

        $this->render('send', array(
            'form'=>$form,
            'contentForm'  => $this->escapeCharacter($form->content),
            'previousValue'=> $mail->content,
        ));
    }

    public function actionSave()
    {
        // Get login user id
        $user_id = Yii::app()->user->id;

        /** @var $mail Mails */
        $mail = Mails::getDraftEmail();
        $mail->saveDraftEmail($_GET["params"]);

        die("Saved");
    }


    public function actionReview()
    {
        // Get login user id
        $user_id = Yii::app()->user->id;

        $form = Forms::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$form){
            Yii::app()->user->setFlash("error", "Please create form before send mail");
            $this->redirect(array("/mail/createForm"));
        }
        if (isset($_GET["params"])){
            $mailContent = $this->genMailContent($form->content, $_GET["params"]);
            $mailContent = $this->escapeCharacter($mailContent);
            die($mailContent);
        }
    }

    private function escapeCharacter($content)
    {
        $content = preg_replace('/\{([^}]*)\}/', '<code id="code-${1}">{${1}}</code>', $content);

        return $content;
    }

    private function genMailContent($contentForm, $params){
        $params["date"] = date("m/d");
        foreach ($params as $key=>$val){
            $contentForm = str_replace("{{$key}}", $val, $contentForm);
        }

        return $contentForm;
    }

    private function sendMail($mailContent){
        // Get login user id
        $user_id = Yii::app()->user->id;

        /** @var $setting Settings */
        $setting = Settings::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$setting) {
            throw new CHttpException(404, "Can't find your settings");
        }

        $today = date("yy/m/d");
        $title = "【日報】{$setting->name}　$today";

        $headers = array(
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=utf8'
        );
        Yii::app()->email->send(
            $setting->from_mail,
            $setting->to_email,
            $title,
            $mailContent,
            $headers
        );
    }

    public function actionCreateForm()
    {
        // Get login user id
        $user_id = Yii::app()->user->id;
        $form = Forms::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$form)
            $form = new Forms;

        if (isset($_POST['Forms'])){
            $form->attributes = $_POST['Forms'];
            $form->user_id    = Yii::app()->user->id;
            if ($form->save()){
                Yii::app()->user->setFlash("success", "Save sample form successful");
                $this->redirect(array("/mail/"));
            }

            Yii::app()->user->setFlash("success", "Save sample form failed");
        }

        $this->render('createForm',array(
            'model'   => $form,
        ));
    }

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions　　（されたユーザーはすべてのアクションへのアクセスを許可する）
                'users'=>array('@'),
            ),
            array('deny',  // deny all users　　(すべてのユーザーを拒否する。)
                'users'=>array('*'),
            ),
        );
    }
}