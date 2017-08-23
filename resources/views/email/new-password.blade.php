<!doctype html>
<html>
    <head>
       
    </head>
    <body>
       Hi {{$user['name']}},
            Hi Your password is been change to {{$user['new_password']}}.<br/>
            Please verify your account new password using this verification code : <h4>{{$user['password_verification_code']}}</h4>

       Thanks,
       <br/>Reme Administrator		

    </body>
</html>
