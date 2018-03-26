<?php
/**
 * Created by PhpStorm.
 * User: charlesbartenbach
 * Date: 3/26/18
 * Time: 1:12 PM
 */


if(isset($_GET['logout']))
{
    session_destroy();
    header('location:index.php?logout=true');
    exit;
}
?>
