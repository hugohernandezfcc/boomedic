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
        //console.log(personG);

        $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });

            
        $.ajax({
                url: "./SMRegister",
                method: "POST",
                data:  personG,
                success: function(data){
                    console.log("éxito");
                    console.log(data);
                },
                error: function(errorThrown){
                    console.log("Aqui viene el error:");
                    console.log(errorThrown);
                }
        });
}

function onRegisterG(googleUser){
    
}

