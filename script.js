
function invalid(element){
  element.setAttribute("class","form-control is-invalid");    
}

function valid(element){
  element.setAttribute("class","form-control is-valid");    
}


function ValidateEmail(mail) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail.value)){
      return (true)
    }
    return (false)
}

function Validate_user(username){
  if (username.value.length < 1 ) return false;
  return true;
}

function Validate_city(city){
  if (city.value.length < 1 ) return false;
  return true;
}

function Validate_state(state){
  if (state.value.length < 1) return false;
  return true;
}

function ValidatePhone(phone){
  if(phone.value.length == 10){
    return true;
  }
  else{
    return false;
  }
}

function Validate_pass(pass, cpass){
  if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/.test(pass.value)){
    if(pass.value== cpass.value){
    return true;
    }
    else{
      return false;
    }
  } return false;
}

function validation() {
  var email = document.getElementById('inputEmail4');
  var username = document.getElementById('username');
  var phone = document.getElementById('inputPhone');
  var pass = document.getElementById('inputPassword4');
  var cpass = document.getElementById('inputPassword5');
  var city = document.getElementById('inputCity');
  var state = document.getElementById('inputState');

  const arr = [email, username, phone, pass, cpass, city, state];

  if (ValidateEmail(email)) valid(email);
  else invalid(email);

  if(Validate_user(username)) valid(username);
  else invalid(username);
  

  if(Validate_city(city)){
    valid(city);
  }
  else{
    invalid(city);
  }


  if(Validate_state(state)){
    valid(state);
  }
  else{
    invalid(state);
  }


  if(ValidatePhone(phone)) valid(phone);
  else invalid(phone);

  if(Validate_pass(pass, cpass)) {valid(pass); valid(cpass);}
  else{invalid(pass); invalid(cpass);}


  var i = 0;
  var count = 0;
  

  while(i < arr.length){

    if(arr[i].getAttribute("class") == "form-control is-valid") count++;
    i++;
  }

  if(count == 7) return true;
  return false;
}


