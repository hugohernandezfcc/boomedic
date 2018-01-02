var personFB = { name: "", firstName: "", lastName: "", accessToken: "", picture: "", email: ""};
function checkLoginState() {
    FB.getLoginStatus(function (response) {
        //console.log(response);
        if (response.status == "connected"){
          personFB.accessToken = response.authResponse.accessToken;
          FB.api('/me?fields=id,name,first_name,last_name,email,picture.type(large)', function (userData){
            //console.log(userData);
            personFB.name = userData.name;
            personFB.firstName = userData.first_name;
            personFB.lastName = userData.last_name;
            personFB.email = userData.email;
            personFB.picture = userData.picture.data.url;

            console.log(personFB);
            var fbJSON = JSON.stringify(personFB);
            console.log(fbJSON);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });

            $.post('https://sbx03.herokuapp.com/FBRegister',{
                _token: $('meta[name="_token"]').attr('content'),
                name: userData.name,
                firstName: userData.first_name,
                lastName: userData.last_name,
                email: userData.email,
                picture: userData.picture.data.url
            })
            .done(function(data){
                console.log(data);
            })
            .fail(function(data){
                console.log("error");
            });

            /*
            $.ajax({
                url: "./FBRegister",
                method: "POST",
                contentType : "aplication/JSON",
                data:  fbJSON,
                success: function(data){
                    console.log("éxito");
                    console.log(data);
                },
                error: function(errorThrown){
                    console.log("Aqui viene el error:");
                    console.log(errorThrown);
                }
            });
            */
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
