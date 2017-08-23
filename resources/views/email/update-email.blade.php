<!doctype html>
<html>
    <head>
       
    </head>
    <body>
       Hi {{$user['name']}},
            Please verify your new email using this verification code : <h4>{{$user['email_verification_code']}}</h4>

       Thanks,
       <br/>Reme Administrator		

    </body>
</html>
