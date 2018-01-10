var personFB = { name: "", firstName: "", lastName: "", accessToken: "", picture: "", email: "", origin: ""};
var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close-danger2")[0];
function checkLoginState() {
    FB.getLoginStatus(function (response) {
        if (response.status == "connected"){
            document.getElementById('loginload').classList.add("overlay");
            document.getElementById('loginload2').classList.add("fa");
            document.getElementById('loginload2').classList.add("fa-refresh");
            document.getElementById('loginload2').classList.add("fa-spin");
            //personFB.accessToken = response.authResponse.accessToken;
            FB.api('/me?fields=id,name,first_name,last_name,email,picture.type(large)', function (userData){
            personFB.name = userData.name;
            personFB.firstName = userData.first_name;
            personFB.lastName = userData.last_name;
            personFB.email = userData.email;
            personFB.picture = userData.picture.data.url;
            //personFB.origin = 'FB';
            var email = userData.email;
            var passw = email.substring(0, email.lastIndexOf("@"));

            /*FB.logout(function(response){
                // console.log('deslogeado!!!');
            });*/

            
            $.ajax({
                url: "/login",
                method: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                data:  {email: personFB.email, password: passw},
                success: function(data){
                    console.log("éxito");
                    location.href="/medicalconsultations";

                },
                error: function(errorThrown){
                    document.getElementById("loginload").removeAttribute("class");
                    document.getElementById("loginload2").removeAttribute("class");
                    //$("#alertError").html("<div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error:</strong> Los datos no corresponden con nuestra base de datos, asegúrese de estar registrado.</div>");
                    modal.style.display = "block";

                }
            });
          });
        }
    })

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

function fbRegister(){
    FB.getLoginStatus(function (response) {
        if (response.status == "connected"){
            FB.api('/me?fields=id,name,first_name,last_name,email,picture.type(large)', function (userData){
                var email = userData.email;
                var passw = email.substring(0, email.lastIndexOf("@"));
                //console.log(passw);
                //document.getElementById('name').value = userData.first_name + ' ' + userData.last_name;
                document.getElementById('name').value = userData.name;
                document.getElementById('name').readOnly = true;
                document.getElementById('email').value = userData.email;
                document.getElementById('email').readOnly = true;
                document.getElementById('passw').value = passw;
                document.getElementById('passw').readOnly = true;
                document.getElementById('passwc').value = passw;
                document.getElementById('passwc').readOnly = true;
            });

        }

    })

    /*FB.logout(function(response){
        //console.log('deslogeado');
    });*/
}

window.fbAsyncInit = function() {
	FB.init({
	appId      : '179677309285533',
	cookie     : true,  // enable cookies to allow the server to access 
	                    // the session
	xfbml      : true,  // parse social plugins on this page
	version    : 'v2.11' // use any version
});  
    FB.Event.subscribe('xfbml.render', function() {
    var spinner = document.getElementById("cargarfacebook");
    var ima = document.getElementById("cargafacebook");
    if(!(spinner === undefined) && !(ima === undefined)){
        spinner.removeAttribute("class");
        ima.removeAttribute("class");
    }
        } );  
};
    

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/es_LA/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
