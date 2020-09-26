<?php

$entity = new Core\Entity\Entity();

$url = $entity->app_info('app_domaine');

setcookie('acceptCookies', 1, time() + 17280000, '/', 'noree.bj', false, true );

echo true;