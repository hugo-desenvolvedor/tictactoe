<?php
/**
 * Responses
 */
$app->add(new \App\Middlewares\Response\Exception());
$app->add(new \App\Middlewares\Response\Json());
