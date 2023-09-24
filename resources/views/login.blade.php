<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prueba Técnica PTV</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div>
            <img src="https://lh3.googleusercontent.com/p/AF1QipNKCPy7UHhVmDfzwUkEgn-Bp2jNS5F1zrIOd9JD=w1080-h608-p-no-v0" alt="Logotipo" class="card-img-top mx-auto d-block" style="max-width: 400px;">
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Inicio de Sesión
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('login') }}">
                            <div class="mb-3">
                                <label for="userName" class="form-label">Usuario:</label>
                                <input type="text" class="form-control" name="userName" placeholder="Ingrese su usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI:</label>
                                <input type="text" class="form-control" name="dni" placeholder="Ingrese su DNI" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>