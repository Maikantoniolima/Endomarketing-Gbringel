<?php
session_start();
require_once 'manutencao.php'; // Importa os avatares

function limparAvatar() {
    if (isset($_SESSION['foto'])) {
        $caminho_arquivo = $_SESSION['foto'];
        if (file_exists($caminho_arquivo)) {
            unlink($caminho_arquivo);
        }
        session_unset();
        session_destroy();
    }
    header("Location: avatar_editar.php");
    exit();
}

if (isset($_GET['reset'])) {
    limparAvatar();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    if ($_FILES['foto']['type'] != 'image/jpeg' || $_FILES['foto']['size'] > 2000000) {
        echo "<script>alert('Erro: A foto deve estar no formato JPG e ter um tamanho máximo de 2MB.');</script>";
    } else {
        $nome_arquivo = uniqid() . '.jpg';
        $caminho_arquivo = 'envios/' . $nome_arquivo;
        move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_arquivo);

        $_SESSION['foto'] = $caminho_arquivo;
        $_SESSION['empresa'] = $_POST['empresa'];

        echo "<script>window.location.href='avatar_editar.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avatar Personalizado</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        .container { max-width: 500px; margin: auto; }
        .file-input { margin-bottom: 20px; }
        .form-group { margin: 10px 0; }
        .btn { padding: 10px 20px; border: none; cursor: pointer; font-size: 18px; }
        .btn-primary { background-color: #03144C; color: #FFF; width: 40px; height: 40px; border-radius: 5px; }
        .btn-success { background-color: #03911B; color: #FFF; padding: 10px 15px; border-radius: 5px; font-size: 16px; }
        .btn-danger { background-color: #FF0000; color: #FFF; padding: 10px 15px; border-radius: 5px; font-size: 16px; }
        .editor-container { display: flex; align-items: center; justify-content: center; margin-top: 10px; }
        .editor-buttons { display: flex; flex-direction: column; gap: 5px; margin-left: 15px; }
        #editor { width: 300px; height: 300px; position: relative; border: 1px solid #ccc; overflow: hidden; }
        #foto, #avatar { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; }
    </style>
</head>
<body>

<div class="container">
    <div id="upload-section" <?= isset($_SESSION['foto']) ? 'style="display: none;"' : '' ?>>
        <h1>Faça seu avatar personalizado</h1>
        <form id="avatar-form" enctype="multipart/form-data" method="POST">
            <div class="file-input">
                <input type="file" name="foto" required>
                <p>Formato aceito: .JPG | Máximo 2MB</p>
            </div>
            <div class="form-group">
                <select name="empresa" required>
                    <option value="">Selecione uma empresa</option>
                    <?php foreach ($avatares as $empresa => $avatar): ?>
                        <option value="<?= $empresa ?>" <?= (isset($_SESSION['empresa']) && $_SESSION['empresa'] == $empresa) ? 'selected' : '' ?>>
                            <?= ucfirst($empresa) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </div>

    <div id="editor-section" <?= isset($_SESSION['foto']) ? '' : 'style="display: none;"' ?>>
        <div style="margin-bottom: 10px;">
            <button class="btn btn-success" onclick="salvarImagem()">Salvar Imagem</button>
            <a href="avatar_editar.php?reset=true" class="btn btn-danger">Trocar Foto</a>
        </div>

        <div class="editor-container">
            <div id="editor">
                <img id="foto" src="<?= $_SESSION['foto'] ?? '' ?>" alt="Sua Foto">
                <?php if (isset($_SESSION['empresa']) && isset($avatares[$_SESSION['empresa']])): ?>
                    <img id="avatar" src="assets/avatar/<?= $avatares[$_SESSION['empresa']] ?>" alt="Avatar">
                <?php endif; ?>
            </div>

            <div class="editor-buttons">
                <button class="btn btn-primary" onclick="ajustarImagem('up')">↑</button>
                <button class="btn btn-primary" onclick="ajustarImagem('down')">↓</button>
                <button class="btn btn-primary" onclick="ajustarImagem('left')">←</button>
                <button class="btn btn-primary" onclick="ajustarImagem('right')">→</button>
                <button class="btn btn-primary" onclick="zoomImagem('in')">🔍+</button>
                <button class="btn btn-primary" onclick="zoomImagem('out')">🔍-</button>
            </div>
        </div>
    </div>
</div>


 <script>
    var foto = document.getElementById('foto');
    var avatar = document.getElementById('avatar');
    var scale = 1;
    var positionX = 0;
    var positionY = 0;

    function ajustarImagem(acao) {
        switch (acao) {
            case 'up': positionY -= 5; break;
            case 'down': positionY += 5; break;
            case 'left': positionX -= 5; break;
            case 'right': positionX += 5; break;
        }
        atualizarTransformacao();
    }

    function zoomImagem(tipo) {
        if (tipo === 'in' && scale < 2) {
            scale += 0.1;
        } else if (tipo === 'out' && scale > 0.5) {
            scale -= 0.1;
        }
        atualizarTransformacao();
    }

    function atualizarTransformacao() {
        foto.style.transform = `translate(${positionX}px, ${positionY}px) scale(${scale})`;
    }

    function salvarImagem() {
        var canvas = document.createElement('canvas');
        canvas.width = 1080;
        canvas.height = 1080;
        var ctx = canvas.getContext('2d');

        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        var fotoBounds = foto.getBoundingClientRect();
        var editorBounds = document.getElementById('editor').getBoundingClientRect();

        var aspectRatio = foto.naturalWidth / foto.naturalHeight; // Mantendo a proporção original

        var newWidth, newHeight;
        if (aspectRatio > 1) {
            // Foto em paisagem
            newWidth = 1080;
            newHeight = 1080 / aspectRatio;
        } else {
            // Foto em retrato
            newHeight = 1080;
            newWidth = 1080 * aspectRatio;
        }

        // Ajuste proporcional à escala aplicada no editor
        var drawWidth = newWidth * scale;
        var drawHeight = newHeight * scale;

        // **Correção do alinhamento centralizado no zoom**
        var offsetX = (positionX * (1080 / 300)) + ((1080 - drawWidth) / 2);
        var offsetY = (positionY * (1080 / 300)) + ((1080 - drawHeight) / 2);

        // Aplicar escala e posição ao canvas
        ctx.drawImage(foto, offsetX, offsetY, drawWidth, drawHeight);

        // Desenhar o avatar fixo
        ctx.drawImage(avatar, 0, 0, 1080, 1080);

        // Criar o download da imagem final
        var link = document.createElement('a');
        link.href = canvas.toDataURL('image/jpeg');
        link.download = 'avatar_editado.jpg';
        link.click();
    }
</script>

 

</body>
</html>
