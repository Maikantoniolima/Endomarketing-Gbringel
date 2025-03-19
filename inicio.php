<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Assinatura de E-mail</title>
    <style>
        /* 🔹 Garante que a página não tenha rolagem */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            font-family: Arial, sans-serif;
            background: url('assets/imagens/bg.png') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10%;
        }

        .left-content {
            max-width: 50%;
            color: #fff;
        }

        h1 {
            font-size: 50px;
            margin-bottom: 10px;
        }

        p {
            font-size: 25px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 15px 25px;
            font-size: 18px;
            color: #fff;
            background-color: #FF6616;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color: #cc5200;
        }

        .right-content img {
            max-width: 100%;
            height: auto;
        }

        /* 🔹 Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: hidden; /* Evita rolagem lateral */
        }

        .modal-content {
            background-color: #fff;
            width: 50%;
            height: 80vh; /* 🔥 Ajuste na altura no web */
            margin: 5% auto;
            border-radius: 10px;
            position: relative;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-content iframe {
            width: 100%;
            height: 100%;
            border: none;
            flex-grow: 1; /* 🔥 Faz o iframe ocupar toda a altura disponível */
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            background: #ff0000;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* 🔹 Ajustes para MOBILE */
        @media (max-width: 768px) {
            html, body {
            padding: 0 ;
            }
            body {
                flex-direction: column;
                padding: 5%;
                text-align: left;
                justify-content: center;
                height: 100vh;
                background-size: cover;
                background-position: center;
                overflow: hidden; /* 🔥 Impede rolagem no mobile */
            }

            h1 {
                font-size: 25px; /* Reduzido no mobile */
                text-align: left;
            }

            p {
                font-size: 18px; /* Reduzido no mobile */
                text-align: left;
            }

            .buttons {
                flex-direction: column; /* 🔥 Botões um abaixo do outro */
                gap: 10px;
            }

            .right-content {
                display: none; /* 🔥 Oculta imagem no mobile */
            }

            .modal-content {
                width: 100%;
                height: 100vh; /* 🔥 Modal ocupa toda a tela no mobile */
                margin: 0;
                padding: 0; /* 🔥 Removido padding */
                border-radius: 0;
                text-align: left;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                box-shadow: none;
            }

            .modal-content iframe {
                flex-grow: 1; /* 🔥 Faz o iframe ocupar todo o espaço disponível */
                width: 100%;
                height: 100%;
            }
            .left-content {
                max-width: 80%;
                color: #fff;
            }
        }
    </style>
</head>

<body>
    <div class="left-content">
        <img src="assets/imagens/logo.png" style='height: 60px; margin-top: 10px;' alt="Logo Grupo Bringel">
        <h1 >Gerador de Assinatura e Avatar das Empresas do Grupo</h1>
        <p>Crie uma assinatura de e-mail e um modelo de avatar personalizado.</p>
        <div class="buttons">
            <a href="#" class="btn" id="openAssinatura">Criar Assinatura</a>
            <a href="#" class="btn" id="openAvatar">Criar Avatar</a>
        </div>
    </div>

    <div class="right-content">
        <img src="assets/imagens/destaque.png" style="max-height: 50%; margin-top: 10px;" alt="Destaque">
    </div>

    <!-- Modal para Criar Avatar -->
    <div id="avatarModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeAvatarModal">&times;</span>

            <iframe src="avatar_editar.php"></iframe>
        </div>
    </div>

    <!-- Modal para Criar Assinatura -->
    <div id="assinaturaModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeAssinaturaModal">&times;</span>
            
            <iframe src="assinatura.php"></iframe>
        </div>
    </div>

    <script>
        document.getElementById("openAvatar").addEventListener("click", function() {
            document.getElementById("avatarModal").style.display = "block";
        });

        document.getElementById("closeAvatarModal").addEventListener("click", function() {
            document.getElementById("avatarModal").style.display = "none";
        });

        document.getElementById("openAssinatura").addEventListener("click", function() {
            document.getElementById("assinaturaModal").style.display = "block";
        });

        document.getElementById("closeAssinaturaModal").addEventListener("click", function() {
            document.getElementById("assinaturaModal").style.display = "none";
        });

        window.onclick = function(event) {
            let avatarModal = document.getElementById("avatarModal");
            let assinaturaModal = document.getElementById("assinaturaModal");
            if (event.target === avatarModal) {
                avatarModal.style.display = "none";
            }
            if (event.target === assinaturaModal) {
                assinaturaModal.style.display = "none";
            }
        }
    </script>
</body>
</html>
