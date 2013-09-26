function loginUser() {
    var user = $('#loginUsername').val();
    var pass = $('#loginUserPassword').val();


    $.post('../php/LoginUser.php',
            {postname: user, postpass: pass},
    function(data) {
        if (data === "0") {
            document.getElementById('errorLogMsg').style.visibility = 'hidden';
            alert("Welcome!!");
        } else {
            document.getElementById('errorLogMsg').style.visibility = 'visible';
        }
    });
}

function regUser() {

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

            if (data === "0") {
                document.getElementById('errorRegMsg').style.visibility = 'hidden';
                alert("Te has registrado Satisfactoriamente!!");

            } else {
                document.getElementById('errorRegMsg').style.visibility = 'hidden';
                alert("Error al registrar usuario,\n\
                        por favor intentelo de nuevo.");
            }
        });
    } else {
        document.getElementById('errorRegMsg').style.visibility = 'visible';
    }

}

function regEmployee() {

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

            if (data == "0") {
                document.getElementById('errorRegMsg').style.visibility = 'hidden';
                alert("Te has registrado Satisfactoriamente!!");

            } else {
                document.getElementById('errorRegMsg').style.visibility = 'hidden';
                alert("Error al registrar usuario,\n\
                        por favor intentelo de nuevo.");
            }
        });
    } else {
        document.getElementById('errorRegMsg').style.visibility = 'visible';
    }

}