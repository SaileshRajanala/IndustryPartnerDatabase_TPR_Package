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
  messageDiv = id_('message');
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

function animate_Message(_animationClass='msgPopAnimation')
{
	id_('message').classList.add(_animationClass);

	// Code below is necessary for animation on request.
  	id_('message').addEventListener("animationend", 
    function() 
    {
        messageDiv.classList.remove(_animationClass);            
    }
    );
}

function focus_message(_id, msg)
{
  if (id_(_id).style.display != 'none')
  id_(_id).addEventListener("focusin", 
  function () 
  { 
  	message(msg);
  	animate_Message(); 
  });
}

function success_message(msg) 
{
  message(msg, '<i class="far fa-check-circle"></i>');
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

  animate_Message('successMsgAnimation');
}

function error_message(msg) 
{
  message(msg, '<i class="fas fa-exclamation-triangle"></i>');
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

  animate_Message('errorMsgAnimation');
}

function no_message()
{
	id_('message').innerHTML = "";

	var d = new Date();

	if (d.getHours() >= 6 && d.getHours() < 18)
		messageDiv.style.backgroundColor = 'black';
	else 
		messageDiv.style.backgroundColor = 'white';
}

function default_message()
{
  messageDiv.innerHTML = 'Industry Partner Form';

  if (d.getHours() >= 6 && d.getHours() < 18)
    messageDiv.style.backgroundColor = 'black';
  else 
    messageDiv.style.backgroundColor = 'white';
}

for (var i = tag_('input').length - 1; i >= 0; i--) 
  tag_('input')[i].addEventListener("focusout", default_message);

focus_message('first_name', 'Please enter your First Name');
focus_message('last_name', 'Please enter your Last Name');
focus_message('email', 'Please enter your Email Address');
focus_message('phone_number', 'Please enter your Phone Number');
focus_message('employer', "Please enter your Employer's Name");
focus_message('job_title', 'What is the title of your job?');
focus_message('state', 'In which state, do you work?');
focus_message('city', 'In which city, do you work?');
focus_message('otherEngDisciplineText', 'Please list the discipline of your Engineering Degree');

// Important Function below.
for (var i = tag_('input').length - 1; i >= 0; i--) 
  tag_('input')[i].addEventListener("focusout", default_message);

id_('prefix').addEventListener("focusin", 
  function () {message('Please select your Prefix');});

id_('suffix').addEventListener("focusin", 
  function () {message('Please select your Suffix');});

// Important Function below.
for (var i = tag_('select').length - 1; i >= 0; i--) 
  tag_('input')[i].addEventListener("change", 
    function () {messageDiv.innerHTML = 'Industry Partner Form';});

function alphabetsOnly(_id, _msg, _errorMsg, _successMsg) 
{
	id_(_id).addEventListener("keyup", function () 
	{	
		var regex = /^[a-zA-Z]+$/;

		if (id_(_id).value == "")
			message(_msg);
		else if (!regex.test( id_(_id).value ))
			error_message(_errorMsg);
		else
			success_message(_successMsg);
	}
	);
}

function switchDiv(targetDiv, currentDiv)
{
    id_(currentDiv).style.display = 'none';

    id_(targetDiv).style.display = 'block';
    window.scrollTo(0, 0);

    // message(msg);
    // animate();
    // Default Parameters ('message','msgPopAnimation')
    
    //id_(targetDiv).classList.add('formDivLaunchAnimation');
}

alphabetsOnly('first_name', 'Please enter your First Name', 
	'First Name should only contain Alphabets', 'First Name entered is Valid'); 

alphabetsOnly('last_name', 'Please enter your Last Name', 
	'Last Name should only contain Alphabets', 'Last Name entered is Valid');

alphabetsOnly('employer', 'Please enter your Last Name', 
	"Employer's Name should only contain Alphabets");



