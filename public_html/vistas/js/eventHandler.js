//Mensajes Predeterminados
function messages(var1) {

    var msg = "oops";

    switch (var1) {
        case 'badPass':
            msg = "Oops, las contraseñas no coinciden,verificalas por favor.";
            break;
        case 'badStdID':
            msg = "Oops, código de estudiante erroneo, intentalo de nuevo";
            break;
        case 'okReg':
            msg = "Bienvenido, te has registrado exitosamente como estudiante!";
            break;
        case 'badEmail':
            msg = "Oops, por favor usa una dirección de correo válida!";
            break;
        case 'term':
            msg = "No has aceptado los términos y condiciones,\n\
                    por lo tanto no podrás  registrarte con nosotros";
            break;
        case 'failed':
            msg = "Oops... Ha ocurrido un error al registrarte como usuario,\n\
                      por favor llena todos los campos correctamente\n\
                        e intentalo de nuevo.";
            break;
        case 'wrongPass':
            msg = "¡Código de usuario o contraseña no válidos. Inténtalo de nuevo!.";
            break;
        default:
            msg = "Elige mensaje de error";
            break;
    }

    return msg;
}

//funcionalidad para verificar la existencia de posibles iguales
//en los campos de input, como medida de prevención.
function fieldSec(var1, var2) {
    var hasEqual = var1.indexOf("=");
    var hasEqual2 = var2.indexOf("=");

    if (hasEqual == -1 && hasEqual2 == -1) {
        return 0;
    } else {
        return -1;
    }

}

//funcionalidad para verificar la existencia de posibles ";"
//en los campos de input, como medida de prevención.
function fieldSemi(var1, var2) {
    var hasEqual = var1.indexOf(";");
    var hasEqual2 = var2.indexOf(";");

    if (hasEqual == -1 && hasEqual2 == -1) {
        return 0;
    } else {
        return -1;
    }
}

//funcionalidad para la verificación en el momento de logearse a la aplicación.
function loginUser() {

    var user = $('#loginUsername').val();
    var pass = $('#loginUserPassword').val();

    if (user === ' ' || pass === ' ') {
        var oldHTML = document.getElementById('errorRegMsg').innerHTML;
        var newHTML = messages("wrongPass");
        document.getElementById('errorRegMsg').innerHTML = newHTML;
        document.getElementById('errorLogMsg').style.visibility = 'visible';
    }

    var noE = fieldSec(user, pass);
    var noSemi = fieldSemi(user, pass);

    if (noE == -1 || noSemi == -1) {
        var oldHTML = document.getElementById('errorRegMsg').innerHTML;
        var newHTML = messages("wrongPass");
        document.getElementById('errorRegMsg').innerHTML = newHTML;
        document.getElementById('loginUserPassword').value = "";
        document.getElementById('loginUsername').value = "";

    } else {

        $.post('../php/LoginUser.php',
                {postname: user, postpass: pass},
        function(data) {
            //alert(data);

            if (data == 1) {
                document.getElementById('errorLogMsg').style.visibility = 'hidden';
                //alert("Welcome, Student");
                window.location = "WelcomeScreen.html";
            }
            if (data == 2) {
                document.getElementById('errorLogMsg').style.visibility = 'hidden';
                window.location = "WelcomeSE.html";
            }
            if (data == -1) {
                document.getElementById('errorLogMsg').style.visibility = 'visible';

            }

        });
    }

}

//TODO
function validateForm()
{
    var email = $('#reg_email').val();
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length)
    {
        return false;
    } else {
        return true;
    }

}

function passMatch(pass1, pass2) {

    var match = false;

    if (pass1 === pass2) {
        match = true;
    } else {
        match = false;
    }

    return match;
}

function regUser() {

    if (!validateForm()) {

        document.getElementById('reg_email').value = "";
        document.getElementById('errorRegMsg').innerHTML = messages("badEmail");
        document.getElementById('errorRegMsg').style.visibility = 'visible';

    } else {

        var docIdent = $('#reg_docIdent').val();
        var username = $('#reg_name').val();
        var lastname = $('#reg_lastname').val();
        var password = $('#reg_password').val();
        var email = $('#reg_email').val();
        var career = $('#reg_career').val();
        var repPass = $('#repPass').val();
        var acceptance = document.getElementById('reg_checkbox').checked;

        if (acceptance) {

            if (passMatch(password, repPass)) {

                $.post('../php/userReg.php',
                        {
                            postdoc: docIdent,
                            postuser: username,
                            postlastname: lastname,
                            postpass: password,
                            postemail: email,
                            postcareer: career
                        },
                function(data) {

                    if (data == -1) {

                        document.getElementById('errorRegMsg').style.visibility = 'visible';
                        var oldHTML = document.getElementById('errorRegMsg').innerHTML;
                        var newHTML = messages("badStdID");
                        document.getElementById('errorRegMsg').innerHTML = newHTML;
                        document.getElementById('reg_docIdent').value = "";

                    } else {
                        if (data == 0) {

                            document.getElementById('errorRegMsg').style.visibility = 'visible';
                            var oldHTML = document.getElementById('errorRegMsg').innerHTML;
                            var newHTML = messages("okReg");
                            document.getElementById('errorRegMsg').setAttribute("class: alert alert-success");
                            document.getElementById('errorRegMsg').innerHTML = newHTML;
                            clearFields();

                        } else {

                            document.getElementById('errorRegMsg').style.visibility = 'visible';
                            var oldHTML = document.getElementById('errorRegMsg').innerHTML;
                            var newHTML = messages("failed");
                            document.getElementById('errorRegMsg').innerHTML = newHTML;

                        }
                    }

                });

            } else {

                document.getElementById('errorRegMsg').style.visibility = 'visible';
                var oldHTML = document.getElementById('errorRegMsg').innerHTML;
                var newHTML = messages("badPass");
                document.getElementById('errorRegMsg').innerHTML = newHTML;
                document.getElementById('repPass').value = "";
            }

        } else {

            document.getElementById('errorRegMsg').style.visibility = 'visible';
            var oldHTML = document.getElementById('errorRegMsg').innerHTML;
            var newHTML = messages("term");
            document.getElementById('errorRegMsg').innerHTML = newHTML;
        }
    }

}

