<?php

function IsAdminLogedIn()
{
    return isset($_SESSION['adminLogged']) && $_SESSION['adminLogged'];
}