<?php

include "config.php";

    $id = $_GET['1'];
    $screeninfo = hash('sha256', $_GET['2']);
    $hasjava = hash('sha256', $_GET['3']);
    $pluginlist = hash('sha256', $_GET['4']);
    $useragent = hash('sha256', $_GET['5']);
    $propertycount = hash('sha256', $_GET['6']);
    $webglinfo = hash('sha256', $_GET['7']);
    $permissions = hash('sha256', $_GET['8']);
    $ip = hash('sha256', $_GET['9']);
    $intent = $_GET['intent'];

    if($intent == "insert"){
        $sql_query = "INSERT IGNORE INTO `fingerprints` (`uid`, `screeninfo`, `hasjava`, `pluginlist`, `useragent`, `propertycount`, `webglinfo`, `permissions`, `ip`)  VALUES ('" . $id . "', '" . $screeninfo . "', '" . $hasjava . "', '" . $pluginlist . "', '" . $useragent . "', '" . $propertycount . "', '" . $webglinfo . "', '" . $permissions . "', '" . $ip . "')";
        $result = mysqli_query($con, $sql_query);
    }
    
    // Query for existing parameters
    if($intent == "query"){

        // If point limit is hit, same user already registered.
        $pointLimit = 90;

        $currentPoints = 0;

        $result = mysqli_query($con, "SELECT * FROM `fingerprints`");

        while ($row = mysqli_fetch_array($result)) {

            $currentPoints = 0;

            $rowid = $row['uid'];
            $rowscreeninfo = $row['screeninfo'];
            $rowhasjava = $row['hasjava'];
            $rowpluginlist = $row['pluginlist'];
            $rowuseragent = $row['useragent'];
            $rowpropertycount = $row['propertycount'];
            $rowwebglinfo = $row['webglinfo'];
            $rowpermissions = $row['permissions'];
            $rowip = $row['ip'];

            if($screeninfo == $rowscreeninfo){
                $currentPoints += 1;
                //echo "screeninfo | ";
            }
            if($hasjava == $rowhasjava){
                $currentPoints += 0.5;
                //echo "hasjava | ";

            }
            if($pluginlist == $rowpluginlist){
                $currentPoints += 1;
                //echo "pluginlist | ";

            }
            if($useragent == $rowuseragent){
                $currentPoints += 0.5;
                //echo "useragent | ";

            }
            if($propertycount == $rowpropertycount){
                $currentPoints += 3;
                //echo "propertycount | ";

            }
            if($webglinfo == $rowwebglinfo){
                $currentPoints += 3;
                //echo "webglinfo | ";

            }
            if($permissions == $rowpermissions){
                
                $currentPoints += 2;
                //echo "permissions | ";

            }
            if($ip == $rowip){
                $currentPoints += 5;
                //echo "ip | ";

            }

            // 16 points = max
            $pointPercentageResult = ($currentPoints / 16) * 100;

            if($pointPercentageResult > $pointLimit){

                echo "We know you are already registered on this site without logging in, we are tracking you based on your browser variables. Your similarity percentage is: " . $pointPercentageResult . "%";

                return;
            }
            
            if($pointPercentageResult < $pointLimit && $pointPercentageResult > 50){

                echo "There is a chance you are registered on our site due to our inbuilt tracker. Your similarity percentage is: " . $pointPercentageResult . "%";

                return;
            }
        }

        echo "You are not registered on our website. Similarity percentage: " . $currentPoints;
    }

?>