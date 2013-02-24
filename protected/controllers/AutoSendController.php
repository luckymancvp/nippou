<?php

class AutoSendController extends Controller
{
	public function actionIndex()
	{
        // Do task 1
        $this->doTask1();

        // Do task 2
        $this->doTask2();
	}

    /**
     * Check if have latter mail in current time
     */
    private function doTask1() {
        // get today send later mail
        $mails = Mails::getNowLaterMail();

        foreach ($mails as $mail){
            MailService::sendMail($mail);
        }

        echo "done";
        echo "\n";
    }

    /**
     * Loop foreach users
     * Check if today user did not send any mail then generate mail content & send it
     */
    private function doTask2()
    {
        // Get all users
        $users = Users::model()->findAll();

        /** @var $user Users */
        foreach ($users as $user){
            if ($user->notSentMailBeforeLimitedTime())
                $user->sendTodayMissMail();
        }
    }
}