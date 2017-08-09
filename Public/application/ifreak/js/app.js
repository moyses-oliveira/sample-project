
$(document).ready(function() {
  var webAuth = new auth0.WebAuth({
    domain: 'moyses-oliveira.auth0.com',
    clientID: 'kDHptmHXesF3f5fp7ctxP3vKrGwIswaD',
    redirectUri: 'http://spellphp.dev/unit/home/auth0',
    audience: 'https://moyses-oliveira.auth0.com/userinfo',
    responseType: 'code',
    scope: 'openid profile email'
  });

  $('.btn-login').click(function(e) {
    e.preventDefault();
    webAuth.authorize();
  });
});

