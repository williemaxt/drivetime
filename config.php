<?php
/**
 * Created by PhpStorm.
 * User: charlesbartenbach
 * Date: 3/28/18
 * Time: 10:13 PM
 */

require_once('vendor/autoload.php');

$stripe = array(
    "secret_key"      => "9PyrNgAkYffqfvViseLNf4Sa",
    "publishable_key" => "SF7SVH5ZE1Q3snDwNfCrAoWg"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>

