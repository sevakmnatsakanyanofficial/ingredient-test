<?php

namespace app\modules\menu\controllers;


/**
 * Default controller for the `menu` module
 */
class DefaultController extends MenuController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
