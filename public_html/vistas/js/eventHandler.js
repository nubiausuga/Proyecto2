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
        case 'prodFail':
            msg = "Oops... Ha ocurrido un error al registrar el producto,\n\
                    por favor intentelo de nuevo.";
            break;
        case 'wrongPass':
            msg = "¡Código de usuario o contraseña no válidos. Inténtalo de nuevo!.";
            break;
        case 'emptyFields':
            msg = "Por favor llene todos los campos antes de continuar.";
            break;
        case 'wrongPlace':
            msg = "Ese usuario no corresponde a esta sesión,\n\
                   por favor intentelo de nuevo";
            break;
        case 'wrongCode':
            msg = "Oops, el código debe existir, por favor\n\
                    verifica el código de producto e intentalo de nuevo";
            break;
        case 'errorLogMsg':
            msg = "Error al verificar los datos, por favor intentelo de nuevo";
            break;
        case 'notNumeric':
            msg = "Los Campos de Código Producto y Valor Venta deben ser numéricos\n\
                    por favor verifica e intentalo de nuevo.";
            break;
        case 'okNewProduct':
            msg = "El producto nuevo ha sido registrado éxitosamente en la \n\
                    base de datos.";
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
                document.getElementById('errorLogMsg').style.visibility
                        = 'hidden';
                //alert("Welcome, Student");
                window.location = "WelcomeScreen.html";
            }
            if (data == 2) {
                document.getElementById('errorLogMsg').style.visibility
                        = 'hidden';
                window.location = "WelcomeSE.html";
            }
            if (data == -1) {
                document.getElementById('errorLogMsg').style.visibility 
                        = 'visible';

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

                                    document.getElementById('errorRegMsg').style.visibility = 'hidden';
                                    //var oldHTML = document.getElementById('errorRegMsg').innerHTML;
                                    // var newHTML = messages("okReg");
                                    alert("Te has registrado Exitosamente!");
                                    //clearFields();
                                    window.location = "../index.html";

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
                document.getElementById('reg_password').value = "";
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

function isNum(par1) {
    return !isNaN(parseFloat(par1)) && isFinite(par1);
}

function clearFProd() {

    document.getElementById('reg_idCode').value = "";
    document.getElementById('reg_description').value = "";
    document.getElementById('reg_valueSale').value = "";
    document.getElementById('reg_brand').value = "";

}

function regProducto() {

    var prod_id = $('#reg_idCode').val();
    var prod_description = $('#reg_description').val();
    var prod_value = $('#reg_valueSale').val();
    var prod_marca = $('#reg_brand').val();
    var oldHTML = "";
    var newHTML = "";

    if (prod_id !== "" && prod_description !== "" &&
            prod_value !== "" && prod_marca !== "") {

        if (isNum(prod_id) && isNum(prod_value)) {
            document.getElementById('errorRegMsg').style.visibility = 'hidden';
            $.post('../php/ProductReg.php',
                    {
                        postid: prod_id,
                        postdesc: prod_description,
                        postvalue: prod_value,
                        postmarca: prod_marca
                    },
            function(data) {
                //alert(data);
                if (data == 0) {
                    document.getElementById('errorRegMsg').style.visibility
                            = 'hidden';
                    document.getElementById('okRegMsg').style.visibility
                            = 'visible';
                    oldHTML = document.getElementById('okRegMsg').innerHTML;
                    newHTML = messages("okNewProduct");
                    document.getElementById('okRegMsg').innerHTML = newHTML;
                    clearFProd();

                } else {
                    document.getElementById('errorRegMsg').style.visibility =
                            'hidden';
                    document.getElementById('errorRegMsg').style.visibility =
                            'visible';
                    oldHTML = document.getElementById('errorRegMsg').innerHTML;
                    newHTML = messages("prodFail");
                    document.getElementById('errorRegMsg').innerHTML = newHTML;
                }
            });
        } else {

            document.getElementById('errorRegMsg').style.visibility = 'visible';
            oldHTML = document.getElementById('errorRegMsg').innerHTML;
            newHTML = messages("notNumeric");
            document.getElementById('errorRegMsg').innerHTML = newHTML;
        }

    } else {

        document.getElementById('errorRegMsg').style.visibility = 'visible';
        oldHTML = document.getElementById('errorRegMsg').innerHTML;
        newHTML = messages("emptyFields");
        document.getElementById('errorRegMsg').innerHTML = newHTML;
    }

}

//clear update product fields
function clearUpdProd() {

    document.getElementById('act_idCode').value = "";
    document.getElementById('act_description').value = "";
    document.getElementById('act_valueSale').value = "";
    document.getElementById('act_brand').value = "";
}

//función para actualizar los datos de un producto registrado
function actProducto() {

    var prod_id = $('#act_idCode').val();
    var prod_description = $('#act_description').val();
    var prod_value = $('#act_valueSale').val();
    var prod_brand = $('#act_brand').val();
    var oldHTML = "";
    var newHTML = "";

    if (prod_id !== "" && prod_description !== "" &&
            prod_value !== "" && prod_brand !== "") {

        if (isNum(prod_id) && isNum(prod_value)) {

            $.post('../php/ProductAct.php',
                    {
                        postid: prod_id,
                        postdesc: prod_description,
                        postvalue: prod_value,
                        postbrand: prod_brand
                    },
            function(data) {

                if (data == 0) {
                    document.getElementById('actProdMsg').style.visibility =
                            'hidden';
                    document.getElementById('actProdOk').style.visibility =
                            'visible';
                    oldHTML = document.getElementById('actProdOk').innerHTML;
                    newHTML = messages("okNewProduct");
                    document.getElementById('actProdOk').innerHTML = newHTML;
                    clearUpdProd();

                } else if (data == 1) {
                    document.getElementById('actProdOk').style.visibility =
                            'hidden';
                    document.getElementById('actProdMsg').style.visibility =
                            'visible';
                    oldHTML = document.getElementById('actProdMsg').innerHTML;
                    newHTML = messages("wrongCode");
                    document.getElementById('actProdMsg').innerHTML = newHTML;
                } else {
                    document.getElementById('actProdOk').style.visibility =
                            'hidden';
                    document.getElementById('actProdMsg').style.visibility =
                            'visible';
                    oldHTML = document.getElementById('actProdMsg').innerHTML;
                    newHTML = messages("prodFail");
                    document.getElementById('actProdMsg').innerHTML = newHTML;
                }
            });
        } else {
            document.getElementById('actProdMsg').style.visibility = 'visible';
            oldHTML = document.getElementById('actProdMsg').innerHTML;
            newHTML = messages("notNumeric");
            document.getElementById('actProdMsg').innerHTML = newHTML;
        }

    } else {
        document.getElementById('actProdMsg').style.visibility = 'visible';
        oldHTML = document.getElementById('actProdMsg').innerHTML;
        newHTML = messages("emptyFields");
        document.getElementById('actProdMsg').innerHTML = newHTML;
    }

}

//verificación para poder cambiar el estado de la cuenta 
// a bloqueada o activada.
function blocVerification() {

    var user = $('#ver_code').val();
    var pass = $('#ver_pass').val();

    if (!user || !pass) {
        var oldHTML = document.getElementById('errorRegMsg').innerHTML;
        var newHTML = messages("emptyFields");
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
                bloqueo(user);
                alert("Estado de cuenta modificado exitosamente!");
                window.location = "userBasicInfo.html";
            }
            if (data == 2) {
                document.getElementById('errorLogMsg').style.visibility = 'hidden';
                var oldHTML = document.getElementById('errorRegMsg').innerHTML;
                var newHTML = messages("wrongPlace");
                document.getElementById('errorRegMsg').innerHTML = newHTML;
            }
            if (data == -1) {
                var oldHTML = document.getElementById('errorRegMsg').innerHTML;
                var newHTML = messages("errorLogMsg");
                document.getElementById('errorRegMsg').innerHTML = newHTML;

            }

        });
    }
}

//Para bloquear o desbloquear una cuenta dependiendo de su estado actual.
function bloqueo(id) {

    $.post('../php/bloqCuenta.php', {postId: id},
    function(data) {
        //  alert(data);
    });
}

function getProdInfo() {

    var code = $('#act_idCode').val();

    if (isNum(code)) {
        $.post('../php/getProdInfo.php',
                {postcode: code},
        function(data) {


            var json = JSON.parse(data);
            if (!json) {
                clearUpdProd();
            } else {
                var prodDesc = json['Prod_Descripcion'];
                var price = json['Prod_ValorUnitario'];
                var brand = json['Prod_Marca'];

                document.getElementById('act_description').value = prodDesc;
                document.getElementById('act_valueSale').value = price;
                document.getElementById('act_brand').value = brand;

            }

        });
    } else {
        clearUpdProd();
    }

}