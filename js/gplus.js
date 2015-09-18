
 
function logout()
{
    gapi.auth.signOut();
    location.reload();
}
function login() 
{
  var myParams = {
    'clientid' : '234824499443-lui66roh2a9kqou915ch6crkdpk7lrq6.apps.googleusercontent.com',
    'cookiepolicy' : 'single_host_origin',
    'callback' : 'loginCallback',
    'approvalprompt':'force',
    'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
  };
  gapi.auth.signIn(myParams);
}
 
function loginCallback(result)
{
    if(result['status']['signed_in'])
    {
        var request = gapi.client.plus.people.get(
        {
            'userId': 'me'
        });
        request.execute(function (resp)
        {
        	//alert(JSON.stringify(resp))
            var email = '';
            if(resp['emails'])
            {
                for(i = 0; i < resp['emails'].length; i++)
                {
                    if(resp['emails'][i]['type'] == 'account')
                    {
                        email = resp['emails'][i]['value'];
                    }
                }
            }
            
            var str = "name=" + resp['displayName'] +  "&id=" + resp['id'] + "&image=" + resp['image']['url'] + "&lname=" + resp['name']['familyName'] + "&fname=" + resp['name']['givenName'] + "&email=" + email + "&gender="+ resp['gender'] + "&action=googleLogin";
			//var form="googleResp="+resp;
			$.ajax({
					type: "POST",
					url: "handler.php",
					data: str,
					cache: false,
					//contentType: false,
					//processData: false,
					beforeSend:function(){
						$('#loader').show();
					},
					success:  function(data){
						$('#loader').hide();
					if($.trim(data=="success"))
					{
						window.location.href = 'account.php'; 
					}
					else
					{
					alert('error');
					}
						//alert("Settings has been updated successfully.");
						//window.location.reload(true);
					}
				});
        });
 
    }
 
}
function onLoadCallback()
{
    gapi.client.setApiKey('AIzaSyAKf3mZdF6zezEeAeV5oxmV2mmihUzlmww');
    gapi.client.load('plus', 'v1',function(){});
}
 
  
      (function() {
       var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     })();
