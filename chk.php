<?php

function getCardInfo($bin)
{
    $url = 'https://bincheck.io/pt/details/' . $bin;
    
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'
    ]);
    
    $response = curl_exec($curl);
    
    if(curl_errno($curl)) {
        echo 'Erro ao acessar a página: ' . curl_error($curl);
        return null;
    }
    
    curl_close($curl);
    
    $pattern = '/<td[^>]*?class="[^"]*?font-medium[^"]*?"[^>]*?>(.*?)<\/td>\s*<td[^>]*?class="[^"]*?p-2[^"]*?"[^>]*?>(.*?)<\/td>/';
    preg_match_all($pattern, $response, $matches, PREG_SET_ORDER);
    
    $cardInfo = [];
    
    foreach ($matches as $match) {
        $key = trim(strip_tags($match[1]));
        $value = trim(strip_tags($match[2]));
        
        switch ($key) {
            case 'BIN/IIN':
                $cardInfo['Bin'] = $value;
                break;
            case 'Marca do cartão':
                $cardInfo['Bandeira'] = $value;
                break;
            case 'Tipo de carta':
                $cardInfo['Tipo'] = $value;
                break;
            case 'Nível do cartão':
                $cardInfo['Nível'] = $value;
                break;
            case 'Nome do país ISO':
                $cardInfo['País'] = $value;
                break;
            case 'Código de país ISO A2':
                $cardInfo['Sigla'] = $value;
                break;
            case 'Nome do Emissor / Banco':
                $cardInfo['Banco'] = $value;
                break;
        }
    }
    
    $cardInfo['Coder'] = 'yFxz - LkDeveloper';
    
    return $cardInfo;
}

// Verifica se o parâmetro 'bin' foi fornecido na URL
if (isset($_GET['bin'])) {
    $bin = $_GET['bin'];
    $cardInfo = getCardInfo($bin);
    
    // Se houver informações do cartão, exibe-as em uma interface HTML/CSS
    if ($cardInfo) {
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo-chk.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="reveal.js" defer></script>
    <title>Informações do Cartão</title>
</head>
<body>
    <div class="container">
        <h1>Informações da BIN</h1>
        <div class="card-info">
            <?php
                foreach ($cardInfo as $key => $value) {
                    echo '<div class="card-info-item"><span>' . $key . ':</span> ' . $value . '</div>';
                }
            ?>
        </div>
    </div>
    <footer class="roda">
        API por <a href="https://github.com/yfxzdevs/" target="_blank">yFxZ</a> - Desenvolvido por <a href="https://github.com/lucasdeveloperx" target="_blank">LKDeveloper</a>
    </footer>
</body>
</html>
<?php
    } else {
        echo json_encode(['error' => 'Não foi possível obter informações para o BIN fornecido.']);
    }
} else {
    // Se a BIN não foi fornecida na URL, exibe um formulário para inserir a BIN
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="reveal.js" defer></script>
    <title>Verificar BIN</title>
</head>
<body>
<body>

   <script src="../system/js/aluno.js"></script>    

<form method="GET" action="">
        <label for="bin">Insira a BIN:</label><br>
        <link rel="stylesheet" type="text/css" href="estilo.css" />

        <input type="text" id="bin" name="bin"><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>

                </a>
            </li>
        </ul>
    </nav>
</html>
<?php
}
?>
