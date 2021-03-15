<!DOCTYPE html>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Export File</title>

    <!-- CSS 3 EXTERNAL -->
    <link href="request_dark.css" id="rS" rel="stylesheet" type="text/css">

    <!-- TEST CSS -->
    <link href="test_dark.css" id="tS" rel="stylesheet" type="text/css">
    <!-- CSS FOR ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">

    <!-- JavaScript (INTERNAL) -->
    <script>

    var d = new Date();

    function swapStylesheet(sheet, name) 
    {
        document.getElementById(name).setAttribute('href', sheet);
    }

    if (d.getHours() >= 6 && d.getHours() < 18)
    {  
        swapStylesheet("request_bright.css", "rS");
        swapStylesheet("test_bright.css", "tS");
    }
    else
    {
        swapStylesheet("request_dark.css", "rS");
        swapStylesheet("test_dark.css", "tS");
    }

  </script>

  </head>

  <body>

    <button class="uiButtonOff" id="close" onclick="closePreview()">(X)</button>
    <div id="layer"></div>
    
    <!-- Top Bar Arc Structure -->
    <div id="topBar">

        <!-- <img class="icon" src="lotus_dark.png" style="left: 4%;width: 2.5em;"> -->

              <a class="linkA" href="test.html">Industry Partner Database</a>

              -> Search

              <!-- <img class="icon" id="searchIcon" src="search_dark.png"> -->

    </div>

     <form name="searchForm" action="" method="post">

          <div id="searchBarDiv">
             
            <button id="searchButtonIcon" type="submit">
              <i class="fa fa-search"></i>
            </button>
            
            <input type="text" name="searchBar" id="searchBar" placeholder="Search..."
            value="<?php if (isset($_POST["searchBar"])) echo $_POST['searchBar'] ?>">
          
          </div>

     </form>

     <div class="dashboard"></div>
    <!-- SEARCH SECTION -->

     <div id="searchResultsDiv">
        
        <div class="widget">

          <?php
           global $o;
          require "./connect.php";
          require_once "./global.php";

          $query = "nill";

          if (isset($_POST["searchBar"]))
          {
            $sql = "

          SELECT DISTINCT " . $insertSchema . ", Timestamp FROM Contacts WHERE False " .

          'OR UPPER(First_Name)     LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Last_Name)      LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Email)          LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Phone_Number)   LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(College)        LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Current_Status) LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Workplace)      LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(LinkedIn)       LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Notes)          LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Title)          LIKE UPPER(' . "'%{$_POST["searchBar"]}%')            
    
          ";

          $query = $sql;

          $result = $conn->query($sql);

          if ($result->num_rows > 0) 
          {
            if ($result->num_rows == 1) 
              echo '<h2 class="widgetTitle"> 1 Search Result for "' . $_POST["searchBar"] . '"</h2>';
            else
              echo '<h2 class="widgetTitle">' . $result->num_rows . ' Search Results for "' . $_POST["searchBar"] . '"</h2>';

            echo '<table class="dataTable">';
          }
          else
            echo '<h2 class="widgetTitle">Sorry, no results found for "' . $_POST["searchBar"] . '"</h2>';

          if ($result->num_rows > 0) 
          while($row = $result->fetch_assoc()) 
          {
            if($row["Prefix"] != "")
            {
              echo "<tr previewPair={$o}>";

              echo "<td>" . $row["First_Name"] . " " . $row["Last_Name"]  . "</td>";

              echo "<td>" . $row["Workplace"] . "</td>";

              echo "<td>" . $row["Title"] . "</td>";

              echo "<td>" . date('Y-m-d H:i:s', strtotime($row["Timestamp"])-21600) . "</td>";
              // echo "<td><button class=\"uiButton\">Details ></button></td>";
               $o++;
    
              echo "</tr>";
            }
          }
          // else
          //   echo "No results found";

          }


          ?>

        </table>
        
      </div>

       </div>   

       <!-- DOWNLOAD TEST -->

       <form name="searchForm" action="download.php" method="post">

          <div id="searchBarDiv" style="margin-top: 35%">
             
            <button id="searchButtonIcon" type="submit">
              Download
            </button>
            
            <input type="text" name="downloadName" id="downloadName" placeholder="Download...">

            <input style="display: none;" type="text" name="downloadContent" value="<?php echo $query ?>">
          
          </div>

     </form>

      <!-- RESULTS PREVIEW -->

      <?php

      if (isset($_POST["searchBar"]))
      {

      $sql = "

          SELECT DISTINCT " . $insertSchema . ", Timestamp FROM Contacts WHERE False " .

          'OR UPPER(First_Name)     LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Last_Name)      LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Email)          LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Phone_Number)   LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(College)        LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Current_Status) LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Workplace)      LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(LinkedIn)       LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Notes)          LIKE UPPER(' . "'%{$_POST["searchBar"]}%') " .
          'OR UPPER(Title)          LIKE UPPER(' . "'%{$_POST["searchBar"]}%')            
    
          ";

        $result = $conn->query($sql);

  if ($result->num_rows > 0) 
    while($row = $result->fetch_assoc()) 
    {
      if($row["Prefix"] != "")
      {
        echo "<div class=\"noPreview\" entryPair=\"{$o}\">";

        echo "<h2 class=\"previewTitle\">";
        echo $row["Prefix"] . '. ' . $row["First_Name"] . ' ' . $row["Last_Name"] . '</h2>';

        echo '<div class="previewSection">';
        echo $row["Title"] . '<br><br>';
        echo $row["Workplace"] . '<br><br>';
        echo 'LinkedIn : ' . $row["LinkedIn"] . '<br><br>';
        echo 'Current Status : ' . $row["Current_Status"] . '</div>';
    
        echo '<div class="previewSection"> Notes <br><br>' . $row["Notes"] . '</div>';

        echo '<div class="previewSection">Email : <a class="emailLink" href="mailto:' . $row["Email"] . '">' . $row["Email"] . '</a><br><br>';
        echo 'Phone : ' . $row["Phone_Number"] . '<br><br>';
        echo 'Timestamp : ' . date('Y-m-d H:i:s', strtotime($row["Timestamp"])-21600);

        echo '</div></div>';

        $o++;
      }
   }
 }

    ?>

    <script type="text/javascript">

      var scroll_Y = 0;

      function previewDiv(i)
      { 
        targets = document.getElementsByClassName('noPreview');

        for (var k = 0; k < targets.length; k++) 
          if (i == k)
          {
            scroll_Y = window.scrollY;

            //document.getElementsByClassName('widget')[0].style.opacity = "0";
            document.getElementsByClassName('dashboard')[0].style.position = "fixed";
            document.getElementsByClassName('dashboard')[0].style.width = "84%";

            targets[i].classList.add('preview');

            document.getElementById('layer').style.display = 'block';

            document.getElementById('close').classList.add('uiButtonOn');
            document.getElementById('close').classList.remove('uiButtonOff');
          }
      }

      function closePreview()
      {
        targets = document.getElementsByClassName('noPreview');

        for (var k = 0; k < targets.length; k++) 
            targets[k].classList.remove('preview');

          //document.getElementsByClassName('widget')[0].style.opacity = "1";
          document.getElementsByClassName('dashboard')[0].style.position = "relative";
          document.getElementsByClassName('dashboard')[0].style.width = "92%";

          window.scrollTo(0, scroll_Y);
          document.getElementById('layer').style.display = 'none';

          document.getElementById('close').classList.add('uiButtonOff');
          document.getElementById('close').classList.remove('uiButtonOn');
      }
      
      // entries = document.getElementsByTagName('tr');

      // for (var k = 0; k < entries.length; k++)
      //   entries[k].onmousedown = function() {previewDiv(k)};

      var rowIndex = 0;

      var tables = document.getElementsByClassName("dataTable");

      for (var f = 0; f < tables.length; f++) 
      { 
        var rows = tables[f].getElementsByTagName("tr");
      
         for (var i = 0; i < rows.length; i++) 
         {
            var currentRow = tables[f].rows[i];

            var createClickHandler = function(row, rowIndex) 
            {
              return function() 
              {
                previewDiv(rowIndex);
              };
            };

            currentRow.onclick = createClickHandler(currentRow, rowIndex);
            rowIndex++;
        }
      
  }
    </script>   

 <!-- SEARCH BAR GRAPHIC SCRIPT -->
 <script type="text/javascript">

  var d = new Date();
    
    document.getElementById('searchBar').onfocus = function() 
    {
      if (d.getHours() >= 6 && d.getHours() < 18)
      {  
        document.getElementById("searchBarDiv").style.backgroundColor = 'black';
        //document.getElementById("searchBarDiv").style.boxShadow = "none";
        document.getElementById("searchButtonIcon").style.boxShadow = "none";
      }
      else
      {
        document.getElementById("searchBarDiv").style.backgroundColor = 'white';
      }

      document.getElementById("searchBarDiv").style.padding = '0.7%';
      document.getElementById("searchBarDiv").style.paddingLeft = '1.3%';
      document.getElementById("searchBarDiv").style.margin = '-0.7%';
      document.getElementById("searchBarDiv").style.marginRight = '1.3%';
    };

    // CrossBrowserCompatible Method for FocusOut below
    document.getElementById('searchBar').addEventListener("focusout", onFocusOff);

    function onFocusOff() 
    {
      if (d.getHours() >= 6 && d.getHours() < 18)
      {  
        document.getElementById("searchBarDiv").style.backgroundColor = 'white';
        //document.getElementById("searchBarDiv").style.boxShadow = "0px 13px 26px rgb(200,200,200)";
        document.getElementById("searchButtonIcon").style.boxShadow = "0px 0px 13px rgb(200,200,200)";
      }
      else
      {
        document.getElementById("searchBarDiv").style.backgroundColor = 'rgb(25,25,25)';
      }
      document.getElementById("searchBarDiv").style.padding = '0%';
      document.getElementById("searchBarDiv").style.margin = '0%';
    };

 </script>

 <script type="text/javascript">
   document.body.style.animation = 'none';
   document.getElementById('topBar').style.animation = 'none';
   document.getElementById('searchResultsDiv').style.animationName = 'toplaunch';
   document.getElementById('searchResultsDiv').style.animationDelay = '0s';
   document.getElementById('searchResultsDiv').style.animationDuration = '0.5s';
 </script>

  </body>