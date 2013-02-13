<?php

class MailController extends Controller
{
	public function actionIndex()
	{
	    // Get login user id
        $user_id = 1; //Yii::app()->user->id;

        $form = Forms::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$form){
            Yii::app()->user->setFlash("error", "Please create form before send mail");
            $this->redirect(array("/mail/createForm"));
        }

        if (isset($_POST["params"])){
            $mailContent = $this->genMailContent($form->content, $_POST["params"]);
            $this->sendMail($mailContent);
        }

		$this->render('index', array(
            'form'=>$form,
            'contentForm' => $this->escapeCharacter($form->content),
        ));
    }

    public function actionReview()
    {
        // Get login user id
        $user_id = 1; //Yii::app()->user->id;

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
        $content = str_replace(" ", "&nbsp", $content);

        $content = preg_replace('/\{(.*)\}/', '<code id="code-${1}">{${1}}</code>', $content);

        $content = str_replace("\n", "<br>", $content);
        $content = str_replace("\t", "&nbsp&nbsp&nbsp&nbsp", $content);

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
        $user_id = 1; //Yii::app()->user->id;

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
            'tu@oneofthem.jp',
            $title,
            $mailContent,
            $headers
        );
    }

    public function actionCreateForm()
    {
        // Get login user id
        $user_id = 1; //Yii::app()->user->id;
        $form = Forms::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$form)
            $form = new Forms;

        if (isset($_POST['Forms'])){
            $form->attributes = $_POST['Forms'];
            $form->user_id    = 1;//Yii::app()->user->id;
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

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}