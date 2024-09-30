<?php

use app\support\csrf;


function getToken()
{
    return csrf::getToken();
}