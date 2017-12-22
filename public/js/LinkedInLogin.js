var personLI = { name: "", picture: "", email: "", lastName: "", firstName: ""};
    function onLinkedInLoad() {
        IN.Event.on(IN, "auth", getProfileData);
      //  $('a[id*=li_ui_li_gen_]').css({marginBottom:'20px'}).html('<img src="/linkedin_signin_large.png" height="31" width="200" border="0" />');
    }
    
    // Use the API call wrapper to request the member's profile data
    function getProfileData() {
        IN.API.Profile("me").fields("id", "first-name", "last-name", "headline", "location", "picture-url", "public-profile-url", "email-address").result(displayProfileData).error(onError);
    }

        // Handle the successful return from the API call
    function displayProfileData(data){
        var user = data.values[0];
        personLI.name = user.firstName+' '+user.lastName;
        personLI.picture = user.pictureUrl;
        personLI.email = user.emailAddress;
        personLI.firstName = user.firstName;
        personLI.lastName = user.lastName;
        console.log(personLI);
    }

    // Handle an error response from the API call
    function onError(error) {
        console.log(error);
    }