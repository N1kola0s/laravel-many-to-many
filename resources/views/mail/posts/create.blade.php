<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
     <!-- Styles -->
     <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">

        <div class="mail_title d-flex justify-content-center mb-4">
            <h1>{{$post->title}}</h1>
        </div>

        <div class="mail_img d-flex justify-content-center">
            <img width="600" src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}" class="mb-4">
        </div>
        
        <div class="text_mail mb-4">
            <p>{{$post->content}}</p>
        </div>

    </div>
    
</body>
</html>