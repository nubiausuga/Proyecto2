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
        case 'badEID':
            msg = "Oops, el código de identificación no es válido, \n\
                    favor ingresar su número de cédula correctamente.";
            break;
        case 'okReg':
            msg = "Bienvenido, te has registrado exitosamente como estudiante!";
            break;
        case 'badEmail':
            msg = "Oops, por favor usa una dirección de correo válida!";
            break;
        case 'okNewEstablishment':
            msg = "Se ha agregado un nuevo establecimiento éxitosamente.";
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
        case 'nitError':
            msg = "El Nit es erroneo, por favor verificar e intentarlo de nuevo.\n\
                   <br> El formato NIT son 10 números con este formato: XXX.XXX.XXX-Y";
            break;
        case 'fondosI':
            msg = "Lo sentimos, tiene fondos insuficientes para agregar el \n\
                    producto seleccionado.";
            break;
        case 'establishmentFail':
            msg = "Ha ocurrido un error al crear el nuevo establecimiento,\n\
                    por favor intentelo de nuevo.";
            break;
        case 'successPurchase':
            msg = "Se ha efectuado la compra exitosamente, puede continuar con\n\
                    el siguiente cliente.";
            break;
        case 'errPurchase':
            msg = "Ha ocurrido un error para efectuar la compra, por intentelo\n\
                    de nuevo más tarde.";
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

function getUserInfoHand(data) {

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
                //document.getElementById('errorLogMsg').style.visibility
                //        = 'visible';
                window.location = "../index.html";

            }
            if(data == 3){
                document.getElementById('errorLogMsg').style.visibility
                        = 'hidden';
                window.location="adminInfoDisplay.html";
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
        document.getElementById('errorRegMsg').innerHTML = messages("badEmail");
        document.getElementById('errorRegMsg').style.visibility = 'visible';
    } else {

        var docIdent = $('#reg_docIdent').val();
        var username = $('#reg_name').val();
        var lastname = $('#reg_lastname').val();
        var password = $('#reg_password').val();
        var repass = $('#reg_password2').val();
        var email = $('#reg_email').val();
        var establishment = $('#reg_establishment').val();
        var jobTitle = $('#reg_jobTitle').val();
        var acceptance = document.getElementById('reg_checkbox').checked;
        var oldHTML = "";
        var newHTML = "";

        if (acceptance) {

            if (passMatch(password, repass)) {

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
                        //wrong ID
                        document.getElementById('errorRegMsg').style.visibility =
                                'visible';
                        oldHTML = document.getElementById('errorRegMsg').innerHTML;
                        newHTML = messages("badEID");
                        document.getElementById('errorRegMsg').innerHTML = newHTML;
                    } else {
                        if (data == 0) {
                            //successfull reg
                            document.getElementById('errorRegMsg').style.visibility =
                                    'hidden';
                            alert("Se ha registrado exitosamente");
                            window.location = "../index.html";
                        } else {
                            //uknown error
                            document.getElementById('errorRegMsg').style.visibility =
                                    'visible';
                            oldHTML = document.getElementById('errorRegMsg').innerHTML;
                            newHTML = messages("failed");
                            document.getElementById('errorRegMsg').innerHTML = newHTML;
                        }
                    }
                });

            } else {
                //passwords don't match
                document.getElementById('errorRegMsg').style.visibility =
                        'visible';
                oldHTML = document.getElementById('errorRegMsg').innerHTML;
                newHTML = messages("badPass");
                document.getElementById('errorRegMsg').innerHTML = newHTML;
                document.getElementById('repPass').value = "";
                document.getElementById('reg_password').value = "";

            }

        } else {
            //accept terms
            document.getElementById('errorRegMsg').style.visibility = 'visible';
            oldHTML = document.getElementById('errorRegMsg').innerHTML;
            newHTML = messages("term");
            document.getElementById('errorRegMsg').innerHTML = newHTML;
        }
    }
}


function estFieldVer(nit) {

    var regex = new RegExp("[1-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{1}");

    if (regex.test(nit)) {
        return true;
    } else {
        return false;
    }

}

function clearFEstablishment() {

    document.getElementById('reg_nitEstablishment').value = "";
    document.getElementById('reg_estName').value = "";
    document.getElementById('reg_estType').value = "";
    document.getElementById('reg_estResponsible').value = "";
    document.getElementById('reg_idResponsible').value = "";
}

