// SEARCH BAR GRAPHIC SCRIPT 

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

    // SEARCHICON FUNCTIONALITY SCRIPT
      
      var searchNavIcon = document.getElementById('searchNavIcon');
      var searchNavButton = document.getElementById('searchNavButton');

      var dashBoard = document.getElementsByClassName('dashboard')[0];
      var searchBar = document.getElementById("searchBarDiv");

      var d = new Date();

      searchBar.style.display = "none";

      searchNavButton.onclick = function() 
      { 
        if (searchBar.classList.contains("bubblegumOn"))
        {
          searchBar.classList.add("bubblegumOff");
          searchBar.classList.remove("bubblegumOn");

          if (searchNavIcon.classList.contains("fa-times-circle")
            && searchNavIcon.classList.contains("far"))
          {
            searchNavIcon.classList.remove("fa-times-circle");
            searchNavIcon.classList.remove("far");
            searchNavIcon.classList.add("fab");
            searchNavIcon.classList.add("fa-sistrix");
            searchNavButton.classList.remove("linkB_active");
          }

            dashBoard.style.display = "block";
            dashBoard.style.animationDelay = "0s";
            dashBoard.classList.remove("hideBelow");
        }
        else 
        {
          dashBoard.style.animationDelay = "0s";
          dashBoard.classList.add("hideBelow");

          searchNavIcon.classList.remove("fa-sistrix");
          searchNavIcon.classList.remove("fab");
          searchNavIcon.classList.add("far");
          searchNavIcon.classList.add("fa-times-circle");
          searchNavButton.classList.add("linkB_active");

          //Code below is necessary for button on input field
          searchBar.style.display = 'flex'; 

          searchBar.classList.add("bubblegumOn");
          
          if (searchBar.classList.contains("bubblegumOff"))
            searchBar.classList.remove("bubblegumOff");
        }

        searchBar.addEventListener("animationend", 

          function() 
          {
            if (searchBar.classList.contains("bubblegumOff"))
            {
                searchBar.style.display = 'none';
            }
          }

        );

        dashBoard.addEventListener("animationend", 

          function() 
          {
            if (dashBoard.classList.contains("hideBelow"))
            {
                dashBoard.style.display = 'none';
            }
          }

        );
      };
