<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../yii/framework/yiit.php';
$test = require(dirname(__FILE__) . '/../config/test.php');

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($test);
