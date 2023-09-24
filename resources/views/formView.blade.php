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
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <img src="https://lh3.googleusercontent.com/p/AF1QipNKCPy7UHhVmDfzwUkEgn-Bp2jNS5F1zrIOd9JD=w1080-h608-p-no-v0" alt="Logotipo" class="card-img-top mx-auto d-block" style="max-width: 400px;">
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Formulario técnico
                    </div>
                    <div class="card-body">
                        <div>
                            
                        </div>
                        <form method="POST" action="{{ route('save') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nombre:</label>
                                <input class="form-control" name="userName" for="userName" value="{{ $user->userName }}" readonly></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input class="form-control" name="email" for="email" value="{{ $user->email }}" readonly></input>
                            </div>
                            <label class="form-label">Firma:</label>
                            <canvas class="mb-3 form-control" id="canvas" width="600" height="200" style="border: 1px solid lightgrey;"></canvas>
                            <!-- Agrega un campo oculto para guardar la firma -->
                            <input type="hidden" id="imagenFirma" name="imagenFirma">
                            <button type="button" class="btn btn-danger" id="clear-button" formnovalidate>Borrar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                        
                        <script>
                            var canvas = document.getElementById('canvas');
                            var context = canvas.getContext('2d');
                            var drawing = false;

                            canvas.addEventListener('mousedown', startDrawing);
                            canvas.addEventListener('mouseup', stopDrawing);
                            canvas.addEventListener('mousemove', draw);

                            canvas.addEventListener('touchstart', startDrawing);
                            canvas.addEventListener('touchend', stopDrawing);
                            canvas.addEventListener('touchmove', draw);

                            document.getElementById('clear-button').addEventListener('click', clearCanvas);

                            function startDrawing(e) {
                                drawing = true;
                                draw(e);
                            }

                            function stopDrawing() {
                                drawing = false;
                                context.beginPath();
                            }

                            function draw(e) {
                                if (!drawing) return;

                                context.lineWidth = 2;
                                context.lineCap = 'round';
                                context.strokeStyle = '#000';

                                if (e.touches && e.touches[0]) {
                                    context.lineTo(e.touches[0].clientX - canvas.getBoundingClientRect().left, e.touches[0].clientY - canvas.getBoundingClientRect().top);
                                } else {
                                    context.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
                                }

                                context.stroke();
                                context.beginPath();
                                context.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);

                                // Guarda la firma en el campo oculto
                                var signatureData = canvas.toDataURL();
                                document.getElementById('imagenFirma').value = signatureData;
                            }

                            function clearCanvas() {
                                context.clearRect(0, 0, canvas.width, canvas.height);
                                document.getElementById('imagenFirma').value = ''; // Borra la firma en el campo oculto
                            }
                        </script>

                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        @include('sweetalert::alert')
                    </div>
                </div>    
            </div>
        </div>
    </div>
</body>

</html>