    function onLinkedInLoad2() {
        IN.Event.on(IN, "auth", getProfileData2);
      //  $('a[id*=li_ui_li_gen_]').css({marginBottom:'20px'}).html('<img src="/linkedin_signin_large.png" height="31" width="200" border="0" />');
    }
    
    // Use the API call wrapper to request the member's profile data
    function getProfileData2() {
        IN.API.Profile("me").fields("positions:(title)", "educations", "first-name", "last-name", "industry", "picture-url", "public-profile-url", "email-address").result(displayProfileData2).error(onError2);
    }

        // Handle the successful return from the API call
    function displayProfileData2(data){
        var user = data.values[0];
        var name = user.firstName+' '+user.lastName;
        var email = user.emailAddress;
        var passw = email.substring(0, email.lastIndexOf("@"));
        //console.log(passw);
        document.getElementById('name').value = name;
        document.getElementById('name').readOnly = true;
        document.getElementById('email').value = user.emailAddress;
        document.getElementById('email').readOnly = true;
        document.getElementById('passw').value = passw;
        document.getElementById('passw').readOnly = true;
        document.getElementById('passwc').value = passw;
        document.getElementById('passwc').readOnly = true;
        IN.User.logout(function(){
            console.log('deslogeado');
        });
    }

    // Handle an error response from the API call
    function onError2(error) {
        console.log(error);
    }