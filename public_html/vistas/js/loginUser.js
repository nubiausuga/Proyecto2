function login(){
    var name = document.getElementById("userName").value;
    var pass = document.getElementById("userPassword").value;
    
    xmlhttp.open("GET","LoginUser.php?",true);
    xmlhttp.send();
    
 }


