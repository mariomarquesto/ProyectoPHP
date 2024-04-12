<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluye la hoja de estilos de Picocss -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
    <!-- Título de la página -->
    <title>mi primera pagina PHP</title>
    <style>
        /* Estilos para centrar el contenido y hacerlo responsive */
        :root {
            color-scheme: light dark;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            text-align: center;
        }

        img {
            max-width: 50%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>
            <?php
            // Muestra el mensaje "Hola mundo"
            echo "Peliculas de Marvel";
            ?>
        </h1>
        <?php
        // Define la URL de la API
        const API_URL = 'https://www.whenisthenextmcufilm.com/api';

        // Inicia una sesión de cURL para realizar la solicitud a la API
        $ch = curl_init(API_URL);
        // Establece la opción para devolver el resultado de la solicitud en lugar de imprimirlo directamente
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Ejecuta la solicitud y almacena la respuesta en $result
        $result = curl_exec($ch);

        // Decodifica los datos JSON devueltos por la API y los almacena en $data
        $data = json_decode($result, true);
        // Cierra la sesión de cURL
        curl_close($ch);

        // Verifica si se obtuvieron datos válidos de la API antes de mostrar la imagen
        if (!empty($data) && isset($data["poster_url"])) {
            ?>
            <!-- Muestra la imagen del póster si está disponible -->
            <img src="<?= $data["poster_url"]; ?>" alt="poster" />
        <?php
        } else {
            // Si no se pudo obtener la URL del póster, muestra un mensaje de error
            echo "No se pudo obtener la URL del póster";
        }
        ?>

        <!-- Muestra información adicional sobre la próxima película de Marvel -->
        <div>
            <!-- Muestra el título de la próxima película y los días restantes para su estreno -->
            <h3> <?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días</h3>
            <!-- Muestra la fecha de estreno de la próxima película -->
            <p>Fecha de estreno: <?= $data["release_date"]; ?></p>
            <!-- Muestra el título de la siguiente película de Marvel en producción -->
            <p>La siguiente es: <?= $data["following_production"]["title"]; ?></p>
        </div>
    </div>
</body>

</html>
