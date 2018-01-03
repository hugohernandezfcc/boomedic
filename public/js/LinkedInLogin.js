var personLI = { name: "", picture: "", email: "", lastName: "", firstName: "", title: "", industry: "", accessToken: "", origin: ""};
    function onLinkedInLoad() {
        IN.Event.on(IN, "auth", getProfileData);
      //  $('a[id*=li_ui_li_gen_]').css({marginBottom:'20px'}).html('<img src="/linkedin_signin_large.png" height="31" width="200" border="0" />');
    }
    
    // Use the API call wrapper to request the member's profile data
    function getProfileData() {
        IN.API.Profile("me").fields("positions:(title)", "educations", "first-name", "last-name", "industry", "picture-url", "public-profile-url", "email-address").result(displayProfileData).error(onError);
    }

        // Handle the successful return from the API call
    function displayProfileData(data){
        var user = data.values[0];
        personLI.name = user.firstName+' '+user.lastName;
        personLI.picture = user.pictureUrl;
        personLI.email = user.emailAddress;
        personLI.firstName = user.firstName;
        personLI.lastName = user.lastName;
        personLI.title = user.positions.title;
        //personLI.specialities = user.specialities;
        personLI.industry = user.industry;
        personLI.accessToken = IN.ENV.auth.oauth_token;
        personLI.origin = 'LI';
        console.log(personLI);
    }

    // Handle an error response from the API call
    function onError(error) {
        console.log(error);
    }