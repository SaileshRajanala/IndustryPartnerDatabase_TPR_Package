function tag_(_tag)
{
  return document.getElementsByTagName(_tag);
}

function id_(_id)
{
  return document.getElementById(_id);
}

function class_(_class)
{
  return document.getElementsByClassName(_class);
}

function message(msg, icon = '<i class="fas fa-comment"></i>') 
{
  var messageDiv = id_('message');
  messageDiv.style.backgroundImage = 'none';

  // messageDiv.classList.add('msgPopAnimation');
  messageDiv.innerHTML = icon + '&nbsp; ' + msg + '';
  
  // messageDiv.style.color = 'black';
  var d = new Date();

  if (d.getHours() >= 6 && d.getHours() < 18)
  {
    messageDiv.style.backgroundColor = 'black';
    messageDiv.style.color = 'white';
  }
  else 
  {
    messageDiv.style.backgroundColor = 'white';
    messageDiv.style.color = 'black';
  }
}

// function animate_Message(_animationClass='msgPopAnimation')
// {
// 	id_('message').classList.add(_animationClass);

// 	// Code below is necessary for animation on request.
//   	id_('message').addEventListener("animationend", 
//     function() 
//     {
//         id_('message').classList.remove(_animationClass);            
//     }
//     );
// }

// DevTEST START ---------------------------------------

function animate(_id='message', _animationClass='msgPopAnimation')
{
  id_(_id).classList.add(_animationClass);

  // Code below is necessary for animation on request.
    id_(_id).addEventListener("animationend", 
    function() 
    {
        id_(_id).classList.remove(_animationClass);            
    }
    );
}

// function animateAll(_class='message', _animationClass='msgPopAnimation')
// {
//   for (var i = class_(_class).length - 1; i >= 0; i--) 
//   {
//     var object = class_(_class)[i];

//     object.classList.add(_animationClass);

//     // Code below is necessary for animation on request.
//     object.addEventListener("animationend", 
//     function() 
//     {
//         object.classList.remove(_animationClass);            
//     }
//     );
//   }
// }

function id_message(_id, msg, icon = '<i class="fas fa-comment"></i>') 
{
  var messageDiv = id_(_id);
  messageDiv.style.backgroundImage = 'none';

  // messageDiv.classList.add('msgPopAnimation');
  messageDiv.innerHTML = icon + '&nbsp; ' + msg + '';
  
  // messageDiv.style.color = 'black';
  var d = new Date();

  if (d.getHours() >= 6 && d.getHours() < 18)
  {
    messageDiv.style.backgroundColor = 'black';
    messageDiv.style.color = 'white';
  }
  else 
  {
    messageDiv.style.backgroundColor = 'white';
    messageDiv.style.color = 'black';
  }
}

function id_error_message(_id, msg) 
{
  var messageDiv = id_(_id);
  id_message(_id, msg, '<i class="fas fa-exclamation-triangle"></i>');
  messageDiv.style.color = 'white';
  // messageDiv.style.backgroundImage = 'linear-gradient(147deg, red, darkred)';

  if (d.getHours() >= 6 && d.getHours() < 18)
  {
  messageDiv.style.backgroundColor = 'red';
  }
  else 
  {
  messageDiv.style.backgroundColor = 'darkred';
  }

  // animate_Message('errorMsgAnimation');
}

function id_success_message(_id, msg) 
{
  var messageDiv = id_(_id);
  id_message(_id, msg, '<i class="far fa-check-circle"></i>');
  messageDiv.style.color = 'white';
  // messageDiv.style.backgroundImage = 'linear-gradient(147deg, lime, green)';

  if (d.getHours() >= 6 && d.getHours() < 18)
  {
  messageDiv.style.backgroundColor = 'lime';
  messageDiv.style.color = 'black';
  }
  else 
  {
  messageDiv.style.backgroundColor = 'green';
  messageDiv.style.color = 'white';
  }

  // animate_Message('successMsgAnimation');
}

