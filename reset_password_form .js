function checkinput(e){
   password = $('in1');
   re_password = $('in2');
   if(password.value == "")
    {
        password.setCustomValidity('Kötelező mező');
        e.preventDefault();
    }
    else{
        password.setCustomValidity('');
    }

    if(re_password.value == "")
    {
        re_password.setCustomValidity('Kötelező mező');
        e.preventDefault();
    }
    else{
        re_password.setCustomValidity('');
    }

    if(re_password.value != password.value)
    {
        re_password.setCustomValidity('Két jelszó nem megegyező');
        e.preventDefault();
    }
    else{
        re_password.setCustomValidity('');
    }
}



window.onload = function () {

    var form = $('elso'); 
    form.addEventListener("submit",checkinput,true);

}