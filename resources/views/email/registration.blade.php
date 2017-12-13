<!doctype html>
<html>
    <head>
       
    </head>
    <body>
       Hi {{$user['name']}},
            You've successfully registered on Reme Application.<br/>
            Please Click the link below to activate your account : <br/>

            <p><a href="{!! env('APP_URL') !!}{{ $activation_link }}">{!! env('APP_URL') !!}{{ $activation_link }}</a></p>	

       Thanks,
       <br/>Reme Administrator		

    </body>
</html>
