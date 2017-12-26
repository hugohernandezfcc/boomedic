var personG = { name: "", picture: "", email: "", lastName: "", firstName: ""};
function onSignInG(googleUser) {
        var profile = googleUser.getBasicProfile();
        personG.name = profile.getName();
        personG.email= profile.getEmail();
        personG.picture = profile.getImageUrl();
        personG.lastName = profile.getFamilyName();
        personG.firstName = profile.getGivenName();
        console.log(personG);
}


