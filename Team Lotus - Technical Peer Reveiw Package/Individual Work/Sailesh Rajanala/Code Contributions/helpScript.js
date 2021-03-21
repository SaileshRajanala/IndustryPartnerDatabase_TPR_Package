// HELP DIV ICON SWITCH SCRIPT START
    
    // var d = new Date();

    // searchIcons = document.getElementsByClassName("helpSearchIcon");
    // exportIcons = document.getElementsByClassName("helpDownloadIcon");
    // closeIcons = document.getElementsByClassName("helpCloseIcon");

    // if (d.getHours() >= 6 && d.getHours() < 18)
    // {  
    //     for (var i = searchIcons.length - 1; i >= 0; i--) {
    //       searchIcons[i].src = "search_bright.png";
    //     }

    //     for (var i = closeIcons.length - 1; i >= 0; i--) {
    //       closeIcons[i].src = "close_bright.png";
    //     }

    //     for (var i = exportIcons.length - 1; i >= 0; i--) {
    //       exportIcons[i].src = "download_bright.png";
    //     }
    //     document.getElementById('helpHelpButton').style.backgroundColor = "red";
    // }
    // else
    // {
    //     for (var i = searchIcons.length - 1; i >= 0; i--) {
    //       searchIcons[i].src = "search_dark.png";
    //     }

    //     for (var i = closeIcons.length - 1; i >= 0; i--) {
    //       closeIcons[i].src = "close_dark.png";
    //     }

    //     for (var i = exportIcons.length - 1; i >= 0; i--) {
    //       exportIcons[i].src = "download_dark.png";
    //     }

    //     // document.getElementById('helpButton').style.color = "white";
    // }

    // HELP DIV ICON SWITCH SCRIPT END

    // HELP DIV FUNCTIONALITY SCRIPT START 
      
      var helpDiv = document.getElementById('helpDiv');

      var helpNavIcon = document.getElementById('helpNavIcon');
      var helpNavButton = document.getElementById('helpNavButton');

      helpNavButton.onclick = function() 
      { 
        if (helpDiv.classList.contains("helpOn"))
        {
          helpDiv.classList.add("helpOff");
          helpDiv.classList.remove("helpOn");

          if (helpNavIcon.classList.contains("fa-times-circle"))
          {
            helpNavIcon.classList.remove("fa-times-circle");
            helpNavIcon.classList.add("fa-question-circle");
    
            helpNavButton.classList.remove("linkB_active");
          }
        }
        else 
        {
          helpDiv.classList.add("helpOn");
          
          helpNavIcon.classList.remove("fa-question-circle");
          helpNavIcon.classList.add("fa-times-circle");
          helpNavButton.classList.add("linkB_active");

          helpDiv.classList.add("helpOn");
          
          if (helpDiv.classList.contains("helpOff"))
            helpDiv.classList.remove("helpOff");
        }

      };
    
    // HELP DIV FUNCTIONALITY SCRIPT END -->