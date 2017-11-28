<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller {

    public function actionInit() {
        $user = new User();
        $user->username = "admin";
        $user->email = "admin@gmail.com";
        $user->status = 1;
        $user->password_hash = 'Admin@123';
        $user->save();
    }

}
