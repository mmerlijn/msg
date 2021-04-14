<?php
$as = [
    ['v'=>"nul",'position'=>1],
    ['v'=>"een",'position'=>2],
    ['v'=>"twee",'position'=>3],
    ['v'=>"drie",'position'=>4],
];
function new_position(& $arr,$from,$to){
    $old = $arr[$from];
    unset($arr[$from]);
    array_splice($arr, $to,0,$old);
}

new_position($as, 2, 0);
new_position($as, $from, $to);
var_dump($as);
exit();
foreach ($as as $k=>$v){
    $p[] = ['old'=>$k,'val'=>$v,'new'=>null];
}
usort($p, function ($a, $b) {
    return strnatcasecmp($a['new'], $b['new']);
});



function new_positie(& $arr, $old, $new){
    $val = $arr[$old];
    unset($arr[$old]);
    array_splice($arr, $new,0,$val);
}
$as = ["nul", "een", "twee", "drie", "vier", "vijf", "zes"];
var_dump($as);


new_positie($as, 3, 5);
var_dump($as);
new_positie($as, 4,1);
var_dump($as);
exit();
$positions = [];
foreach ($as as $k => $woord) {
    $positions[$k] = ["key" => $k, "value" => $woord, "old" => $k + 1, "new" => "ZZ"];
}
//$positions[2]['new']=2;
$positions[3]['new'] = 5;
$positions[4]['new'] = 1;
//$positions[0]['new']=0;


usort($positions, function ($a, $b) {
    return strnatcasecmp($a['new'], $b['new']);
});
var_dump($positions);

$new = [];
foreach ($positions as $position) {
    if ($position['new'] !== "ZZ") {
        $replacement = $as[$position['key']];
        unset($as[$position['key']]);
        array_splice($as, $position['new'], 0, $replacement);
    }
    break;
}
var_dump($as);



//var_dump($positions);