<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"
            defer></script>
    <script src="/static/js/script.js"></script>
    <title>Fénykép adatbázis</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Fénykép adatbázis</span>
        </div>
    </nav>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Név</th>
            <th scope="col">Készítette</th>
            <th scope="col">Megtekintve</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody id="table-body">
        <tr>
            <th>1</th>
            <td class="image-name">Mark</td>
            <td class="image-author">Otto</td>
            <td class="view-count">345</td>
            <td><span class="dropdown">
                    <span class="dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menü
                    </span>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Módosítás</a></li>
                        <li><a class="dropdown-item" href="#">Törlés</a></li>
                        <li><a class="dropdown-item" href="#">Megtekintés</a></li>
                    </ul>
                </span></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>