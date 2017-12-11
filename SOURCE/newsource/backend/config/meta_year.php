<?php

$years = array();
for ($i = 1900; $i <= intval(date("Y")); $i++) {
    $years[$i] = $i;
}
return [
   'meta_year' => $years
];