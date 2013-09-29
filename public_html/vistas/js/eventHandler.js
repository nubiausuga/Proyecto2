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
    if (user === '' || pass === '') {
        document.getElementById('errorLogMsg').style.visibility = 'visible';
    }

    var noE = fieldSec(user, pass);
    var noSemi = fieldSemi(user, pass);

    if (noE == -1 || noSemi == -1) {
        document.getElementById('errorLogMsg').style.visibility = 'visible';
        document.getElementById('loginUserPassword').value = "";
        document.getElementById('loginUsername').value = "";
    } else {

        $.post('../php/LoginUser.php',
                {postname: user, postpass: pass},
        function(data) {
            //alert(data);

            if (data == 1) {
                document.getElementById('errorLogMsg').style.visibility = 'hidden';
                alert("Welcome, Student");
            }
            if (data == 2) {
                document.getElementById('errorLogMsg').style.visibility = 'hidden';
                alert("Welcome, Employee");
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

function regUser() {

    if (!validateForm()) {
        document.getElementById('reg_email').value = "";
        alert("Oops, por favor usa una dirección de correo válida!");
    } else {

        var docIdent = $('#reg_docIdent').val();
        var username = $('#reg_name').val();
        var lastname = $('#reg_lastname').val();
        var password = $('#reg_password').val();
        var email = $('#reg_email').val();
        var career = $('#reg_career').val();
        var acceptance = document.getElementById('reg_checkbox').checked;
        if (acceptance) {

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
                // alert(data);

                if (data == -1) {
                    document.getElementById('invalidStudentID').style.visibility =
                            'visible';
                    document.getElementById('reg_docIdent').value = "";
                } else {
                    if (data == 0) {
                        document.getElementById('invalidStudentID').style.visibility =
                                'hidden';
                        document.getElementById('errorRegMsg').style.visibility =
                                'hidden';
                        document.getElementById('successfullReg').style.visibility =
                                'visible';
                        clearFields();
                    } else {
                        document.getElementById('invalidStudentID').style.visibility =
                                'hidden';
                        document.getElementById('errorRegMsg').style.visibility =
                                'hidden';
                        document.getElementById('failedReg').style.visibility =
                                'visible';
                    }
                }

            });
        } else {
            document.getElementById('invalidStudentID').style.visibility =
                    'hidden';
            document.getElementById('errorRegMsg').style.visibility =
                    'visible';
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
