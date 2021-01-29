<?php

require __DIR__ . "/vendor/autoload.php";

$upload = new \CoffeeCode\Uploader\Media('storage', 'medias');
$files = $_FILES;

if (!empty($files["file"])) {
    $file = $files["file"];

    if (empty($file["type"]) || !array($file["type"], $upload::isAllowed())) {
        echo "<p>Selecione um mídia válida</p>";
    } else {
        $uploaded = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 380);
        echo "<a target='_blank' href='{$uploaded}'>Acessar mídia</a>";
    }
}

$sended = filter_input( INPUT_GET, "sended", FILTER_VALIDATE_BOOLEAN);
if ($sended && empty($files["file"])) {
    echo "Selecione uma mídia de até " . ini_get('upload_max_filesize');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Mídias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
            crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="images.php">Upload de imagens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="files.php">Upload de arquivos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"  href="medias.php">Upload de mídias</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<h1>Upload de Mídias</h1>
<form action="?sended=true" method="post" enctype="multipart/form-data">
    <h2>Selecione sua mídia:</h2>
    <input type="file" name="file" id="file">
    <button>Enviar</button>
</form>
</body>
</html>
