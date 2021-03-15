
function myFunction(x) 
{
  if (x.matches) 
  { // If media query matches
    document.getElementById('homeNavButton').innerHTML = "<i class='fas fa-home'></i>";
	  document.getElementById('helpNavButton').innerHTML = "<i id='helpNavIcon' class='far fa-question-circle'></i>";
    document.getElementById('exportNavButton').innerHTML = "<i id='exportNavIcon' class='fas fa-arrow-circle-down'></i>";
    document.getElementById('searchNavButton').innerHTML = "<i id='searchNavIcon' class='fab fa-sistrix'></i>";   
  }
  else 
  {
    document.getElementById('homeNavButton').innerHTML = "Industry Partner Database";
    document.getElementById('helpNavButton').innerHTML = "Help <i id='helpNavIcon' class='far fa-question-circle'></i>";
    document.getElementById('exportNavButton').innerHTML = "Export <i id='exportNavIcon' class='fas fa-arrow-circle-down'></i>";
    document.getElementById('searchNavButton').innerHTML = "Search <i id='searchNavIcon' class='fab fa-sistrix'></i>";
  }
}

var x = window.matchMedia("(max-width: 1000px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes
