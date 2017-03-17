<!DOCTYPE html>
<html>
<head>
    <title>Not Authorized</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: orangered;
            font-weight:bold;
            display: table;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 42px;
            margin-bottom: 40px;
        }

        .small-title{
            text-align: left;
            display: table;
            font-size: 52px;
            background: orangered;
            color: white;
            padding: 12px;
        }
        a{
            padding: 16px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="small-title">Sorry!</div>
        <div class="title">You are not allowed to access this page</div>
        <div class="goback">
            <a href="{{route($dashboardName.'-login')}}">Try to Login</a>
        </div>
    </div>
</div>
</body>
</html>
