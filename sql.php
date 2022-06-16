<?php 
set_time_limit(0);
error_reporting(0);
echo "
   _____       _   _____       _           _   _                _____                                 
  / ____|     | | |_   _|     (_)         | | (_)              / ____|                                
 | (___   __ _| |   | |  _ __  _  ___  ___| |_ _  ___  _ __   | (___   ___ __ _ _ __  _ __   ___ _ __ 
  \___ \ / _` | |   | | | '_ \| |/ _ \/ __| __| |/ _ \| '_ \   \___ \ / __/ _` | '_ \| '_ \ / _ \ '__|
  ____) | (_| | |  _| |_| | | | |  __/ (__| |_| | (_) | | | |  ____) | (_| (_| | | | | | | |  __/ |   
 |_____/ \__, |_| |_____|_| |_| |\___|\___|\__|_|\___/|_| |_| |_____/ \___\__,_|_| |_|_| |_|\___|_|   
            | |              _/ |                                                                     
            |_|             |__/                                                                      
[*]-----------------------------------------------------------------------[*]
[+] Tool                 : Sql Injection Scanner PHP Script
[+] Coded By             : miral
[*]-----------------------------------------------------------------------[*]
";
     print "\nUsage : php sql.php | [~] You must create 'sites.txt' To work Tool ...\n";
 
function save($get){
        $s0w = fopen("result.txt","a+");
        fwrite($s0w,"$get\n");
        fclose($s0w);
}
$s0w = @file_get_contents($argv{1});
$url = @file_get_contents ("sites.txt");
$ex = "%27";
        
if(!file_exists("sites.txt")) {
    
   die("\n[-] Couldn't find "." sites.txt" ."\n" ."Please Make it To run Script..\n");
}
 
if(isset($s0w)){
    
        echo "\n";
        echo "\n[+] Scanner/Exploit Running ~\n";
        echo "\n+++++++++++++++++++++++++++++++++++++"; 
        echo "\n";  
        
$exploits = explode("\n", $url);
foreach ($exploits as $exploit){    
$exploit = @trim($exploit);
$get = $exploit.$ex;
        
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $get);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result =curl_exec($ch);
curl_close($ch);
        
$errors = array (
'You have an error in your SQL syntax;','Warning: mysql_fetch_array',
'supplied argument is not a valid MySQL result resource in','There was an error querying the database.',
'Warning: mysql_fetch_row():','Division by zero in',
'Call to a member function','Microsoft JET Database','Microsoft OLE DB Provider for SQL Server',
'Unclosed quotation mark','Microsoft OLE DB Provider for Oracle',
'Incorrect syntax near','SQL query failed',
'mysql_fetch_object()','argument is not a valid MySQL|Syntax error',
'Fatal error','mysql_num_rows()',
'execute query','mysql_num_rows()',
'mysql_error','error'
);
 
foreach ($errors as $error) {
if (eregi($error, $result)){
    echo "\n[+] SQL Found => $get\n";
    echo "\n";
save($get);
break 1;
        }else{      
        echo "\n";  
        echo "\n-------------------------------------------------------------------";
        echo "\n[-] Not Found => $exploit\n";
        echo "\n[*] Result Save in result.txt\n";
break 3;
    }
    }
    }
break 2;
}
?>