function validate(_id, _regex, _msg, _errorMsg, _successMsg) 
{
  var guideID = _id + '_message_id';

  if (id_(_id).style.display != 'none')
    id_(_id).addEventListener("focusin", 
    function () 
    { 
      // remove error class if contained
      if (id_(_id).classList.contains('wrongInput'))
        id_(_id).classList.remove('wrongInput');

      // remove correct class if contained
      if (id_(_id).classList.contains('correctInput'))
        id_(_id).classList.remove('correctInput');

      var node = document.createElement("p");
      node.classList.add('guide');
      
      node.setAttribute("id", guideID);

      // var textnode = document.createTextNode(_msg);
      // node.appendChild(textnode);

      id_(_id).parentElement.appendChild(node);
      animate(guideID,'slideDownAnimation');
      id_(_id).classList.add('bond');

      if (id_(_id).value == "")
        id_message(guideID, _msg);
      else if (!_regex.test( id_(_id).value ))
        id_error_message(guideID, _errorMsg);
      else
        id_success_message(guideID, _successMsg);
    });

  id_(_id).addEventListener("keyup", function (event) 
  { 
    if ((event.keyCode >=  48 && event.keyCode <=  90) ||
        (event.keyCode >= 186 && event.keyCode <= 222) ||
         event.keyCode ==  32 || event.keyCode ==   8)  
      if (id_(_id).value == "")
        id_message(guideID, _msg);
      else if (!_regex.test( id_(_id).value ))
      {
        //error_message(_errorMsg);
        animate(guideID,'errorMsgAnimation');
        id_error_message(guideID, _errorMsg);
        
        // animateAll('guide','errorMsgAnimation');
      }
      else
      {
        id_success_message(guideID, _successMsg);
        animate(guideID,'successMsgAnimation');
      }
  }
  );

  if (id_(_id).style.display != 'none')
    id_(_id).addEventListener("focusout", 
    function () 
    { 
      id_(_id).classList.remove('bond'); 
      animate(_id, 'minimizeAnimation');
      id_(_id).parentElement.removeChild(id_(_id).parentElement.lastElementChild);

      // INPUT DETECTION & CONFIRMATION BELOW
      if (!_regex.test( id_(_id).value ))
      {
        id_(_id).classList.add('wrongInput');

        if (id_(_id).classList.contains('correctInput'))
          id_(_id).classList.remove('correctInput');
      }
      else
      {
        if (id_(_id).classList.contains('wrongInput'))
          id_(_id).classList.remove('wrongInput');

        id_(_id).classList.add('correctInput');
      }
      
    });
}


function capitalizeStringAt(str, i)
{
    return str.substring(0, i) +str[i].toUpperCase() + str.substring(i + 1);
}


function sanitize(_id)
{
  id_(_id).addEventListener("keyup", function (event) 
  { 
    input = id_(_id).value;

    if ((event.keyCode >=  48 && event.keyCode <=  90) ||
        (event.keyCode >= 186 && event.keyCode <= 222) ||
         event.keyCode ==  32 || event.keyCode ==   8)  
      if (input != "") 
      {
        input = capitalizeStringAt(input, 0);

        for (var i = 1; i < input.length - 1; i++) 
        {
          if (input[i] == ' ')
          {
            input = capitalizeStringAt(input, i + 1);
          }
        }

        id_(_id).value = input;
      }

  });
}

// SOURCE : formTestScript.js *********************************
function switchDiv(targetDiv, currentDiv, msg)
{
    id_(currentDiv).style.display = 'none';

    id_(targetDiv).style.display = 'block';
    window.scrollTo(0, 0);

    message(msg);
    animate();
    // Default Parameters ('message','msgPopAnimation')
    
    //id_(targetDiv).classList.add('formDivLaunchAnimation');
}

// DevTEST END ---------------------------------------

// function focus_message(_id, msg)
// {
//   if (id_(_id).style.display != 'none')
//   id_(_id).addEventListener("focusin", 
//   function () 
//   { 
//   	message(msg);
//   	animate_Message(); 
//   });
// }

// function success_message(msg) 
// {
//   var messageDiv = id_('message');
//   message(msg, '<i class="far fa-check-circle"></i>');
//   messageDiv.style.color = 'white';
//   // messageDiv.style.backgroundImage = 'linear-gradient(147deg, lime, green)';

//   if (d.getHours() >= 6 && d.getHours() < 18)
//   {
// 	messageDiv.style.backgroundColor = 'lime';
// 	messageDiv.style.color = 'black';
//   }
//   else 
//   {
// 	messageDiv.style.backgroundColor = 'green';
// 	messageDiv.style.color = 'white';
//   }

//   animate_Message('successMsgAnimation');
// }

// function error_message(msg) 
// {
//   var messageDiv = id_('message');
//   message(msg, '<i class="fas fa-exclamation-triangle"></i>');
//   messageDiv.style.color = 'white';
//   // messageDiv.style.backgroundImage = 'linear-gradient(147deg, red, darkred)';

//   if (d.getHours() >= 6 && d.getHours() < 18)
//   {
// 	messageDiv.style.backgroundColor = 'red';
//   }
//   else 
//   {
// 	messageDiv.style.backgroundColor = 'darkred';
//   }

//   animate_Message('errorMsgAnimation');
// }

// function no_message()
// {
//   var messageDiv = id_('message');
// 	id_('message').innerHTML = "";

// 	var d = new Date();

