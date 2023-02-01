<?php

if(time() - filemtime('astdb.txt') >= 60*60*24 ) { file_put_contents('astdb.txt', file_get_contents('https://allstarlink.org/cgi-bin/allmondb.pl')); }

$webhookurl = "[YOUR DISCORD WEBHOOK URL]";

 $t = $_GET["t"];
$n1 = $_GET["n1"];
$n2 = $_GET["n2"];

if ((isset($t)) && (isset($n1)) && (isset($n2))) {

if ($n2 == 0) { $nName = "\u{260E}"; }

if (($n2 > 0) && ($n2 <= 1999)) { $nName = $n2; }

if ($t == 0) { $type = "\u{274C}"; }
if ($t == 1) { $type = "\u{2705}"; }

if ($n2 > 1999) {

    $search = $n2 . '|';
    $lines = file('astdb.txt');
    $found = false;
    foreach($lines as $line){
        if(strpos($line, $search) === 0)
            {$found = true;
            $str2 = str_replace("||", " ", $line);
            $nName = str_replace("|", " ", $str2);}
        if(!$found){$nName = "$n2 not in database"; }}}

$msg = "$type $n1 to $nName";

$json_data = json_encode([

    "avatar_url" => "https://icons.iconarchive.com/icons/martz90/hex/128/radio-icon.png",
    "username" => "allstar-notify",
    "content" => "$msg",

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );

echo $msg . "\n";

curl_close( $ch ); }

else echo "missing variable";

?>
