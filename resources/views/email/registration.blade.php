<!doctype html>
<html>
    <head>
       
    </head>
    <body>
       Hi {{$user['name']}},
            You've successfully registered on Reme Application.<br/>
            Please verify your account using this verification code : <h4>{{$user['verification_code']}}</h4>

       Thanks,
       <br/>Reme Administrator		

    </body>
</html>
