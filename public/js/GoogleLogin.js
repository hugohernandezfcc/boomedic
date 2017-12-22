var person = { name: "", picture: "", email: "", lastName: "", firstName: ""};
function onSignInG(googleUser) {
        var profile = googleUser.getBasicProfile();
        person.name = profile.getName();
        person.email= profile.getEmail();
        person.picture = profile.getImageUrl();
        person.lastName = profile.getFamilyName();
        person.firstName = profile.getGivenName();
        console.log(person);
}