// 	if (d.getHours() >= 6 && d.getHours() < 18)
// 		messageDiv.style.backgroundColor = 'black';
// 	else 
// 		messageDiv.style.backgroundColor = 'white';
// }

// function default_message()
// {
//   var messageDiv = id_('message');
//   messageDiv.innerHTML = 'Industry Partner Form';

//   if (d.getHours() >= 6 && d.getHours() < 18)
//     messageDiv.style.backgroundColor = 'black';
//   else 
//     messageDiv.style.backgroundColor = 'white';
// }

// for (var i = tag_('input').length - 1; i >= 0; i--) 
//   tag_('input')[i].addEventListener("focusout", default_message);

// focus_message('first_name', 'Please enter your First Name');
// focus_message('last_name', 'Please enter your Last Name');
// focus_message('email', 'Please enter your Email Address');
// focus_message('phone_number', 'Please enter your Phone Number');
// focus_message('employer', "Please enter your Employer's Name");
// focus_message('job_title', 'What is the title of your job?');
// focus_message('state', 'In which state, do you work?');
// focus_message('city', 'In which city, do you work?');
// focus_message('otherEngDisciplineText', 'Please list the discipline of your Engineering Degree');

// // Important Function below.
// for (var i = tag_('input').length - 1; i >= 0; i--) 
//   tag_('input')[i].addEventListener("focusout", default_message);

// id_('prefix').addEventListener("focusin", 
//   function () {message('Please select your Prefix');});

// id_('suffix').addEventListener("focusin", 
//   function () {message('Please select your Suffix');});

// // Important Function below.
// for (var i = tag_('select').length - 1; i >= 0; i--) 
//   tag_('input')[i].addEventListener("change", 
//     function () {messageDiv.innerHTML = 'Industry Partner Form';});

// function alphabetsOnly(_id, _msg, _errorMsg, _successMsg) 
// {
// 	id_(_id).addEventListener("keyup", function () 
// 	{	
// 		var regex = /^[a-zA-Z]+$/;

// 		if (id_(_id).value == "")
// 			message(_msg);
// 		else if (!regex.test( id_(_id).value ))
//     {
// 			error_message(_errorMsg);
//       animate('first_name','errorMsgAnimation');
//     }
// 		else
// 			success_message(_successMsg);
// 	}
// 	);
// }
 
// alphabetsOnly('first_name', 'Please enter your First Name', 
// 	'First Name should only contain Alphabets', 'First Name entered is Valid'); 

// alphabetsOnly('last_name', 'Please enter your Last Name', 
// 	'Last Name should only contain Alphabets', 'Last Name entered is Valid');

// alphabetsOnly('employer', 'Please enter your Last Name', 
// 	"Employer's Name should only contain Alphabets");

validate('first_name', /^[a-zA-Z]+$/, 'Please enter your First Name', 
  'Enter only alphabets', 'First Name is Valid');

validate('last_name', /^[a-zA-Z]+$/, 'Please enter your Last Name', 
  'Enter only alphabets', 'Last Name is Valid');

validate('email', 
  /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i, 
  'Please enter your Email address', 'Enter a valid email', 'Email is Valid');

validate('phone_number', /^\d{10}$/, 'Enter your 10-digit Phone Number', 
  'Enter a valid U.S. Phone Number', 'Phone Number is Valid');

validate('employer', /^[a-zA-Z]+ [a-zA-Z]+$/, 
  "Please enter your Employer's Name", 
  "Enter Employer's First & Last Name", "Employer's Name is valid");

validate('job_title', /^[a-zA-Z ]*$/, 
  "Please enter your Job Title", 
  "Enter a valid Job Title", "Job Title is valid");

validate('city', /^[a-zA-Z ]*$/, 
  "In which city did you work?", 
  "Enter a valid city", "City is valid");

sanitize('first_name');
sanitize('last_name');
sanitize('employer');
sanitize('job_title');
sanitize('city');














///////////////////// QUESTIONS /////////////////////
function name_(_name)
{
  return document.getElements-ByName(_name);
}

function getRadioValue(_radioName)
{
  for (var i = name_(_radioName).length - 1; i >= 0; i--) 
    if (name_(_radioName)[i].checked)
      return name_(_radioName)[i].value;
}

function reveal_if_checked_radio(_radioID, _id)
{
  if (id_(_radioID).checked)
    id_(_id).style.display = 'block';

  id_(_radioID).addEventListener("change", myScript);
}

function reveal_if_checked_checkbox(_checkboxID, _id)
{

}

id_('3').addEventListener("input", function() 
{
  if (id_('3').checked) 
    id_('ass').style.display = "block";
  else 
    id_('ass').style.display = "none";
});





