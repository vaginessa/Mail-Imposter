<?php
//Mail Imposter
//Created by: AutonomousHC
//August 6th 2014 11:30 PM - Created
//Last Update: October 2nd 2014 6:30 PM
//www.HackersHelpdesk.net

//This code is open to use, but please don't remove these comments, give the author some credit.


//Includes the file that defines the password. We keep it in a separate file so we may encrypt it using MD5.
include 'encryption.php';

$validpw = false;


if(!isset($_POST['password']) || $_POST['password'] == '')
{
$mail = '<div style="color:red">You will be asked for an encryption key provided to you by Autonomous. Without this, the impersonation will fail.</div>';
$validpw = false;
} elseif($_POST['password'] != PASSWORD)
{
$mail = '<div style="color:red">Invalid encryption key. You do not belong here.</div>';
$validpw = false;
} else {
$validpw = true;
}


if(isset($_POST['to']) && isset($_POST['from']) && isset($_POST['fromname']) && isset($_POST['replyto']) && isset($_POST['subject']) && isset($_POST['message']) && $validpw)
{
$headers = 'From: '.$_POST['fromname'].' <'.$_POST['from'].'>' . "\r\n" .
'Reply-To: '. $_POST['replyto'] . "\r\n";

$mail = mail($_POST['to'],$_POST['subject'],$_POST['message'],$headers);

if($mail)
{
$mail = '<div style="color:green">Impersonation Successful.</div>';
} else {
$mail = '<div style="color:red">Access Denied.</div>';
}
//Notifies end-user that a required field hadn't been completed.
} else {
if(!isset($mail))
{
$mail = '<div style="color:red">Leave no stone unturned.</div>';
}
}



?>
