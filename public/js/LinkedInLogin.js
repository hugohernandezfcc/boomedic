var person = { name: "", picture: "", email: "", lastName: "", firstName: ""};
    function onLinkedInLoad() {
        IN.Event.on(IN, "auth", getProfileData);
    }
    
    // Use the API call wrapper to request the member's profile data
    function getProfileData() {
        IN.API.Profile("me").fields("id", "first-name", "last-name", "headline", "location", "picture-url", "public-profile-url", "email-address").result(displayProfileData).error(onError);
    }

        // Handle the successful return from the API call
    function displayProfileData(data){
        var user = data.values[0];
        person.name = user.firstName+' '+user.lastName;
        person.picture = user.pictureUrl;
        person.email = user.emailAddress;
        person.firstName = user.firstName;
        person.lastName = user.lastName;
        console.log(person);
    }

    // Handle an error response from the API call
    function onError(error) {
        console.log(error);
    }