var personFB = { name: "", firstName: "", lastName: "", accessToken: "", picture: "", email: ""};
function checkLoginState() {
    FB.getLoginStatus(function (response) {
        //console.log(response);
        if (response.status == "connected"){
          personFB.accessToken = response.authResponse.accessToken;
          var data = new FormData();
          FB.api('/me?fields=id,name,first_name,last_name,email,picture.type(large)', function (userData){
            //console.log(userData);
            personFB.name = userData.name;
            personFB.firstName = userData.first_name;
            personFB.lastName = userData.last_name;
            personFB.email = userData.email;
            personFB.picture = userData.picture.data.url;

            data.append("name", userData.name);
            data.append("first_name", userData.first_name);
            data.append("lastName", userData.last_name);
            data.append("email", userData.email);
            data.append("picture", userData.picture.data.url);
            data.append("_token", Laravel.csrfToken);

            console.log(personFB);
            var fbJSON = JSON.stringify(personFB);
            console.log(fbJSON);



            $.ajax({
                url: "./FBRegister",
                method: "POST",
                contentType : false,
                data:  data,
                success: function(datas){
                    console.log("éxito");
                    console.log(datas);
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

window.fbAsyncInit = function() {
	FB.init({
	appId      : '179677309285533',
	cookie     : true,  // enable cookies to allow the server to access 
	                    // the session
	xfbml      : true,  // parse social plugins on this page
	version    : 'v2.11' // use any version
});
	
};

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/es_LA/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
