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
    if (this.id == "in8") {
        let re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
        if (!re.test(this.value)) {
            this.setCustomValidity('Helytelen e-mail formátum, Minta formátum example@example.com');
            this.reportValidity();
        }
        else {
            this.setCustomValidity('');
        }
    }
    if (this.id == "in9") {
        var email = document.getElementById("in8");
        if (this.value != email.value) {
            this.setCustomValidity('Két e-mail nem megegyező');
            this.reportValidity();

        }
        else {
            this.setCustomValidity('');
        }
    }
    if (this.id == "in10") {
        let re = /^(?=.*[A-Z])(?=.*\d).+$/;

        if (!re.test(this.value) || this.value.length < 8) {
            this.setCustomValidity('Helytelen jelszó vagy túl rövid jelszó, Minta formátum Example123');
            this.reportValidity();
        }
        else {
            this.setCustomValidity('');
        }
    }
    if (this.id == "in11") {
        var password = document.getElementById("in10");
        if (this.value != password.value) {
            this.setCustomValidity('Két jelszó nem megegyező');
            this.reportValidity();

        }
        else {
            this.setCustomValidity('');
        }
    }

}
//keyup
function keyUpHandler(e) {
 
    if (this.id == "in9") {
        var email = document.getElementById("in8");
        if (this.value != email.value) {
            this.style.color = 'red';

        }
        else {
            this.style.color = 'green';
        }
    }


    if (this.id == "in11") {
        var password = document.getElementById("in10");
        if (this.value != password.value) {
            this.style.color = 'red';

        }
        else {
            this.style.color = 'green';
        }
    }

}
function setOptions() {
    let options = '<option value="None" selected required>Válasszon megyét</option>';
    for (let ix in megyek) {
        let o = '<option value="' + ix + '">' + megyek[ix] + "</option>\n";
        options += o;
    }
    let select = (document.getElementById("in3").innerHTML = options);

}


window.onload = function () {

    var form = $('elso');


    var inputs = document.querySelectorAll('input');
    inputs.forEach(function (input) {
        input.addEventListener("keyup", keyUpHandler, true);
        input.addEventListener("focus", focusHandler, true);
        input.addEventListener("blur", blurHandler, true);
    })



    setOptions();

}
var megyek = {
    Alba: "Alba",
    Arad: "Arad",
    Arges: "Argeș",
    Bacau: "Bacău",
    Bihor: "Bihor",
    "Bistrita Nasaud": "Bistrița Năsaud",
    Botosani: "Botoșani",
    Brasov: "Brașov",
    Braila: "Brăila",
    Bucuresti: "București",
    Buzau: "Buzău",
    "Caras Severin": "Caraș Severin",
    Calarasi: "Calarași",
    Cluj: "Cluj",
    Constanta: "Constanța",
    Covasna: "Covasna",
    Dambovita: "Dambovița",
    Dolj: "Dolj",
    Galati: "Galați",
    Giurgiu: "Giurgiu",
    Gorj: "Gorj",
    Harghita: "Harghita",
    Hunedoara: "Hunedoara",
    Ialomita: "Ialomița",
    Iasi: "Iași",
    Ilfov: "Ilfov",
    Maramures: "Maramureș",
    Mehedinti: "Mehedinți",
    Mures: "Mureș",
    Neamt: "Neamț",
    Olt: "Olt",
    Prahova: "Prahova",
    "Satu Mare": "Satu Mare",
    Salaj: "Sălaj",
    Sibiu: "Sibiu",
    Suceava: "Suceava",
    Teleorman: "Teleorman",
    Timis: "Timiș",
    Tulcea: "Tulcea",
    Vaslui: "Vaslui",
    Valcea: "Valcea",
    Vrancea: "Vrancea",
};