function clearFields() {

    document.getElementById('reg_docIdent').value = "";
    document.getElementById('reg_name').value = "";
    document.getElementById('reg_lastname').value = "";
    document.getElementById('reg_password').value = "";
    document.getElementById('reg_email').value = "";
    document.getElementById('reg_career').value = "";
    document.getElementById('repPass').value = "";

}

function regEmployee() {

    if (!validateForm()) {
        document.getElementById('reg_email').value = "";
        alert("Oops, por favor usa una dirección de correo válida!");
    } else {

        var docIdent = $('#reg_docIdent').val();
        var username = $('#reg_name').val();
        var lastname = $('#reg_lastname').val();
        var password = $('#reg_password').val();
        var email = $('#reg_email').val();
        var establishment = $('#reg_establishment').val();
        var jobTitle = $('#reg_jobTitle').val();
        var acceptance = document.getElementById('reg_checkbox').checked;
        if (acceptance) {

            $.post('../php/EmplReg.php',
                    {
                        postdoc: docIdent,
                        postuser: username,
                        postlastname: lastname,
                        postpass: password,
                        postemail: email,
                        postest: establishment,
                        postjob: jobTitle
                    },
            function(data) {

                if (data == -1) {
                    document.getElementById('errorRegMsg').style.visibility =
                            'hidden';
                    document.getElementById('reg_docIdent').value = "";
                    document.getElementById('wrongId').style.visibility =
                            'visible';
                } else {
                    if (data == 0) {
                        document.getElementById('wrongId').style.visibility =
                                'hidden';
                        document.getElementById('errorRegMsg').style.visibility =
                                'hidden';
                        document.getElementById('successfullReg').style.visibility =
                                'visible';
                    } else {
                        document.getElementById('errorRegMsg').style.visibility =
                                'hidden';
                        document.getElementById('wrongId').style.visibility =
                                'hidden';
                        document.getElementById('failedReg').style.visibility =
                                'visible';
                    }
                }
            });
        } else {
            document.getElementById('wrongId').style.visibility =
                    'hidden';
            document.getElementById('errorRegMsg').style.visibility =
                    'visible';
        }
    }
}


function estFieldVer() {

}

function regEstablishment() {

    var est_nit = $('#reg_nitEstablishment').val();
    var est_name = $('#reg_estName').val();
    var est_type = $('#reg_estType').val();
    var est_Responsable = $('#reg_estResponsible').val();
    var est_idResponsable = $('#reg_idResponsible').val();
    var acceptance = document.getElementById('reg_checkbox').checked;

    if (est_nit !== "" && est_name !== "" && est_type !== "" &&
            est_Responsable !== "" && est_idResponsable !== "" && acceptance) {
        document.getElementById('nonCFields').style.visibility = 'hidden';

        $.post('../php/EstablishmentReg.php',
                {
                    postnit: est_nit,
                    postname: est_name,
                    posttype: est_type,
                    postresponsible: est_Responsable,
                    postidresponsible: est_idResponsable
                },
        function(data) {
            alert(data);
        });

    } else {
        document.getElementById('nonCFields').style.visibility = 'visible';
    }

}

function regProducto() {


    var prod_id = $('#reg_idCode').val();
    var prod_description = $('#reg_description').val();
    var prod_value = $('#reg_valueSale').val();

    if (prod_id !== "" && prod_description !== "" && prod_value !== "") {
        document.getElementById('invalidField').style.visibility = 'hidden';


        $.post('../php/ProductReg.php',
                {
                    postid: prod_id,
                    postdescription: prod_description,
                    postvalue: prod_value
                },
        function(data) {
            //alert(data);
        });

    } else {
        document.getElementById('invalidField').style.visibility = 'visible';
    }

}

function actProducto() {

    var prod_id = $('#act_idCode').val();
    var prod_description = $('#act_description').val();
    var prod_value = $('#act_valueSale').val();

    if (prod_id !== "" && prod_description !== "" && prod_value !== "") {
        document.getElementById('invalidField').style.visibility = 'hidden';


        $.post('../php/ProductAct.php',
                {
                    postid: prod_id,
                    postdescription: prod_description,
                    postvalue: prod_value
                },
        function(data) {
            alert(data);
        });
        alert("entro boton" + prod_id + prod_description + prod_value);

    } else {
        document.getElementById('invalidField').style.visibility = 'visible';
    }

}
