"use strict";

function blurHandler(e) {
    this.style.backgroundColor = '';
    if (this.value == '') {
        this.setCustomValidity('Kötelező mező');
        this.reportValidity();
    }
    else {
        this.setCustomValidity('');
    }
    var email = $('in1');
    console.log(email.value)
    let re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
    if (!re.test(email.value)) {
        email.setCustomValidity('Helytelen e-mail cím');
        email.reportValidity();
    }
    else {
        email.setCustomValidity('');
    }
}

















window.onload = function () {

    var form = $('elso'); 
    form.email.addEventListener("blur",blurHandler,true);

}