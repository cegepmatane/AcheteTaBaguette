<?php
function bool isValide(){
  if($_POST['password'] == $_POST['passwordCheck'])display();
  return false;
  $date = date_parse($_POST['date']);
  if(checkdate($date['day'],$date['month'],$date['year']))
  return false

}

?>
