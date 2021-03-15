<?php
$server   =            "localhost"; 
$user     = "id15084806_teamlotus";  
$password =     "SlZ}Df1?-NeUt?>/";    
$filename =        "Industry Data";    

$sql = "SELECT * FROM Contacts";

$conn = mysqli_connect($server, $user, $password, "id15084806_main_database");

if (!$conn) 
  die("Connection failed: " . mysqli_connect_error());

if (isset($_POST["searchContent"]) && $_POST["searchContent"] != "")
{
    $filename = $_POST["searchContent"];

    if (isset($_POST["fileName"]) && $_POST["fileName"] != "") 
    {
        $filename = $_POST["fileName"];
    }

    $sql = "

          SELECT DISTINCT * FROM Contacts WHERE False " .

          'OR UPPER(First_Name)     LIKE UPPER(' . "'%{$_POST["searchContent"]}%') " .
          'OR UPPER(Last_Name)      LIKE UPPER(' . "'%{$_POST["searchContent"]}%') " .
          'OR UPPER(Email)          LIKE UPPER(' . "'%{$_POST["searchContent"]}%') " .
          'OR UPPER(Phone_Number)   LIKE UPPER(' . "'%{$_POST["searchContent"]}%') " .
          'OR UPPER(College)        LIKE UPPER(' . "'%{$_POST["searchContent"]}%') " .
          'OR UPPER(Current_Status) LIKE UPPER(' . "'%{$_POST["searchContent"]}%') " .
          'OR UPPER(Workplace)      LIKE UPPER(' . "'%{$_POST["searchContent"]}%') " .
          'OR UPPER(LinkedIn)       LIKE UPPER(' . "'%{$_POST["searchContent"]}%') " .
          'OR UPPER(Notes)          LIKE UPPER(' . "'%{$_POST["searchContent"]}%') " .
          'OR UPPER(Title)          LIKE UPPER(' . "'%{$_POST["searchContent"]}%')            
    
        ";
}

    $result = $conn->query($sql);

    $file_ending = "xls";

    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment; filename=$filename.xls");  
    header("Pragma: no-cache"); 
    header("Expires: 0");

    $flag = false;

    while ($row = $result->fetch_assoc()) 
    {
        if (!$flag) 
        {
            echo implode("\t", array_keys($row)) . "\r\n";
            $flag = true;
        }

        $copy = array_values($row);

        for ($i=0; $i < count($copy); $i++) 
        { 
            $copy[$i] = str_replace("\r\n", "", $copy[$i]);
            $copy[$i] = str_replace("\r\t", "", $copy[$i]);
            $copy[$i] = str_replace("\n", "", $copy[$i]);
            $copy[$i] = str_replace("\t", "", $copy[$i]);
        }

        echo implode("\t", $copy) . "\r\n";
    }

?>