function getReservation() {

    var code= document.getElementById("userCode").value;
    var sunday= document.getElementById("sunday").value;
    if (code == "") { // valida cantidad de caracteres tambien
        alert("Ingrese un codigo valido.");
    } else {
        $.post("conn.php",
        {codeUser: code, 
        dateEvent: getNextSunday()
    },
         function (response) {
            document.getElementById("message").innerHTML =toUpperCase(response);
            console.log(response);
        });
    }
}

function getNextSunday() {
    var now = new Date();
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    now.setDate(now.getDate() + (7 + (7 - now.getDay())) % 7);
    var parsedDate = now.toLocaleDateString("es-AR", options);
    var stringDate = parsedDate.toString().replace(',', '');
    
    return stringDate.toUpperCase();
}
