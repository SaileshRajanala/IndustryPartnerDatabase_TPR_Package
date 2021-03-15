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

// OTHER RADIO Button  ******************************
function linkRadioWithText(_radio, _text)
{
  id_(_text).addEventListener("keyup", 
  function () 
  {
    id_(_radio).click();
    id_(_radio).value = id_(_text).value;
  });
}

linkRadioWithText('otherUndergradDegreeRadio','otherUndergradDegreeText');
linkRadioWithText('otherEngDisciplineRadio','otherEngDisciplineText');


var labels = document.getElementsByTagName('LABEL');
for (var i = 0; i < labels.length; i++) {
    if (labels[i].htmlFor != '') {
         var elem = document.getElementById(labels[i].htmlFor);
         if (elem)
            elem.label = labels[i];         
    }
}

// function switchDiv(targetDiv, currentDiv)
// {
//     id_(currentDiv).style.display = 'none';

//     id_(targetDiv).style.display = 'block';
//     window.scrollTo(0, 0);
//     //id_(targetDiv).classList.add('formDivLaunchAnimation');
// }

// INITIALIZE FORM START##########################################################################
var formDivs = document.getElementsByClassName('formDiv');

for (var i = formDivs.length - 1; i >= 0; i--) {
  formDivs[i].style.display = 'none';
}

formDivs[0].style.display = 'block';
// INITIALIZE FORM END##########################################################################


// var nextButtons = document.getElementsByClassName('nextButton');

// for (var i = nextButtons.length - 1; i >= 0; i--) 
// {
//   var currDiv = id_(nextButtons[i].getAttribute('currentDiv'));
//   var nextDiv = id_(nextButtons[i].getAttribute('targetDiv'));

//   nextButtons[i].addEventListener('click', function() 
//     {
//       currDiv.style.display = 'none';
//       nextDiv.style.display = 'block';
//     });
// }

// var prevButtons = document.getElementsByClassName('prevButton');

// for (var i = prevButtons.length - 1; i >= 0; i--) 
// {
//   var currDiv = id_(prevButtons[i].getAttribute('currentDiv'));
//   var prevDiv = id_(prevButtons[i].getAttribute('targetDiv'));

//   prevButtons[i].addEventListener('click', function() 
//     {

//       prevDiv.style.display = 'block';
//       currDiv.style.display = 'none';
//     });
// }


// CHECKBOX JS TEST 
// var inputs = document.getElementsByTagName("input");  // all inputs

// for(var i = 0; i < inputs.length; i++) 
// {
//     if(inputs[i].type == "checkbox") 
//     {
//         inputs[i].addEventListener("onmouseover", 
          
//           function () 
//           {
//              if (inputs[i].checked) 
//              {
//                 var labels = document.getElementsByTagName('label');

//                 //htmlFor
//                 for (var k = labels.length - 1; k >= 0; k--) 
//                 {
//                   if (labels[i].htmlFor == inputs[i].getAttribute('id'))
//                   {
//                     labels[i].innerHTML += ' <i class="fas fa-check-circle"></i>';
//                   }
//                 }


//              }
//              else
//              {
//                 var labels = document.getElementsByTagName('label');

//                 //htmlFor
//                 for (var k = labels.length - 1; k >= 0; k--) 
//                 {
//                   if (labels[i].htmlFor == inputs[i].getAttribute('id'))
//                   {
//                     labels[i].innerHTML += ' <i class="fas fa-check-circle"></i>';
//                   }
//                 }
//              }
//           }
        
//         );    
//     }  
// }


 // TESTS
 // error_message('Please enter a valid name.');
 // success_message('Great! Please fill out the next section.');


// id_('first_name').onclick = function () {

//   message('Please enter your First Name.');

// };

//  id_('last_name').onclick = function () {

//   message('Please enter your Last Name.');

// };

//message("Industry Partner Form");

// on clicking the next_section1 button
// document.getElementById('next_section1').onclick = function()
// {

//   var prefix = document.getElementById('prefix').value + ' ';
//   var suffix = document.getElementById('suffix').value + ' ';
//   var first_name = document.getElementById('first_name').value + ' ';
//   var last_name = document.getElementById('last_name').value + ' ';

 //  message('Great! Please proceed to the next section <button class="nextButton" id="next_section1"> Next <i class="fas fa-chevron-circle-right"></i> </button>');

// };