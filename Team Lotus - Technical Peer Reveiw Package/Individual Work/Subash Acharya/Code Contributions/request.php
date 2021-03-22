<!DOCTYPE html>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Industry Partner Database</title>

    <!-- CSS 3 EXTERNAL -->
    <link href="request_dark.css" id="rS" rel="stylesheet" type="text/css">

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
        swapStylesheet("request_bright.css", "rS");
    else
        swapStylesheet("request_dark.css", "rS");

  </script>

  </head>

  <body>

    <button class="uiButtonOff" id="close" onclick="closePreview()">(X)</button>
    <div id="layer"></div>
    
    <div id="topBar">Industry Partner Database</div>

    <div class="dashboard">

      <div class="widget">

        <h1 class="widgetTitle">Today</h1>

        <table class="dataTable">

          <?php
          
          global $o;
          require "./connect.php";
          require_once "./global.php";

          $sql = "SELECT " . $insertSchema . ", Timestamp FROM Contacts WHERE DATE(CONVERT_TZ(`Timestamp`,'+00:00','-06:00')) = DATE(CONVERT_TZ(CURRENT_TIMESTAMP(),'+00:00','-06:00')) ORDER BY Timestamp DESC";
          
          $result = $conn->query($sql);
          $o = 0;

        if ($result->num_rows > 0) 
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

          ?>

        </table>
        
      </div>

      <div class="widget">

        <h1 class="widgetTitle">Older</h1>

        <table class="dataTable">

          <?php

          $sql = "SELECT " . $insertSchema . ", Timestamp FROM Contacts WHERE DATE(CONVERT_TZ(`Timestamp`,'+00:00','-06:00')) != DATE(CONVERT_TZ(CURRENT_TIMESTAMP(),'+00:00','-06:00')) ORDER BY Timestamp DESC";

          $result = $conn->query($sql);

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

          ?>

        </table>
        
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

  </body>