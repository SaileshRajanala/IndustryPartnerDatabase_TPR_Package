<!DOCTYPE html>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Industry Partner Database</title>

    <!-- CSS 3 EXTERNAL -->
    <link href="request_dark.css" id="rS" rel="stylesheet" type="text/css">
    <link href="test_dark.css" id="tS" rel="stylesheet" type="text/css">
    <link href="export_dark.css" id="eS" rel="stylesheet" type="text/css">
    <link href="help_dark.css" id="hS" rel="stylesheet" type="text/css">
    <link href="mobile_dark.css" id="mS" rel="stylesheet" type="text/css">

    <!-- CSS FOR ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- ICONS SCRIPT -->
    <script src="https://kit.fontawesome.com/a104d25a3e.js" crossorigin="anonymous"></script>

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
        swapStylesheet("export_bright.css", "eS");
        swapStylesheet("help_bright.css", "hS");
        swapStylesheet("mobile_bright.css", "mS");
    }
    else
    {
        swapStylesheet("request_dark.css", "rS");
        swapStylesheet("test_dark.css", "tS");
        swapStylesheet("export_dark.css", "eS");
        swapStylesheet("help_dark.css", "hS");
        swapStylesheet("mobile_dark.css", "mS");
    }

  </script>

  </head>

  <body>

    <button class="uiButtonOff" id="close" onclick="closePreview()"> 
      Close <i id="closeLinkIcon" class='far fa-times-circle'></i>
    </button>

    <div id="layer"></div>
    
    <!-- Top Bar Arc Structure -->
    <div id="topBar">

        <form method="POST" action="test.php">
        <button type="submit" class="linkB" id="homeNavButton" style="float: left">
           Industry Partner Database</button>
         </form>

          <button id="helpNavButton" class="linkB" style="float: right">
            <span class="navLabel">Help</span> <i id="helpNavIcon" class='far fa-question-circle'></i></button>

          <!-- <button class="linkB" style="float: right">
            Close <i id="closeLinkIcon" class='far fa-times-circle'></i></button> -->

          <button id="exportNavButton" class="linkB" style="float: right">
            <span class="navLabel">Export</span> <i id="exportNavIcon" class='fas fa-arrow-circle-down'></i></button>

          <button id="searchNavButton" class="linkB" style="float: right">
            <span class="navLabel">Search</span> <i id="searchNavIcon" class='fab fa-sistrix'></i></button>

    </div>

    <!-- TOP BAR MOBILE START -->
      <!-- <script type="text/javascript" src="topBarMobileScript.js"></script> -->
      <!-- TOP BAR MOBILE END -->
      
      <!-- SEARCH BAR -->
      <form name="searchForm" action="search.php" method="POST">

          <div id="searchBarDiv">
             
            <button id="searchButtonIcon" type="submit">
              <i class="fa fa-search"></i>
            </button>
            
            <input type="text" name="searchBar" id="searchBar" placeholder="Search...">
            
          </div>

     </form>


     <!-- EXPORT DIV START -->

    <div id="exportDiv" class="alertDiv">

      <h1>Export everything</h1>

      <form action="exportAll.php" method="POST">
          <label>Download as </label>
          <input type="fileName" id="fileName" name="fileName" placeholder="Industry Data">

          <button class="downloadButton" type="submit">
           <i id="exportNavIcon" class='fas fa-arrow-circle-down'></i>
         </button>
      </form>
      
    </div>

    <script type="text/javascript">

    var d = new Date();
    var downloadIcons = document.getElementsByClassName("downloadIcon");

    if (d.getHours() >= 6 && d.getHours() < 18)
    {  
        for (var i = downloadIcons.length - 1; i >= 0; i--) {
          downloadIcons[i].src = "download_bright.png";
        }
    }
    else
    {
        for (var i = downloadIcons.length - 1; i >= 0; i--) {
          downloadIcons[i].src = "download_dark.png";
        }    
    }

    </script>

    <!-- EXPORT DIV END -->

    <!-- EXPORT DIV FUNCTIONALITY SCRIPT START -->
    <script type="text/javascript" src="exportScript.js"></script>
    <!-- EXPORT DIV FUNCTIONALITY SCRIPT END -->

    <div class="dashboard">

        <div class="widget" id="todaySummary">
          <h1 class="widgetTitle" id="greeting"></h1>
        <!-- TODAY PHP SCRIPT START -->

          <?php
          
          global $o;
          global $newEntriesToday;

          $newEntriesToday = False;

          require "./connect.php";
          require_once "./global.php";

          $sql = "SELECT " . $insertSchema . ", Timestamp FROM Contacts WHERE DATE(CONVERT_TZ(`Timestamp`,'+00:00','-06:00')) = DATE(CONVERT_TZ(CURRENT_TIMESTAMP(),'+00:00','-06:00')) ORDER BY Timestamp DESC";
          
          $result = $conn->query($sql);
          $o = 0;

        if ($result->num_rows > 0)
        {
          $newEntriesToday = True; // There are new entries for the day.

          echo '<p style="margin-left: 2.5%"><b>';
          echo $result->num_rows;

          if ($result->num_rows == 1) 
            echo '</b> new entry today.</p>';
          else
            echo '</b> new entries today.</p>';
          
          echo '<h1 class="widgetTitle">Today\'s Entries</h1>';
          echo '<table class="dataTable">';

          while($row = $result->fetch_assoc()) 
          {
            if($row["Prefix"] != "")
            {
              echo "<tr previewPair={$o}>";

              echo "<td>" . $row["First_Name"] . " " . $row["Last_Name"]  . "</td>";

              echo "<td>" . $row["Workplace"] . "</td>";

              echo "<td>" . $row["Title"] . "</td>";

              // echo "<td><button class=\"uiButton\">Details ></button></td>";

              echo "<td>" . date('Y-m-d H:i:s', strtotime($row["Timestamp"])-21600) . "</td>";
               $o++;
     
              echo "</tr>";
            }
          }
          echo "</table>";

        }
        else // No entries for today
        {
          echo '<p style="margin-left: 2.5%">No new entries yet, today.</p>';
        }

        ?>

      <!-- TODAY PHP SCRIPT END -->
      </div>

      <!-- GREETING SCRIPT START -->
        <script type="text/javascript">
          
          d = new Date();

          if (d.getHours() >= 18)
            document.getElementById('greeting').innerHTML = "Good Evening! <i class='fas fa-moon'></i>";
          else if (d.getHours() >= 12)
            document.getElementById('greeting').innerHTML = "Good Afternoon! <i class='fas fa-sun'></i>";
          else if (d.getHours() >= 3)
            document.getElementById('greeting').innerHTML = "Good Morning! <i class='fas fa-sun'></i>";
          else
            document.getElementById('greeting').innerHTML = "Good Night! <i class='fas fa-moon'></i>";

        </script>
        <!-- GREETING SCRIPT END -->

        <!-- OLDER ENTRIES -->

          <?php

          $sql = "SELECT " . $insertSchema . ", Timestamp FROM Contacts WHERE DATE(CONVERT_TZ(`Timestamp`,'+00:00','-06:00')) != DATE(CONVERT_TZ(CURRENT_TIMESTAMP(),'+00:00','-06:00')) ORDER BY Timestamp DESC";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) 
          {
            echo "<div class='widget'>";
            echo '<h1 class="widgetTitle">';

            if ($newEntriesToday) 
              echo 'Older Entries <i class="far fa-calendar-alt"></i>';
            else
              echo "All Entries <i class='far fa-list-alt'></i>";

            echo '</h1><table class="dataTable">';
          
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
          echo "</table></div>";
        }
          ?>    

      <div class="widget">

        <h1 class="widgetTitle">Information <i class='fas fa-info-circle'></i></h1>

          <?php

          $sql = "SELECT * FROM Contacts";

          $result = $conn->query($sql);

          echo "<p style='margin-left: 2.5%'>Total number of records = <b>";
          echo $result->num_rows;
          echo "</b>";

          ?>

          <p style='margin-left: 2.5%'>Version <b>4.7 RS</b></p>
          <p style='margin-left: 2.5%'>Copyright <i class='far fa-copyright'></i> 2020-2021. <b>Team Lotus.</b> </p>

      </div>

    </div>

    <!-- Previews -->

    <?php

      $sql = "SELECT " . $insertSchema . ", Timestamp FROM Contacts WHERE DATE(CONVERT_TZ(`Timestamp`,'+00:00','-06:00')) = DATE(CONVERT_TZ(CURRENT_TIMESTAMP(),'+00:00','-06:00')) ORDER BY Timestamp DESC";

        $result = $conn->query($sql);

        $o = 0;

  if ($result->num_rows > 0) 
    while($row = $result->fetch_assoc()) 
    {
      if($row["Prefix"] != "")
      {
        echo "<div class=\"noPreview\" entryPair=\"{$o}\">";

        echo "<h2 class=\"previewTitle\">";
        echo $row["Prefix"] . '. ' . $row["First_Name"] . ' ' . $row["Last_Name"] . ' <i class="far fa-address-card" style="float:right;margin-right:4%;"></i></h2>';

        echo '<div class="previewSection">';
        echo $row["Title"] . '<br><br>';
        echo $row["Workplace"] . '<br><br>';
        echo 'LinkedIn : ' . $row["LinkedIn"] . '<br><br>';
        echo 'Current Status : ' . $row["Current_Status"] . '</div>';
    
        echo '<div class="previewSection"> Notes <i style="float:right;" class="far fa-sticky-note"></i> <br><br>' . $row["Notes"] . '</div>';

        echo '<div class="previewSection"><i class="far fa-envelope"></i>  Email : <a class="emailLink" href="mailto:' . $row["Email"] . '">' . $row["Email"] . '</a><br><br>';
        echo '<i class="fas fa-phone-alt"></i> Phone : ' . $row["Phone_Number"] . '<br><br>';
        echo '<i class="far fa-clock"></i> Timestamp : ' . date('Y-m-d H:i:s', strtotime($row["Timestamp"])-21600);

        echo '</div></div>';

        $o++;
      }
   }

    ?>

    <?php

      $sql = "SELECT " . $insertSchema . ", Timestamp FROM Contacts WHERE DATE(CONVERT_TZ(`Timestamp`,'+00:00','-06:00')) != DATE(CONVERT_TZ(CURRENT_TIMESTAMP(),'+00:00','-06:00')) ORDER BY Timestamp DESC";

        $result = $conn->query($sql);

  if ($result->num_rows > 0) 
    while($row = $result->fetch_assoc()) 
    {
      if($row["Prefix"] != "")
      {
        echo "<div class=\"noPreview\" entryPair=\"{$o}\">";

        echo "<h2 class=\"previewTitle\">";
        echo $row["Prefix"] . '. ' . $row["First_Name"] . ' ' . $row["Last_Name"] . ' <i class="far fa-address-card" style="float:right;margin-right:4%;"></i></h2>';

        echo '<div class="previewSection">';
        echo $row["Title"] . '<br><br>';
        echo $row["Workplace"] . '<br><br>';
        echo 'LinkedIn : ' . $row["LinkedIn"] . '<br><br>';
        echo 'Current Status : ' . $row["Current_Status"] . '</div>';
    
        echo '<div class="previewSection"> Notes <i style="float:right;" class="far fa-sticky-note"></i> <br><br>' . $row["Notes"] . '</div>';

        echo '<div class="previewSection"><i class="far fa-envelope"></i>  Email : <a class="emailLink" href="mailto:' . $row["Email"] . '">' . $row["Email"] . '</a><br><br>';
        echo '<i class="fas fa-phone-alt"></i> Phone : ' . $row["Phone_Number"] . '<br><br>';
        echo '<i class="far fa-clock"></i> Timestamp : ' . date('Y-m-d H:i:s', strtotime($row["Timestamp"])-21600);

        echo '</div></div>';
        $o++;
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

    <!-- SEARCH SCRIPT -->
    <script type="text/javascript" src="searchBarScript.js"></script>

    <!-- HELP DIV START -->

    <div id="helpDiv">

      <h1>Help?</h1>

      <div class="helpArticle">

        <h2>Navigating Around < > </h2>
        
        <ul>
          <li>You can always return <b>home</b> by clicking the <br><br>
            <b>"Industry Partner Database"</b> <br><br> 
            link on the top middle of the screen
          </li>
            <br>

          <li>
            You can click on a record to access its full details
            <br>
            
            <br>
            You can click the <b>(X)</b> button to dismiss a record's preview
          </li>
          <br>

          <li>
            You can use the <b>Search Icon</b> on the top right corner to search for records.
            <br><br>
            <img class="helpSearchIcon" src="search_bright.png" width="35px">
          </li>
          <br>
          
          <li>
            You can use the <b>Download Icon</b> on the top left corner to export data.
            <br><br>
            <img class="helpDownloadIcon" src="download_bright.png" width="35px">
          </li>
          <br>

          <li>
            You can click the <b>Close Icon</b> to dismis either Search or Export operations.
            <br><br>
            <img class="helpCloseIcon" src="close_bright.png" width="35px">
          </li>
          <br>
        </ul>

      </div>

      <div class="helpArticle">

        <h2>Search?</h2>
        
        <p></p>

        <ul>
          <li>To start a search, click the <b>Search Icon</b> on the top right corner<br><br>
            <img class="helpSearchIcon" src="search_bright.png" width="35px">
          </li>
          <br>

          <li>
            To dismiss the search operation, click the <b>Close Icon</b>
            <br><br>
            <img class="helpCloseIcon" src="close_bright.png" width="35px">
          </li>
          <br>

          <li>
            To search for something, type it in the <b>Search Bar</b> <br><br> 
            Click the <b>Search Icon</b> <br><b>
            or </b><br> 
            Press the <b>"Enter"</b> key
          </li>
          <br>

          <li>To go back and view all records, click the <br><br>
            <b>"Industry Partner Database"</b> <br><br> 
            link on the top middle of the screen
          </li>
          <br>

        </ul>

      </div>

      <div class="helpArticle">

        <h2>Export all records?</h2>

        <p>
          You can download data 
          as an Excel Spreadsheet 
          <br><br> 
          Format : <b>.xls</b>
        </p>

        <ul>
          <li>
          To export all data,<br> click the <b>Downlaod Icon</b> on the top left corner<br><br>
            <img class="helpDownloadIcon" src="download_bright.png" width="35px">
          </li>
          <br>

          <li>
            To dismiss the export operation,<br> click the <b>Close Icon</b>
            <br><br>
            <img class="helpCloseIcon" src="close_bright.png" width="35px">
          </li>
          <br>

          <li>
           By default, the downloaded file is named as 
           <br><br>
           <b>"Industry Data.xls"</b>
           <br><br>
           You can rename it by typing the desired file name in the text box
          </li>
          <br>

          <li>
            Click the <b>Downlaod Icon</b> to download the file<br><br>
            <img class="helpDownloadIcon" src="download_bright.png" width="35px">
          </li>
          <br>

        </ul>

      </div>

      <div class="helpArticle">

        <h2>Export only Search Results?</h2>
        
        <p>
          You can download data 
          as an Excel Spreadsheet 
          <br><br> 
          Format : <b>.xls</b>
        </p>

        <ul>

          <li>
          To export only the search data, <br> you need to perform a search by clicking the <b>Search Icon</b> on the top right corner<br><br>
            <img class="helpSearchIcon" src="search_bright.png" width="35px">
          </li>
          <br>

          <li>
           To export the search resutls,<br> click the <b>Downlaod Icon</b> on the top left corner<br><br>
            <img class="helpDownloadIcon" src="download_bright.png" width="35px">
          </li>
          <br>

          <li>
            To dismiss the export operation,<br> click the <b>Close Icon</b>
            <br><br>
            <img class="helpCloseIcon" src="close_bright.png" width="35px">
          </li>
          <br>

          <li>
           To rename the download file, <br>type the desired file name in the text box
          </li>
          <br>

          <li>
            Click the <b>Downlaod Icon</b> to download the file<br><br>
            <img class="helpDownloadIcon" src="download_bright.png" width="35px">
          </li>
          <br>

        </ul>

      </div>

      <div class="helpArticle" id="fontSizeHelpArticle">

        <h2>Font Size?</h2>

        <ul>
          <li>
           On a Mac, 
           <br><br>
           Use "Command" <b>+</b> "+" to Increase Font Size.
           <br><br>
           Use "Command" <b>+</b> "-" to Decrease Font Size.
          </li>
          <br>

          <li>
           On Windows, 
           <br><br>
           Use "CTRL" <b>+</b> "+" to Increase Font Size.
           <br><br>
           Use "CTRL" <b>+</b> "-" to Decrease Font Size.
           <br><br>
           You can also hold <b>"CTRL"</b> and scroll the <b>"Mouse Wheel"</b> to adjust the Font Size.
          </li>
          <br>
        </ul>

      </div>

      <div class="helpArticle" id="displayHelpArticle">

        <h2>Display?</h2>
        <h2>Can't differentiate between elements?</h2>
        
        <p>Please make sure the <b>Contrast</b> Setting of your display is around 50%</p>

      </div>

      <div class="helpArticle">

        <h2>Dismiss Help?</h2>

        To dismiss Help, click on <span id="helpHelpButton" style="padding: 2.5%;padding-top:  1%;padding-bottom: 1%;margin: 1%;color: white;background-color: darkred;border-radius: 0.5em;font-size: x-large;">X</span> button on the top left of the screen
        <br><br>

      </div>

      <div class="helpArticle">

        <h2>Need more help?</h2>

        Contact Support 
        <br><br>
        <a class="helpEmailLink" href="mailto:support@lotus.com">Team Lotus</a>
        <br><br>

      </div>

    </div>

    <!-- HELP DIV END -->

    <!-- HELP DIV ICON SWITCH SCRIPT START -->

    <script type="text/javascript">
    
    var d = new Date();

    searchIcons = document.getElementsByClassName("helpSearchIcon");
    exportIcons = document.getElementsByClassName("helpDownloadIcon");
    closeIcons = document.getElementsByClassName("helpCloseIcon");

    if (d.getHours() >= 6 && d.getHours() < 18)
    {  
        for (var i = searchIcons.length - 1; i >= 0; i--) {
          searchIcons[i].src = "search_bright.png";
        }

        for (var i = closeIcons.length - 1; i >= 0; i--) {
          closeIcons[i].src = "close_bright.png";
        }

        for (var i = exportIcons.length - 1; i >= 0; i--) {
          exportIcons[i].src = "download_bright.png";
        }
        document.getElementById('helpHelpButton').style.backgroundColor = "red";
    }
    else
    {
        for (var i = searchIcons.length - 1; i >= 0; i--) {
          searchIcons[i].src = "search_dark.png";
        }

        for (var i = closeIcons.length - 1; i >= 0; i--) {
          closeIcons[i].src = "close_dark.png";
        }

        for (var i = exportIcons.length - 1; i >= 0; i--) {
          exportIcons[i].src = "download_dark.png";
        }

        document.getElementById('helpButton').style.color = "white";
    }

    </script>

    <!-- HELP DIV ICON SWITCH SCRIPT END -->

    <!-- HELP DIV FUNCTIONALITY SCRIPT START -->
    <script type="text/javascript" src="helpScript.js"></script>
    <!-- HELP DIV FUNCTIONALITY SCRIPT END -->

  </body>
  
  </html>