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

function renderG(){
 	gapi.plusone.render('myButton'{
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'theme': 'dark',
        'onsuccess': onSignInG
        });
}