var personFB = { name: "", firstName: "", lastName: "", accessToken: "", picture: "", email: "", origin: ""};
function checkLoginState() {
    FB.getLoginStatus(function (response) {
        if (response.status == "connected"){
          personFB.accessToken = response.authResponse.accessToken;
          FB.api('/me?fields=id,name,first_name,last_name,email,picture.type(large)', function (userData){
            personFB.name = userData.name;
            personFB.firstName = userData.first_name;
            personFB.lastName = userData.last_name;
            personFB.email = userData.email;
            personFB.picture = userData.picture.data.url;
            personFB.origin = 'FB';
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
                    //console.log(data);
                    document.getElementById('loginload').classList.add("overlay");
                    document.getElementById('loginload2').classList.add("fa fa-refresh fa-spin");
                    location.href="/medicalconsultations";

                },
                error: function(errorThrown){
                    console.log("Aqui viene el error:");
                    console.log(errorThrown);
                }
            });
          });
        }
    })

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
    var spinner = document.getElementById("cargar");
    var ima = document.getElementById("carga2");
    spinner.removeAttribute("class");
    ima.removeAttribute("class");
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
