var personG = { name: "", picture: "", email: "", lastName: "", firstName: "", accessToken: "", origin: ""};
function onSignInG(googleUser) {
        var profile = googleUser.getBasicProfile();
        var authG = googleUser.getAuthResponse(true);
        personG.name = profile.getName();
        personG.email= profile.getEmail();
        personG.picture = profile.getImageUrl();
        personG.lastName = profile.getFamilyName();
        personG.firstName = profile.getGivenName();
        personG.accessToken = authG.access_token;
        personG.origin = 'GG';
        console.log(personG);
}

function renderG(){
 	gapi.plusone.render('myButton', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'theme': 'dark',
        'onsuccess': onSignInG
        });
}