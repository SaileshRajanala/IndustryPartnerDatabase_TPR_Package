<!DOCTYPE html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Industry Partner Database</title>

  <!-- CSS 3 (EXTERNAL) -->
  <link href="submit_dark.css" id="sS" rel="stylesheet" type="text/css">
  <link href="mobile_dark.css" id="sS" rel="stylesheet" type="text/css">
  <!-- Font (Google Fonts) -->
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">

  <!-- JavaScript (INTERNAL) -->
  <script>
    var d = new Date();

function swapStylesheet(sheet, name) {
   document.getElementById(name).setAttribute('href', sheet);
}
    if (d.getHours() >= 6 && d.getHours() < 18)
    {
        swapStylesheet("submit_bright.css", "sS");
        swapStylesheet("mobile_bright.css", "mS");
    }
    else
    {
        swapStylesheet("submit_dark.css", "sS");
        swapStylesheet("mobile_dark.css", "mS");
    }
  </script>

</head>

<body style="font-family: 'Quicksand'">

  <?php

require "./connect.php";
require_once "./global.php";
 $prefix         = $_POST["prefix"];
 $first_name     = $_POST["first_name"];
 $last_name      = $_POST["last_name"];
 $email          = $_POST["email"];
 $phone_number   = $_POST["phone_number"];
 $college        = $_POST["college"];
 $current_status = $_POST["current_status"];
 $linkedin       = $_POST["linkedin"];
 $workplace      = $_POST["workplace"];
 $position       = $_POST["title"];
 $notes          = $_POST["notes"];


$char = array("'","<",">");
$replace = array("\'","&lt","&gt;");

 $prefix         = str_replace($char,$replace,$prefix);
 $first_name     = str_replace($char,$replace,$first_name);
 $last_name      = str_replace($char,$replace,$last_name);
 $email          = str_replace($char,$replace,$email);
 $phone_number   = str_replace($char,$replace,$phone_number);
 $college        = str_replace($char,$replace,$college);
 $current_status = str_replace($char,$replace,$current_status);
 $linkedin       = str_replace($char,$replace,$linkedin);
 $workplace      = str_replace($char,$replace,$workplace);
 $position       = str_replace($char,$replace,$position);
 $notes          = str_replace($char,$replace,$notes);




$htmlFields1 = [$prefix];

array_push($htmlFields1, $first_name);
array_push($htmlFields1, $last_name);
array_push($htmlFields1, $email);
array_push($htmlFields1, $phone_number);
array_push($htmlFields1, $college);
array_push($htmlFields1, $current_status);
array_push($htmlFields1, $linkedin);
array_push($htmlFields1, $workplace);
array_push($htmlFields1, $position);
array_push($htmlFields1, $notes);










$htmlFields = ["prefix"];

array_push($htmlFields, "first_name");
array_push($htmlFields, "last_name");
array_push($htmlFields, "email");
array_push($htmlFields, "phone_number");
array_push($htmlFields, "college");
array_push($htmlFields, "current_status");
array_push($htmlFields, "linkedin");
array_push($htmlFields, "workplace");
array_push($htmlFields, "title");
array_push($htmlFields, "notes");

// Array to store all columns from SQL











$tableColumns = ["Prefix"];

array_push($tableColumns, "First_Name");
array_push($tableColumns, "Last_Name");
array_push($tableColumns, "Email");
array_push($tableColumns, "Phone_Number");
array_push($tableColumns, "College");
array_push($tableColumns, "Current_Status");
array_push($tableColumns, "LinkedIn");
array_push($tableColumns, "Workplace");
array_push($tableColumns, "Title");
array_push($tableColumns, "Notes");

// Insert Schema Automation below
$insertSchema = "Prefix";

for ($i = 1; $i < count($tableColumns); $i++)
  $insertSchema .= ", " . $tableColumns[$i];











// $valueSchema = "'{$_REQUEST["prefix"]}'";

// for ($i = 1; $i < count($htmlFields); $i++)
//   $valueSchema .= ", " . "'{$_POST["" . $htmlFields[$i] . ""]}'";





//Above was global php file data





// Submission variable
$submission = FALSE;

// Value Schema
//$valueSchema = "'{$_POST["prefix"]}'";
$valueSchema = "'{$prefix}'";
str_replace("'", "\'", $prefix);

