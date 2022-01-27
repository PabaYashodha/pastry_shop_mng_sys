<?php
include '../model/backUpModel.php';
$backupObj = new backUp(); // make backup obj

if (isset($_REQUEST["status"])) {
    $status = $_REQUEST["status"]; // get status
    switch($status){
        case "makeBackup":

            $tables = '*'; // all tables
            $setName = $backupObj->setName();
        
            //get all of the tables
            $tables = array();
            $result = $backupObj->showTables();
            while($row = $result->fetch_row()){
                $tables[] = $row[0];
            }
            
            $return = '';             
            foreach($tables as $table){ //cycle through
                $result = $backupObj->selectTables($table);
                $num_fields = $result->field_count;
                $num_rows = $result->num_rows;
                $return.= 'DROP TABLE IF EXISTS '.$table.';';
                $row1 = $backupObj->showCreatTable($table);
                $row2 = $row1->fetch_row();
                $return.= "\n\n".$row2[1].";\n\n";
                $counter = 1;
               
                for ($i = 0; $i < $num_fields; $i++){   // Over tables

                    while($row = $result->fetch_row()){ // Over rows
                        if($counter == 1){
                            $return.= 'INSERT INTO '.$table.' VALUES(';
                        } else{
                            $return.= '(';
                        }
                               
                        for($j=0; $j<$num_fields; $j++){  //Over fields                      
                            $row[$j] = addslashes($row[$j]);
                            $row[$j] = str_replace("\n","\\n",$row[$j]);
                            if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                            if ($j<($num_fields-1)) { $return.= ','; }
                        }
        
                        if($num_rows == $counter){
                            $return.= ");\n";
                        } else{
                            $return.= "),\n";
                        }
                        ++$counter;
                    }
                }
                $return.="\n\n\n";
            }

            //save file
            $fileName =  str_replace(' ', '', '../../backup/db-backup-'.date("D M j G-i-s T Y",time()).'-'.(md5(implode(',',$tables))).'.sql');
            $name =  str_replace(' ', '', '../../backup/db-backup-'.date("D M j G-i-s T Y",time()).'-'.(md5(implode(',',$tables))).'.sql');
            $handle = fopen($fileName,'w+'); // make file
            fwrite($handle,$return);  // write to the file 
            $backupObj->insertBackup($fileName,$name);   
            if(fclose($handle)){
                include_once '../../commons/email.php';
                $mail = new email(); // make email obj
            
                $cusEmail  = 'madushan71@gmail.com';
                $subject = date("Y-m-d").'system backup';
                $body = "system backup";
                $path = '../backup/'.$fileName;
            
                $mail->Send_Mail_attachment($cusEmail,$subject,$body,$path); //  send mail
            
                if($GLOBALS['mail']->send()){                           
                    $email_result= TRUE;                    
                    echo 1;              
                }else{
                    $email_result= FALSE;
                    ($GLOBALS['mail']->ErrorInfo());      
                    echo 2;
                }
            }else{
                echo 3;
                return false;
            }
        break;

        case "removeBackup":
            $backup_id = $_POST['backup_id'];
            $deBackup_id = base64_decode($backup_id);
            $backupRmvRes = $backupObj->removeBackup($deBackup_id);
            if ($backupRmvRes==1) {
                unlink($deBackup_id);  
                echo 1;           
            }else{
                echo 2;          
            }            
        break;

        case "restoreBackup":
            echo "happy";
            $file = $_FILES['backup'];
            $file = $_FILES['backup']['name'];
            $location = "../../backup/".$file;

            if (file_exists($location)) {
                $foreignKeyCheckOff = $backupObj->foreignKeyCheckOff();
                if ($result = $backupObj->showTables())
                {
                    while($row = $result->fetch_array())
                    {
                        $dropTable = $backupObj->dropTables($row[0]);
                    }
                }

                $sql = '';
                $error = '';


                $lines = file($location);

                foreach ($lines as $line) {

                    // Ignoring comments from the SQL script
                    if (substr($line, 0, 2) == '--' || $line == '') {
                        continue;
                    }
                    $sql .= $line;
                    set_time_limit(500);
                    if (substr(trim($line), - 1, 1) == ';') {
                        $result = $backupObj->restoreSql($sql);
                        if ($result!=1) {
                            $meg = 1;
                        }
                        else{
                           $meg = 2;
                        }
                        $sql = '';
                    }
                } // end foreach
            echo $meg;
            } // end if file exists
        break;
    }
}