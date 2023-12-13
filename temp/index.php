<?php

include_once './modules/bin/webapp.php';

$app = new WebApplication();
$app->getHeader();
$app->redirectionDefault('Home Page', '/mvc/home');
$app->run();
