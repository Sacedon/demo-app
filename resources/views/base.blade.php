<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Link to custom CSS stylesheet -->
    <title> Demo </title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('books.index') }}">
                @if(auth()->check()) Hello, {{ auth()->user()->name }} @else Demo @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto"> <!-- Use "mr-auto" to move content to the left -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('book-logs') }}">Logs</a>
                    </li>

                    @if(auth()->check())
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ ('/') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ ('/register') }}">Register</a>
                    </li>
                    @endif
                    <!-- Add more navigation links as needed -->
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-ZuRj2SNF9wO5KCx4/LbTP0KwlGcsmJp+5D0P5B7utW9jT8t5n5PVCOb7z5O5OZ5q6W" crossorigin="anonymous"></script>
</body>
</html>
<style scoped>
    /* styles.css */

/* Style the navigation links */
.navbar-nav .nav-item {
    margin-right: 10px; /* Add some spacing between navigation items */
}

/* Change the color of the navigation links on hover */
.navbar-nav .nav-item a.nav-link:hover {
    color: #007bff; /* Change to your desired color */
}

/* Add a background color to the active link */
.navbar-nav .nav-item.active a.nav-link {
    background-color: #007bff; /* Change to your desired color */
    color: #fff; /* Change to your desired text color */
}

/* Style the brand logo text */
.navbar-brand {
    font-size: 24px; /* Change to your desired font size */
}

</style>
