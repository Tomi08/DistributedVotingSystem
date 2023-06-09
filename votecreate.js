function gomb(e) { // e az eseményobjektum

    let form = this.form; //a this a button elemre mutat
                  //minden input elemen van egy form nevű referencia
                  //az őt tartalmazó űrlapra

    let kerdes = Number(form.ezakerdes.value); // a két szám konvertálva

    if (isNaN(kerdes)) {
        kiIr("Bemenet hiányzik!");
        return false;
    }

    

    
}

windows.onload = function() {
    let form = $("eredmeny");
    $("gomb").addEventListener("click", gomb, false);
}