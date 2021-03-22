<?php

include "connect.php";
// Array to store all field ids from HTML

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

?>