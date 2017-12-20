var person = { userID: "" , name: "", firstName: "", lastName: "", accessToken: "", picture: "", email: ""};
function checkLoginState() {
    FB.getLoginStatus(function (response) {
        console.log(response);
        if (response.status == "connected"){
          person.accessToken = response.authResponse.accessToken;
          person.userID = response.authResponse.userID;
          FB.api('/me?fields=id,name,first_name,last_name,email,picture.type(large)', function (userData){
            console.log(userData);
            person.name = userData.name;
            person.firstName = userData.first_name;
            person.lastName = userData.last_name;
            person.email = userData.email;
            person.picture = userData.picture.data.url;
            console.log(person);
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
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
