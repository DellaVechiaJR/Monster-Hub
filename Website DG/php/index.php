<?php
session_start();

require_once 'imagem.php';

$imagem = new Imagem("nome da imagem");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica a ação a ser realizada
    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];

        // Atualizar imagem de perfil
        if ($acao == 'atualizar' && isset($_FILES['novaImagem'])) {
            $imagem->atualizarImagemPerfil($_FILES['novaImagem']);
        }

        // Deletar imagem de perfil
        elseif ($acao == 'deletar') {
            $imagem->deletarImagemPerfil();
        }
    }

    // Armazena a nota e o comentário em variáveis
    $rating = isset($_POST['rating']) ? $_POST['rating'] : 'Sem nota';
    $comment = isset($_POST['comment']) ? $_POST['comment'] : 'Sem comentário';

    // Salva os dados na sessão
    $_SESSION['feedback'][] = array('rating' => $rating, 'comment' => $comment);

    // Redireciona de volta para a página de feedback
    header('Location: feedback.php');
    exit();
}
?>