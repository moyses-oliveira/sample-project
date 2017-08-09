
$(document).ready(function() {

  $('.btn-login').click(function(e) {
        var options = {
            closable: false,
            languageDictionary: { title: 'Sandbox' },
            theme: { logo: '/img/badge.png' },
            auth: {
              redirectUrl: 'http://spellphp.dev/unit/home/auth0'
            }
        };
        var lock = new Auth0Lock('kDHptmHXesF3f5fp7ctxP3vKrGwIswaD', 'moyses-oliveira.auth0.com');
        lock.show();
  });
});

