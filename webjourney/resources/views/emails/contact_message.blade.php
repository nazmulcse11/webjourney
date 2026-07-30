<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>{{ __('You Have a New Contact Message') }}</h3>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <p><strong>{{ __('Name') }}</strong> : {{ $name }}</p>
            <p><strong>{{ __('Email') }}</strong> : {{ $email }}</p>
            <p><strong>{{ __('Message') }}</strong> : {{ $messages }}</p>
        </div>
    </div>
</div>


</body>
</html>
