// EXPORT DIV FUNCTIONALITY SCRIPT START

    var exportNavIcon = document.getElementById('exportNavIcon');
    var exportNavButton = document.getElementById('exportNavButton');
    var exportDiv = document.getElementById('exportDiv');

      exportNavButton.onclick = function() 
      { 
        if (exportDiv.classList.contains("exportOn"))
        {
          exportDiv.classList.add("exportOff");
          exportDiv.classList.remove("exportOn");

          if (exportNavIcon.classList.contains("fa-times-circle")
            && exportNavIcon.classList.contains("far"))
          {
            exportNavIcon.classList.remove("fa-times-circle");
            exportNavIcon.classList.remove("far");
            exportNavIcon.classList.add("fas");
            exportNavIcon.classList.add("fa-arrow-circle-down");

            exportNavButton.classList.remove("linkB_active");
          }
        }
        else 
        {
          exportDiv.classList.add("exportOn");

          exportNavIcon.classList.remove("fa-arrow-circle-down");
          exportNavIcon.classList.remove("fas");
          exportNavIcon.classList.add("far");
          exportNavIcon.classList.add("fa-times-circle");

          exportNavButton.classList.add("linkB_active");

          exportDiv.classList.add("exportOn");
          
          if (exportDiv.classList.contains("exportOff"))
            exportDiv.classList.remove("exportOff");
        }
      };