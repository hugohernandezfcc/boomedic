var person = { name: "", picture: "", email: ""};
function onSignInG(googleUser) {
        var profile = googleUser.getBasicProfile();
        gapi.client.load('plus', 'v1', function () {
            var request = gapi.client.plus.people.get({
                'userId': 'me'
            });
            //Display the user details
            request.execute(function (resp) {
                person.name = resp.name.givenName;
                person.email= resp.emails[0].value;
                person.picture = resp.image.url;
                console.log(person);
            });
        });
}

