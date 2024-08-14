<?php

require __DIR__ . "/../lib_ext/autoload.php";

use Notification\App\Email;

$novoEmail = new Email();
$novoEmail->sendEmail(
    "",
    "", 
    "", 
    "", 
    "", 
    ""
);

// echo "<pre>", print_r($novoEmail), "</pre>";