//for ($i = 1; $i < count($htmlFields); $i++)
//  $valueSchema .= ", " . "'{$_POST["" . $htmlFields[$i] . ""]}'";

for ($i = 1; $i < count($htmlFields1); $i++){
   
  $valueSchema .= ", " . "'{$htmlFields1[$i]}'";
}
//$valueSchema = str_replace(array('\'', '"'), '', $valueSchema); 
//$valueSchema = str_replace("'", "b", $valueSchema);


//TESTinggg
$checkValidity = true ;

 if(is_numeric($prefix)){
        echo "Sorry, your Prefix cannot be a number <br>" ;
        $checkValidity = false ;
    }
    // if(is_numeric($first_name)){
    //     echo "Sorry, your First Name cannot be a number <br>" ;
    //       $checkValidity = false ;
    // }
    if(!ctype_alpha($first_name)){
        echo "Sorry, your First Name cannot be alphanumeric. <br>" ;
          $checkValidity = false ;
    }
    // if(is_numeric($last_name)) {
    //     echo "Sorry, your Last Name cannot be a number <br>" ;
    //       $checkValidity = false ;
    // }
    if(!ctype_alpha($last_name)){
        echo "Sorry, your Last Name cannot be alphanumeric. <br>" ;
          $checkValidity = false ;
    }
    if(is_numeric($email)){
        echo "Sorry, your Email cannot be a number <br>" ;
          $checkValidity = false ;
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     echo  "Invalid email format </br>";
     $checkValidity = false ;
    }
    if(!is_int((int)$phone_number) || strlen($phone_number) != 10){
        echo "Please enter valid phone number <br>" ;
          $checkValidity = false ;
    }
    if(is_numeric($college)){
        echo "Sorry, your College cannot be a number <br>" ;
          $checkValidity = false ;
    } 
    if(is_numeric($current_status)){
        echo "Sorry, your Current Status cannot be a number <br>" ;
          $checkValidity = false ;
    } 
    if(is_numeric($linkedin)){
        echo "Sorry, your Linkedin cannot be a number <br>" ;
          $checkValidity = false ;
    }
    if(is_numeric($workplace)){
        echo "Sorry, your Workplace cannot be a number <br>" ;
          $checkValidity = false ;
    } 
    if(is_numeric($position)){
        echo "Sorry, your Position cannot be a number <br>" ;
          $checkValidity = false ;
    }
   
$sql = "

INSERT INTO 
Contacts (" . $insertSchema . ")
VALUES   (" . $valueSchema  . ");

";

   
if($checkValidity){
 

if (mysqli_query($conn, $sql) and $checkValidity) 
{
    
  $submission = TRUE;
 // echo " submitted";
}elseif($checkValidity) {
    
     echo "Sorry some informations entered were not valid, Please go back and enter valid information. Thank You" ;
  //echo "Error updating record: " . mysqli_error($conn);
}
}
  ?>
    
  <div id="thankYou">
    <?php

    if ($submission){
      echo "Thank you for your submission.";
    }

    ?>

  </div>
  
  <?php 
     if ($submission){
      echo "<div class=\"summary\">" ;
    } else {
        echo " <div class=\"summary\" style=\"display:none;:\">" ;
    }
    
  ?>

 

    <h2>Here's your Summary.</h2>

    <table class="summaryTable">
      
      <?php

      if ($submission){
        for ($i = 0; $i < count($tableColumns); $i++)
          echo "<tr><td>" . $tableColumns[$i] . "
              </td><td> $htmlFields1[$i]</td></tr>";
      }

      ?>

    </table>

  </div>

  </body>

<?php

// include "connect.php";

// // Variables below store html form data 

// $prefix         = $_POST["prefix"];
// $first_name     = $_POST["first_name"];
// $last_name      = $_POST["last_name"];
// $email          = $_POST["email"];
// $phone_number   = $_POST["phone_number"];
// $college        = $_POST["college"];
// $current_status = $_POST["current_status"];
// $linkedin       = $_POST["linkedin"];
// $workplace      = $_POST["workplace"];
// $position       = $_POST["position"];
// $notes          = $_POST["notes"];

// Variables below store MySQL Syntax 


// if (mysqli_query($conn, $sql)) 
// {
//   echo "<center><h1 class=\"submitMessage\"> Thank you for <br> your entry.</h1>";
// } 
// else 
// {
//   echo "Error updating record: " . mysqli_error($conn);
// }

?>
