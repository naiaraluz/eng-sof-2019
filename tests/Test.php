<?php

require_once('../vendor/autoload.php');
require_once('../Model/Prospect.php');

use Model\Prospect;
use PHPUnit\Framework\TestCase;

$prospect = new Prospect();
$prospects[] = $prospect->buscarProspect('email2');
$prospect = $prospects[0];

echo $prospect[0]['email'];

print_r($prospect);

?>