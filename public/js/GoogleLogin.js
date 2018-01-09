var personG = { name: "", picture: "", email: "", lastName: "", firstName: "", accessToken: "", origin: ""};
var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close-danger2")[0];
function onSignInG(googleUser) {
        document.getElementById('loginload').classList.add("overlay");
        document.getElementById('loginload2').classList.add("fa");
        document.getElementById('loginload2').classList.add("fa-refresh");
        document.getElementById('loginload2').classList.add("fa-spin");
        var profile = googleUser.getBasicProfile();
        var authG = googleUser.getAuthResponse(true);
        personG.name = profile.getName();
        personG.email= profile.getEmail();
        personG.picture = profile.getImageUrl();
        personG.lastName = profile.getFamilyName();
        personG.firstName = profile.getGivenName();
        personG.accessToken = authG.access_token;
        personG.origin = 'GG';
        var email = profile.getEmail();
        var passw = email.substring(0, email.lastIndexOf("@"));
        //console.log(personG);

        var authG = gapi.auth2.getAuthInstance();
        authG.signOut().then(function(){
            //console.log("Deslogeado");
        });

            
        $.ajax({
                url: "/login",
                method: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                data:  {email: personG.email, password: passw},
                success: function(data){
                    console.log("éxito");
                    location.href="/medicalconsultations";
                },
                error: function(errorThrown){
                    //console.log("Aqui viene el error:");
                    //console.log(errorThrown);
                    document.getElementById("loginload").removeAttribute("class");
                    document.getElementById("loginload2").removeAttribute("class");
                    modal.style.display = "block";
                }
        });

}

if(!(span === undefined)){
    span.onclick = function() {
    modal.style.display = "none";
    }
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function onRegisterG(googleUser){
    //if(!googleUser.isSignedIn()){
        console.log(googleUser.isSignedIn);
        var profile = googleUser.getBasicProfile();
        var email = profile.getEmail();
        var passw = email.substring(0, email.lastIndexOf("@"));
        console.log(passw);
        document.getElementById('name').value = profile.getName();
        document.getElementById('name').readOnly = true;
        document.getElementById('email').value = profile.getEmail();
        document.getElementById('email').readOnly = true;
        document.getElementById('passw').value = passw;
        document.getElementById('passw').readOnly = true;
        document.getElementById('passwc').value = passw;
        document.getElementById('passwc').readOnly = true;

        var authG = gapi.auth2.getAuthInstance();
        authG.signOut().then(function(){
         //console.log("Deslogeado");
        });
    //}
}

