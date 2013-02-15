<?php

class MeController extends Controller
{

    public function actionIndex()
    {
        // Get login user id
        $user_id = Yii::app()->user->id;

        $setting = Settings::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$setting) {
            throw new CHttpException(404, "Can't find your settings");
        }

        $this->render('index', array(
            'model' => $setting,
        ));

    }

    public function actionChange()
    {
        // Get login user id
        $user_id = Yii::app()->user->id;

        $setting = Settings::model()->findByAttributes(array("user_id"=>$user_id));
        if (!$setting) {
            throw new CHttpException(404, "Can't find your settings");
        }

        if (isset($_POST['Settings'])){
            $setting->attributes = $_POST['Settings'];
            if ($setting->save()) {
                Yii::app()->user->setFlash("error", "Alert ! You have entered invalid settings");
                $this->redirect(Yii::app()->homeUrl);
            }
        }

        $this->render('change', array(
            'model' => $setting,
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