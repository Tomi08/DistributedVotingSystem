"use strict";

//focus
function focusHandler(e) {
    this.style.backgroundColor = 'lightgray';

}

//blur
function blurHandler(e) {
    this.style.backgroundColor = '';
    if (this.value == '') {
        this.setCustomValidity('Kötelező mező');
        this.reportValidity();
    }
    else {
        this.setCustomValidity('');
    }
    if (this.id == "in1") {
        let re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;

        if (!re.test(this.value)) {
            this.setCustomValidity('Helytelen e-mail formátum, Minta formátum example@example.com');
            this.reportValidity();

        }
        else {
            this.setCustomValidity('');
        }
    }
    if (this.id == "in2") {
        let re = /^(?=.*[A-Z])(?=.*\d).+$/;

        if (!re.test(this.value) || this.value.length < 8) {
            this.setCustomValidity('Helytelen jelszó vagy túl rövid jelszó, Minta formátum Example123');
            this.reportValidity();
        }
        else {
            this.setCustomValidity('');
        }
    }

}
//keyup
function keyUpHandler(e) {
    if (this.id == "in1") {
        let re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
        var password = document.getElementById("in2");
        if (!re.test(this.value)) {
            this.style.color = 'red';
            password.style.display = "none";
        }
        else {
            this.style.color = 'green';
            password.style.display = "block";

        }

    }

}

window.onload = function () {

    var form = $('elso_');
    var error = $('error');
    form.email.addEventListener("focus", focusHandler, true);
    form.email.addEventListener("blur", blurHandler, true);
    form.email.addEventListener("keyup", keyUpHandler, true);

    form.password.addEventListener("focus", focusHandler, true);
    form.password.addEventListener("blur", blurHandler, true);
    form.password.addEventListener("keyup", keyUpHandler, true);
    /*fetch('error.txt')
        .then(function (response) {
            if (response.ok) {
                return response.text();
            } else {
                throw new Error('Hiba történt a fájl betöltése közben.');
            }
        })
        .then(function (data) {
            
            error.textContent = data;
        })
        .catch(function (error) {
            console.log(error);
        });
        */

}