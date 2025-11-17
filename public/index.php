<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apolo</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/c25eca0384.js" crossorigin="anonymous"></script>
</head>
<body onload="trocaCartaz()">
    <header>
            <h1 class="titulo-cabecalho">Apolo
            </h1>
            <div class="login-cabecalho">
                <i class="fa-solid fa-user icone-usuario"></i>
                <h3>Registro</h3>
            </div>
    </header>
    <main> 
        <aside class="ranking">
            <h2 class="titulo-ranking">Ranking</h2>
        </aside>
        <div class="botoes-main">
            <button type="button" class="botao-main"><a href="">Avaliações</a></button>
            <button type="button" class="botao-main"><a href="filmes.html">Filmes</a></button>
            <button type="button" class="botao-main"><a href="">Gêneros</a></button>
        </div>
        <div class="filmes-main" id="filmes-main-id">
            <img src="images/cartaz0.png" id="img-cartaz-id" class="img-cartaz">
        </div>
    </main>
    <script>
        const MAXFILMES = 3;
        filme = 1;
        function trocaCartaz(){
            img = document.getElementById('img-cartaz-id');
            setInterval(() => {
                img.style.opacity = 0.1;

                setTimeout(() => {
                    img.src = `images/cartaz${filme}.png`
                    img.style.opacity = 1;
                    filme++;
                }, 500);
                if(filme>MAXFILMES){
                    filme = 0;
                }
            }, 5*1000);
        }
    </script>
</body>
</html>

<?php 
require_once __DIR__ . '/../config/db.php'; 
// rota no formato ?entidade=livro&acao=listar 
$entidade = isset($_GET['entidade']) ? $_GET['entidade'] : 'home'; 
$acao     = isset($_GET['acao']) ? $_GET['acao'] : 'index'; 
$arquivo = __DIR__ . '/../src/controller/' . $entidade . '_' . $acao . 
'.php'; 
if (file_exists($arquivo)) { 
require $arquivo; 
} else { 
http_response_code(404); 
echo '<script>console.log("Rota não encontrada!");'; 
} 