function regEstablishment() {

    var est_nit = $('#reg_nitEstablishment').val();
    var est_name = $('#reg_estName').val();
    var est_type = $('#reg_estType').val();
    var est_Responsable = $('#reg_estResponsible').val();
    var est_idResponsable = $('#reg_idResponsible').val();
    var acceptance = document.getElementById('reg_checkbox').checked;
    var oldHTML = "";
    var newHTML = "";

    if (est_nit !== "" && est_name !== "" && est_type !== "" &&
            est_Responsable !== "" && est_idResponsable !== "") {

        if (acceptance) {

            if (estFieldVer(est_nit)) {
                //going well

                $.post('../php/EstablishmentReg.php',
                        {
                            postnit: est_nit,
                            postname: est_name,
                            posttype: est_type,
                            postresponsible: est_Responsable,
                            postidresponsible: est_idResponsable
                        },
                function(data) {

                    if (data == 0) {
                        //success
                        document.getElementById('errorRegMsg').style.visibility
                                = 'hidden';
                        document.getElementById('okRegMsg').style.visibility
                                = 'visible';
                        oldHTML = document.getElementById('okRegMsg').innerHTML;
                        newHTML = messages("okNewEstablishment");
                        document.getElementById('okRegMsg').innerHTML = newHTML;
                        clearFEstablishment();
                    } else {
                        //failure
                        document.getElementById('okRegMsg').style.visibility =
                                'hidden';
                        document.getElementById('errorRegMsg').style.visibility =
                                'visible';
                        oldHTML = document.getElementById('errorRegMsg').innerHTML;
                        newHTML = messages("establishmentFail");
                        document.getElementById('errorRegMsg').innerHTML = newHTML;
                    }
                });

            } else {
                //invalid nit
                document.getElementById('errorRegMsg').style.visibility =
                        'visible';
                oldHTML = document.getElementById('errorRegMsg').innerHTML;
                newHTML = messages("nitError");
                document.getElementById('errorRegMsg').innerHTML = newHTML;

            }

        } else {
            //accept terms first
            document.getElementById('errorRegMsg').style.visibility = 'visible';
            oldHTML = document.getElementById('errorRegMsg').innerHTML;
            newHTML = messages("term");
            document.getElementById('errorRegMsg').innerHTML = newHTML;
        }

    } else {
        //empty fields
        document.getElementById('errorRegMsg').style.visibility = 'visible';
        oldHTML = document.getElementById('errorRegMsg').innerHTML;
        newHTML = messages("emptyFields");
        document.getElementById('errorRegMsg').innerHTML = newHTML;
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
                document.getElementById('errorLogMsg').style.visibility =
                        'hidden';
                bloqueo(user);
                alert("Estado de cuenta modificado exitosamente!");
                window.location = "userBasicInfo.html";
            }
            if (data == 2) {
                document.getElementById('errorLogMsg').style.visibility =
                        'hidden';
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

function close() {

    $.post('../php/closeS.php',
            function(data) {

                if (data == 0) {
                    window.location = "../index.html";
                }

            });
}

function inOrOut() {

    $.post('../php/verifyLog.php',
            function(data) {

                if (data != 1) {
                    window.location = "LoginUsuario.html";
                }

            });
}

var lproduct = [];
var total = 0;
var realBalance = 0;
var rema = 0;

function addItem() {

    var code = $('#Cod_Carnet').val();
    var product = $('#cod_producto').val();
    var quantity = $('#num_cantidad').val();

    if (code !== "" && product !== "" && quantity !== "") {

        //product list
        lproduct.push(product);
        lproduct.push(quantity);

        $.post('../php/addItem.php',
                {postcode: code, postproduct: product, postq: quantity},
        function(data) {
            //alert(data);
            if (data == -1) {
                alert("oops wrong id");
            } else {

                var json = JSON.parse(data);
                var balance = json['SaldoActual'];
                var prodPrice = json['PrecioProducto'];
                var nameProd = json['NombreProducto'];
                var quantity = json['Q'];
                var remains = json['Remain'];

                realBalance = Number(balance);
                total = total + (Number(prodPrice) * quantity);
                rema = realBalance - total;

                //add new items
                var oldHTML = document.getElementById('tbodyProducto').innerHTML;
                var newHTML = "<tr><th> " + nameProd + " </th><td>" + prodPrice +
                        "</td><td>" + quantity + "</td></tr>";
                document.getElementById('tbodyProducto').innerHTML =
                        oldHTML + newHTML;
                //refresh total
                var oldHTML = document.getElementById('totalPrice').innerHTML;
                var newHTML = "$" + total;
                document.getElementById('totalPrice').innerHTML = newHTML;

                var oldHTML = document.getElementById('remainsVal').innerHTML;
                var newHTML = "$" + (rema);
                document.getElementById('remainsVal').innerHTML = newHTML;

            }

        });

    } else {
        //empty fields error
        alert(messages("emptyFields"));
    }

}

function addItem2() {

    var code = $('#Cod_Carnet').val();
    var product = $('#cod_producto').val();
    var quantity = $('#num_cantidad').val();

    if (code !== "" && product !== "" && quantity !== "") {

        $.post('../php/addItem.php',
                {postcode: code, postproduct: product, postq: quantity},
        function(data) {
            //alert(data);
            if (data == -1) {
                alert("oops wrong id");
            } else {

                var json = JSON.parse(data);
                var balance = json['SaldoActual'];
                var prodPrice = json['PrecioProducto'];
                var nameProd = json['NombreProducto'];
                var quantity = json['Q'];
                var remains = json['Remain'];

                realBalance = Number(balance);
                total = total + (Number(prodPrice) * quantity);
                rema = realBalance - total;

                if (rema > 0) {
                    document.getElementById('foot_msg').style.visibility =
                            'hidden';
                    //product list
                    lproduct.push(nameProd);
                    lproduct.push(prodPrice);
                    lproduct.push(quantity);

                    document.getElementById('cod_producto').value = "";
                    document.getElementById('num_cantidad').value = "";

                    actualList();
                } else {
                    //alert("Fondos insuficientes para agregar el producto!");
                    document.getElementById('foot_msg').style.visibility =
                            'visible';
                    var oldHTML = document.getElementById('foot_msg').innerHTML;
                    var newHTML = messages("fondosI");
                    document.getElementById('foot_msg').innerHTML = newHTML;

                    document.getElementById('cod_producto').value = "";
                    document.getElementById('num_cantidad').value = "";
                }

            }

        });

    } else {
        //empty fields error
        alert(messages("emptyFields"));
        var oldHTML = document.getElementById('foot_msg').innerHTML;
        var newHTML = messages("emptyFields");
        document.getElementById('foot_msg').innerHTML = newHTML;
    }

}

function actualList() {

    var oldHTML = document.getElementById('tbodyProducto').innerHTML;
    for (var i = 0; i < lproduct.length; i += 3) {

        //refresh list, add new items
        newHTML = "<tr><th> " + lproduct[i] + " </th><td>" +
                lproduct[i + 1] + "</td><td>" + lproduct[i + 2] + "</td></tr>";
        document.getElementById('tbodyProducto').innerHTML = oldHTML + newHTML;

        //refresh total
        var newHTML = "$" + total;
        document.getElementById('totalPrice').innerHTML = newHTML;

        //refresh remaining
        var newHTML = "$" + (realBalance - total);
        document.getElementById('remainsVal').innerHTML = newHTML;

    }
}

function delFromList() {
    //TODO, problems occured
    /*
     delete lproduct[lproduct.length-1];
     delete lproduct[lproduct.length-2];
     delete lproduct[lproduct.length-3];
     
     lproduct.splice(lproduct.length-3,3);
     
     //refresh fields
     var table = document.getElementById('listTable');
     var rowCount = table.rows.length;
     alert(rowCount);
     //actualList(lproduct);
     */
}

function readCarnet() {

    $.post('../php/readCarnet.php',
            function(data) {
                document.getElementById('Cod_Carnet').value = data;
            });
}

setInterval(readCarnet(),2000);

function buyAll() {

    var list = lproduct;
    var prodName = [];
    var prices = [];
    var quantities = [];
    var total = 0;

    var currentCode = $('#Cod_Carnet').val();

    for (var i = 0; i < list.length; i += 3) {
        prodName[i] = lproduct[i];
        //alert(prodName[i]);
    }

    //splicing
    //prodName.splice(1,2);
    //prodName.splice(2,2);
    //prodName.splice(3,2);
    for (var j = 0; j < (list.length / 3); j++) {
        prodName.splice(j + 1, 2);
    }

    for (var b = 0; b < list.length; b += 3) {
        quantities[b] = lproduct[b + 2];
        //alert(quantities[b]);
    }

    //splicing quantities
    for (var b = 0; b < (list.length / 3); b++) {
        quantities.splice(b + 1, 2);
        //alert(quantities[b]);
    }
    //alert(list);
    for (var k = 0; k < list.length; k += 3) {
        prices[k] = lproduct[k + 1];
    }

    //splicing
    for (var l = 0; l < (list.length / 3); l++) {
        prices.splice(l + 1, 2);
    }

    for (var a = 0; a < prices.length; a++) {
        total += (prices[a] * quantities[a]);
    }

    //alert(total);

    $.post('../php/buyAll.php',
            {postProd: prodName, postPrices: prices, postcode: currentCode,
                posttotal: total},
    function(data) {
        //alert(data);
        if (data == 0) {
            //successfull purchase
            document.getElementById('foot_msg').style.visibility =
                    'hidden';
            document.getElementById('okPurchase').style.visibility =
                    'visible';
            oldHTML = document.getElementById('okPurchase').innerHTML;
            newHTML = messages("successPurchase");
            document.getElementById('okPurchase').innerHTML = newHTML;
            //clear All Up
            newPurchaseClear();
        } else {
            document.getElementById('okPurchase').style.visibility =
                    'hidden';
            document.getElementById('foot_msg').style.visibility =
                    'visible';
            oldHTML = document.getElementById('foot_msg').innerHTML;
            newHTML = messages("errPurchase");
            document.getElementById('foot_msg').innerHTML = newHTML;
        }
    });

}

//resetear todos los campos del form para preparar la nueva compra
function newPurchaseClear() {

    //clear fields
    document.getElementById('Cod_Carnet').value = "";
    document.getElementById('cod_producto').value = "";
    document.getElementById('num_cantidad').value = "";

    //clear lists
    var oldHTML = document.getElementById('tbodyProducto').innerHTML;
    var newHTML = " ";
    document.getElementById('tbodyProducto').innerHTML = newHTML;

    var oldHTML = document.getElementById('totalPrice').innerHTML;
    var newHTML = "Total = $0";
    document.getElementById('totalPrice').innerHTML = newHTML;

    var oldHTML = document.getElementById('remainsVal').innerHTML;
    var newHTML = " ";
    document.getElementById('remainsVal').innerHTML = newHTML;

    //hide messages
    //document.getElementById('okPurchase').style.visibility = 'hidden';
    document.getElementById('foot_msg').style.visibility = 'hidden';

    //reset vars
    lproduct = [];
    total = 0;
    realBalance = 0;
    rema = 0;

}

//--------------Business Intelligence--------------------------------------//

function getFacturasByFecha() {

    var fechaIni = $('#int_fechaIni').val();
    var fechaFinal = $('#int_fechaFin').val();

    if (fechaIni !== "" && fechaFinal !== "") {

        $.post('../php/BI_getFacturasByFecha.php',
                {postini: fechaIni, postfin: fechaFinal},
        function(data) {
            alert(data);
        });

    } else {
        alert("por favor digitar las fecha inicial y final en los campos de abajo");
    }

}

function getEstudiantesByEstablecimiento() {
    
     $.get('../php/BI_getEstByEstable.php',
     function(data) {
     alert(data);
     });
     
}

function getComprasEstudiantes() {

    var idEstudiante = $('#int_codigo').val();

    if (idEstudiante !== "") {

        $.post('../php/BI_getComprasEstudiante.php',
                {postidEst: idEstudiante},
        function(data) {
            alert(data);
        });

    } else {
        alert("Por favor, digitar el código del usuario abajo");
    }
}

function getProdPorFactura() {

    var idFactura = $('#int_idFactura').val();

    if (idFactura !== "") {
        $.post('../php/BI_getProdsPorFactura.php',
                {postid: idFactura},
        function(data) {
            alert(data);
        });
    } else {
        alert("por favor llenar el campo con el id de factura abajo previamente");
    }
}

function getAVGEstByID() {
    
$.get('../php/BI_getAvgEstablecimiento.php',
            function(data) {
                alert("El promedio de ventas del establecimiento es de : $"+ data);
            });
            
}

function getProdsVenMes() {

    var fechaIni = $('#int_fechaIni').val();
    var fechaFinal = $('#int_fechaFin').val();

    if (fechaIni !== "" && fechaFinal !== "") {
        $.post('../php/BI_getProdsVenMes.php',
                {postini: fechaIni, postfin: fechaFinal},
        function(data) {
            alert(data);
        });
    } else {
        //empty fields
        alert("Por favor digite las fechas deseadas en los campos de abajo");
    }
}

function countFacturas() {

$.get('../php/BI_getCountFacturas.php',
            function(data) {
                alert(data);
            });
            
}

function getCualesProdEstablecimiento() {

 $.get('../php/BI_getCualesProdVendidos.php',
            function(data) {
                alert(data);
            });
            
}

function getNumeroProdEstablecimiento() {

 $.get('../php/BI_getNumProdVendidos.php',
            function(data) {
                alert(data);
            });
            
}

function getCualesProd() {
    
    $.get('../php/BI_getCualesProdMarca.php',
            function(data) {
                alert("Los productos del establecimiento por marca son: " + data);
            });

}

function getCountProd() {

    $.get('../php/BI_getCountProdMarca.php',
            function(data) {
                alert(data);
            });

}

function getValorVentaTarjeta() {

    $.get('../php/BI_getValorTarjeta.php',
        function(data){
            alert("El establecimiento ha tenido un total de ventas de: $"+data+
                    " a través de la aplicación.");
        });
}