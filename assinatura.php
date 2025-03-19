<?php
include 'manutencao.php'; // Inclui o arquivo de manutenção

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $sobrenome = $_POST['sobrenome'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $departamento = $_POST['departamento'] ?? '';
    $empresa = $_POST['empresa'] ?? '';
    $telefone_comercial = trim($_POST['telefone_comercial'] ?? '');
    $telefone_celular = trim($_POST['telefone_celular'] ?? '');
    $email = $_POST['email'] ?? '';

    $corNome = $empresas[$empresa]['cor'] ?? '#000';
    $logo = $empresas[$empresa]['logo'] ?? '';
    $site = $empresas[$empresa]['site'] ?? '#';

    // Construção dinâmica da linha de telefone
    $linhaTelefone = '';
    if (!empty($telefone_comercial)) {
        $linhaTelefone .= "Fone: $telefone_comercial";
    }
    if (!empty($telefone_celular)) {
        if (!empty($linhaTelefone)) {
            $linhaTelefone .= " | ";
        }
        $linhaTelefone .= "Cel: $telefone_celular";
    }

    // Montagem da assinatura
    $assinatura = "
        <div style='font-family: Arial, sans-serif; max-width: 500px; text-align: left;'>
            <p style='margin: 0; font-size: 25px; font-weight: bold; color: $corNome;'>$nome $sobrenome</p>
            <p style='margin: 0; font-size: 14px; padding-bottom: 20px;'>
                <strong>$cargo</strong> - <strong>$departamento</strong>
            </p>";

    if (!empty($linhaTelefone)) {
        $assinatura .= "<p style='margin: 0; font-size: 14px;'>$linhaTelefone</p>";
    }

    $assinatura .= "
            <p style='margin: 0; font-size: 14px;'>E-mail: <a href='mailto:$email'>$email</a></p>
            <p style='margin: 0; font-size: 14px; padding-bottom: 25px;'>Site: <a href='$site' target='_blank'>$site</a></p>
            <img src='assets/logos/$logo' alt='Logo $empresa' style='height: 60px; margin-top: 10px;'><br>
            <hr style='border: 0; height: 1px; background: #ccc; margin: 10px 0;'>
            <p style='font-size: 10px; color: #555;'>
                <strong>Aviso Legal:</strong> Esta mensagem e seus anexos são destinados exclusivamente ao uso de indivíduos ou entidades a quem são endereçados e podem conter informações confidenciais. Se você recebeu esta mensagem por engano, por favor, notifique o remetente imediatamente e exclua a mensagem. A reprodução, divulgação ou uso não autorizado das informações aqui contidas são proibidos.
            </p>
            <p style='font-size: 10px; color: #555;'>
                <strong>Disclaimer:</strong> This message and its attachments are intended exclusively for the use of the individual or entity to whom they are addressed and may contain confidential information. If you have received this message by mistake, please notify the sender immediately and delete the message. Unauthorized reproduction, disclosure, or use of the information contained herein is prohibited.
            </p>
        </div>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Assinatura de E-mail</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        .container { max-width: 600px; margin: auto; text-align: left; }
        .form-container { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .form-container.full { grid-template-columns: 1fr; }
        .form-group { display: flex; flex-direction: column; }
        .btn { padding: 10px 15px; border: none; cursor: pointer; font-size: 16px; margin-top: 10px; }
        .btn-success { background-color: #03911B; color: #FFF; border-radius: 5px; }
        .btn-copy { background-color: #03144C; color: #FFF; border-radius: 5px; }
        .btn-edit { background-color: #FF6616; color: #FFF; border-radius: 5px; }
        .signature-preview { margin-top: 20px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9; }

        /* Ajustes para mobile */
        @media screen and (max-width: 600px) {
            .form-container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Gerador de Assinatura de E-mail</h1>

    <div id="form-section" <?= isset($assinatura) ? 'style="display: none;"' : '' ?>>
        <form id="signature-form" method="POST">
            <div class="form-container">
                <div class="form-group">
                    <label>Nome*</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="form-group">
                    <label>Sobrenome*</label>
                    <input type="text" name="sobrenome" required>
                </div>
            </div>

            <div class="form-container">
                <div class="form-group">
                    <label>Cargo*</label>
                    <input type="text" name="cargo" required>
                </div>
                <div class="form-group">
                    <label>Departamento*</label>
                    <input type="text" name="departamento" required>
                </div>
            </div>

            <div class="form-container full">
                <div class="form-group">
                    <label>Empresa*</label>
                    <select name="empresa" required>
                        <option value="">Selecione uma empresa</option>
                        <?php foreach ($empresas as $nome => $dados): ?>
                            <option value="<?= $nome ?>"><?= $nome ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-container">
                <div class="form-group">
                    <label>Telefone Comercial</label>
                    <input type="text" name="telefone_comercial" class="phone-mask">
                </div>
                <div class="form-group">
                    <label>Telefone Celular</label>
                    <input type="text" name="telefone_celular" class="phone-mask">
                </div>
            </div>

            <div class="form-container full">
                <div class="form-group">
                    <label>E-mail*</label>
                    <input type="email" name="email" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Gerar Assinatura</button>
        </form>
    </div>

    <div id="signature-section" <?= isset($assinatura) ? '' : 'style="display: none;"' ?>>
        <div class="signature-preview" id="assinatura">
            <?= $assinatura ?? '' ?>
        </div>
        <button class="btn btn-copy" onclick="copiarAssinatura()">Copiar Assinatura</button>
        <button class="btn btn-edit" onclick="editarAssinatura()">Editar Assinatura</button>
    </div>
</div>

<script>
        function copiarAssinatura() {
        var assinaturaDiv = document.getElementById("assinatura");

        // Clona a assinatura para evitar alterações na original
        var assinaturaClone = assinaturaDiv.cloneNode(true);

        // Ajusta o caminho da imagem para ser absoluto
        var imgElement = assinaturaClone.querySelector("img");
        if (imgElement) {
            imgElement.src = imgElement.src; // Mantém o caminho absoluto da imagem
        }

        // Criar um elemento de área editável para copiar a assinatura formatada
        var tempDiv = document.createElement("div");
        tempDiv.contentEditable = true;
        tempDiv.style.position = "absolute";
        tempDiv.style.left = "-9999px"; // Esconde o elemento da tela
        document.body.appendChild(tempDiv);

        // Insere o HTML da assinatura dentro do elemento temporário
        tempDiv.innerHTML = assinaturaClone.innerHTML;

        // Seleciona o conteúdo do elemento temporário
        var range = document.createRange();
        range.selectNodeContents(tempDiv);
        var selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);

        // Executa o comando de cópia
        try {
            var sucesso = document.execCommand("copy");
            if (sucesso) {
                alert("Assinatura copiada com sucesso! Agora você pode colar no seu e-mail.");
            } else {
                throw new Error("Falha ao copiar");
            }
        } catch (err) {
            console.error("Erro ao copiar assinatura:", err);
            alert("Erro ao copiar a assinatura. Tente novamente.");
        }

        // Limpa a seleção e remove o elemento temporário
        selection.removeAllRanges();
        document.body.removeChild(tempDiv);
    }
    function editarAssinatura() {
        document.getElementById("signature-section").style.display = "none";
        document.getElementById("form-section").style.display = "block";
    }

    $(document).ready(function() {
        $('.phone-mask').mask('(00) 00000-0000');
    });
</script>

</body>
</html>
