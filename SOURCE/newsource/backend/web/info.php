<?php

/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 10/12/2016
 * Time: 4:16 PM
 */
//phpinfo();
$txt = '[{"MTV":"ACT, FIT","5DMAX":"ACT, NEW, TOON"}]';
$arr = array();
$obj = json_decode($txt, true);
foreach ($obj as $k => $v) {
    foreach ($v as $k1 => $v1) {
        $a = explode(",",$v1);
//        var_dump($arr);
//        var_dump($a);
        $arr = array_merge($arr,$a);
    }
}
        var_dump($arr);
?>