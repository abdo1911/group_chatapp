<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table,th, td {
            padding: 30px;
            text-align: left;
            border: 3px solid black;
            border-collapse: collapse;
            font-size: large;
            font-family: sans-serif;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        body{
            background-color: antiquewhite;
        }
    </style>
</head>
<body>
<h1 style="text-align:center">User list - Active User</h1>

<table class="center">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Last Seen</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
            </td>
            <td>
                @if(Cache::has('user-is-online-' . $user->id))
                    <span style="color: green;font-weight: bold">Online</span>
                @else
                    <span style="color: red;font-weight: bold">Offline</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->links() }}
</body>
</html>
