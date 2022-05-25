<?php
function checkUser()
{
    if ($_SESSION['level'] == 2) {
        return true;
    } else {
        return false;
    }
}
