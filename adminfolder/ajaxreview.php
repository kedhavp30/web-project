<?php
$pid = $_POST['pid'];
$cid = $_POST['cid'];
$postedOn = $_POST['postedOn'];
 require_once "includes/db_connect.php";
 $sUpdate = "   UPDATE review SET flag = 0, ban = 1 WHERE productId=$pid AND postedOn='$postedOn' AND customerid=$cid";
 #echo "<br/>Update statement: ".$sUpdate."<br/>";
        $updateResult = $conn->exec($sUpdate) ;
        if($updateResult)
        {
        $Msg = "Record Updated!";
        }else{
        $Msg = "ERROR: Record could not be updated!";
        }
        echo $Msg;

?>