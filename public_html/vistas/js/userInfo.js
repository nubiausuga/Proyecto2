//function para obtener la información del usuario y rellenar los campos
//en la tabla de información
function getUserInfo() {


    $.get('../php/getUserInfo.php', function(data) {

        //alert(data);

        var json = JSON.parse(data);
        var nombre = json['Usr_Nombres'];
        var lastName = json['Usr_Apellidos'];
        var email = json['Usr_Correo'];
        var id = json['id_Doc_Identidad'];
        var balance = json['Balance'];
        var estado = json['Estado'];

        document.getElementById('r_name').innerHTML = nombre + " " + lastName;
        document.getElementById('r_code').innerHTML = id;
        document.getElementById('r_email').innerHTML = email;
        document.getElementById('r_balance').innerHTML = balance;

        if (estado == "Bloqueada") {
            document.getElementById('bloq_unbloq').innerHTML =
                    "Desbloquear Cuenta";
        }
        document.getElementById('r_estado').innerHTML =
                "Estado" + " " + "(" + estado + ")";

    });

}

function getEmplInfo() {

    $.get('../php/getEmplInfo.php', function(data) {

        //alert(data);

        var json = JSON.parse(data);
        var nombre = json['Usr_Nombres'];
        var lastName = json['Usr_Apellidos'];
        var email = json['Usr_Correo'];
        var id = json['id_Doc_Identidad'];
        var balance = json['Balance'];
        var estado = json['Estado'];
        var establecimiento = json['empl_Establecimiento'];
        var jobTitle = json['Str_Cargo'];

        document.getElementById('re_name').innerHTML = nombre + " " + lastName;
        document.getElementById('re_code').innerHTML = id;
        document.getElementById('re_email').innerHTML = email;
        document.getElementById('re_saldo').innerHTML = balance;
        document.getElementById('re_establecimiento').innerHTML =
                establecimiento;
        document.getElementById('re_cargo').innerHTML = jobTitle;

        if (estado == "Bloqueada") {
            document.getElementById('bloq_unbloq_re').innerHTML =
                    "Desbloquear Cuenta";
        }
        document.getElementById('re_estado').innerHTML =
                "Estado" + " " + "(" + estado + ")";

    });

}

