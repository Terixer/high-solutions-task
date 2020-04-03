<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        pre {
            text-align: left !important;
            font-family: monospace;
            background-color: #fff;
            width: 27.5em;
            margin: 4em auto;
            padding: 0.5em;
            border-radius: .25em;
            box-shadow: 0.1em 0.1em 0.5em rgba(0, 0, 0, 0.45);
            line-height: 0;
            counter-reset: line;
        }

        pre code {
            display: block;
            line-height: 1.5rem;
        }

        pre code:before {
            counter-increment: line;
            content: counter(line);
            display: inline-block;
            border-right: 1px solid #ddd;
            padding: 0 .5em;
            margin-right: .5em;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="full-height">

        <div class="content">
            <div class="title m-b-md">
                Laravel
            </div>
            <div class="links">
                <h1>Register user</h1>
                <code>{{route('register')}} <b>(POST)</b></code>
                <pre>
                    <p>Example data:</p>
                    <code>{</code>
                    <code>  email : user@user.com</code>
                    <code>  password : password123</code>
                    <code>  password_confirmation : password123</code>
                    <code>}</code>
                </pre>
                <h1>Login user</h1>
                <code>{{route('login')}} <b>(POST)</b></code>
                <pre>
                    <p>Example data:</p>
                    <code>{</code>
                    <code>  email : user@user.com</code>
                    <code>  password : password123</code>
                    <code>}</code>
                </pre>
                <h1>Get all people <small>(oauth)</small></h1>
                <code>{{route('people.index')}} <b>(GET)</b></code>
                <h1>Get person by name <small>(oauth)</small></h1>
                <code>{{route('people.index')}} <b>(GET)</b></code>
                <pre>
                    <p>Example data:</p>
                    <code>{</code>
                    <code>  name : Yoda</code>
                    <code>}</code>
                </pre>
            </div>
        </div>
    </div>
</body>

</html>
