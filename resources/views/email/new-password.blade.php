<!doctype html>
<html>
    <head>
       
    </head>
    <body>
       Hi {{$user['name']}},
            Your password is been change to {{$user['new_password']}}.<br/>
            Please verify your account new password using this verification code : <h4>{{$user['password_verification_code']}}</h4>

            Please click the link below
            <p><a href="http://reme.cloud/#!/confirm-password">Verify Code</a></p>

       Thanks,
       <br/>Reme Administrator		

    </body>
</html>
