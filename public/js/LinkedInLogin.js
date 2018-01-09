var personLI = { name: "", picture: "", email: "", lastName: "", firstName: "", title: "", industry: "", accessToken: "", origin: ""};
var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close-danger2")[0];
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
        document.getElementById('loginload').classList.add("overlay");
        document.getElementById('loginload2').classList.add("fa");
        document.getElementById('loginload2').classList.add("fa-refresh");
        document.getElementById('loginload2').classList.add("fa-spin");
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
        var email = user.emailAddress;
        var passw = email.substring(0, email.lastIndexOf("@"));

        IN.User.logout(function(){
            //console.log('deslogeado');
        });
            
        $.ajax({
                url: "/login",
                method: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                data:  {email: personLI.email, password: passw},
                success: function(data){
                    console.log("éxito");
                    location.href="/medicalconsultations";
                },
                error: function(errorThrown){
                   // console.log("Aqui viene el error:");
                    //console.log(errorThrown);
                    document.getElementById("loginload").removeAttribute("class");
                    document.getElementById("loginload2").removeAttribute("class");
                    document.getElementById('collapseThree').classList.add("collapse");
                    modal.style.display = "block";
                }
        });
    }

    // Handle an error response from the API call
    function onError(error) {
        console.log(error);
    }

    span.onclick = function() {
    modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }