"use strict";

//focus
function rfocusHandler(e) {
    this.style.backgroundColor = 'lightgray';

}

//blur
function rblurHandler(e) {
    this.style.backgroundColor = '';
    if (this.value == '') {
        this.setCustomValidity('Kötelező mező');
        this.reportValidity();
    }
    else {
        this.setCustomValidity('');
    }
    if (this.id == "rin8" || this.id == 'in1') {
        let re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
        if (!re.test(this.value)) {
            this.setCustomValidity('Helytelen e-mail formátum, Minta formátum example@example.com');
            this.reportValidity();
        }
        else {
            this.setCustomValidity('');
        }
    }
    if (this.id == "rin9") {
        var email = document.getElementById("rin8");
        if (this.value != email.value) {
            this.setCustomValidity('Két e-mail nem megegyező');
            this.reportValidity();

        }
        else {
            this.setCustomValidity('');
        }
    }
    if (this.id == "rin10" || this.id == "in2") {
        let re = /^(?=.*[A-Z])(?=.*\d).+$/;

        if (!re.test(this.value) || this.value.length < 8) {
            this.setCustomValidity('Helytelen jelszó vagy túl rövid jelszó, Minta formátum Example123');
            this.reportValidity();
        }
        else {
            this.setCustomValidity('');
        }
    }
    if (this.id == "rin11") {
        var password = document.getElementById("rin10");
        if (this.value != password.value) {
            this.setCustomValidity('Két jelszó nem megegyező');
            this.reportValidity();

        }
        else {
            this.setCustomValidity('');
        }
    }
    if (this.id == "fin1") {
        let re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
        if (!re.test(this.value)) {
            this.setCustomValidity('Helytelen e-mail cím');
            this.reportValidity();
        }
        else {
            this.setCustomValidity('');
        }
    }



}
//keyup
function rkeyUpHandler(e) {

    if (this.id == "rin9") {
        var email = document.getElementById("in8");
        if (this.value != email.value) {
            this.style.color = 'red';

        }
        else {
            this.style.color = 'green';
        }
    }


    if (this.id == "rin11") {
        var password = document.getElementById("rin10");
        if (this.value != password.value) {
            this.style.color = 'red';

        }
        else {
            this.style.color = 'green';
        }
    }
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

    var form = $('elso');


    var inputs = document.querySelectorAll('input');
    inputs.forEach(function (input) {
        input.addEventListener("keyup", rkeyUpHandler, true);
        input.addEventListener("focus", rfocusHandler, true);
        input.addEventListener("blur", rblurHandler, true);
    })

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
            console.log(data);
        })
        .catch(function (error) {
            console.log(error);
        });

        */





}
