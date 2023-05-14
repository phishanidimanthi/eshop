function changeView() {

    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}

function signUp() {
    var f = document.getElementById("f");
    var l = document.getElementById("l");
    var e = document.getElementById("e");
    var p = document.getElementById("p");
    var m = document.getElementById("m");
    var g = document.getElementById("g");

    var form = new FormData;
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "success") {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msg").className = "bi bi-check2-circle fs-5";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msgdiv").className = "d-block";
            }

        }
    }

    request.open("POST", "signUpProcess.php", true);
    request.send(form);
}

function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();

    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest(); //form data tika gannawa

    r.onreadystatechange = function () { //ready state eka balanwa
        if (r.readyState == 4) { // state eka 4ta samanda balnwa
            var t = r.responseText;
            if (t == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }
        }
    };
    r.open("POST", "signInProcess.php", true); //post eken yawanna true -> AJAX walin
    r.send(f); //data tika yawanwa
}

// modal eka ganna wede 
var bm;   //global variable ... ona thenakin access karanna puluwn

function forgotPassword() {   //forgot psw click karma

    var email = document.getElementById("email2"); //email eke id eka gannawa

    var r = new XMLHttpRequest(); //data gannawa

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {

                alert("Verfication code has sent to your email. Please check your inbox.");

                var m = document.getElementById("forgotPasswordModal");  //id eka gannawa
                bm = new bootstrap.Modal(m);  //aluth boostrap object ekk hadanwa m kiyla eywa bm ta assign karnwa 
                bm.show();

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true); // GET method eken email eke value eka url ekath ekka bind karn arn yanwa
    r.send(); // data eka yawanwa
}

//modal eke show psw ekata adalawa
function ShowPassword1(){
    var i = document.getElementById("npi"); //
    var btn = document.getElementById("npb");
    var eye = document.getElementById("e1");

    if(i.type == "password"){ //type eka psw da balnwa
        i.type = "text"; //psw nm eka text karnwa
        eye.className = "bi bi-eye-fill"; //psw show icon eka
    }else{
        i.type = "password"; //type eka psw karnwa
        eye.className = "bi bi-eye-slash-fill"; // psw hide icon eka
    }
}

function ShowPassword2(){
    var i = document.getElementById("rnp");
    var btn = document.getElementById("rnpb"); 
    var eye = document.getElementById("e2");

    if(i.type == "password"){
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    }else{
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }
}

function resetpw(){
    var email = document.getElementById("email2");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");

    var f = new FormData();
    f.append("e",email.value);
    f.append("n",np.value);
    f.append("r",rnp.value);
    f.append("v",vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
           var t = r.responseText;
           if(t == "success"){
            bm.hide(); //psw reset karain passe modal eka hide karnwa
            alert ("Password reset success");

           }else{
            alert (t);
           }
        }
    };

    r.open("POST","resetPassword.php",true);
    r.send(f);
}

// home page eken signout wenna
function signout(){
    var r = new XMLHttpRequest(); 

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){ //signOutProcess eke success ekta samanada? balanwa
                window.location.reload(); //inna page ektma reload wenwa
            }else{
                alert(t); //response text eka laert wenwa
            }
        }
    };

    r.open("GET","signoutProcess.php",true); //signout una msg eka gannawa
    r.send(); //
}

//image update part eka
function changeImage(){
    var view = document.getElementById("viewImg"); //img tag
    var file = document.getElementById("profileimg"); //file chooser

    file.onchange = function(){ //file eka change une gamn me namk nethi function eka weda karanna one
        var file1 = this.files[0]; // file choose eke thina img eka ganna
        var url = window.URL.createObjectURL(file1);  // eyta url ekk create karnwa
        view.src = url; // eka view karnwa

    }

}

function updateProfile(){
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimg"); //file chooser eka gannawa

    var f = new FormData();

    f.append("fn",fname.value);
    f.append("ln",lname.value);
    f.append("m",mobile.value);
    f.append("l1",line1.value);
    f.append("l2",line2.value);
    f.append("p",province.value);
    f.append("d",district.value);
    f.append("c",city.value);
    f.append("pc",pcode.value);

    if(image.files.length == 0){ //aluthin img ekk select karla ne (length = 0)
        var confirmation = confirm("Are you sure You don't want to update your Profile Image?");  //boolean val ekk return karanwa meyagen

        // ok dunnoth (profile update karanna ona nethtan)
        if(confirmation){ 
            alert ("You have not slected any image");
        }

    }else{
        f.append("image",image.files[0]); //img ekk select karla nm server side ekta yanwa
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            alert (t);
        }
    }

    r.open("POST","updateProfileProcess.php",true);
    r.send(f);

}

