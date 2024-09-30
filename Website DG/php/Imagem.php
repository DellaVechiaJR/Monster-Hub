<?php
class Imagem {
    public $imagemPerfil;
    public $comentario;
    public $pontuacao;

    public function __construct($nome) {
        $this->imagemPerfil = '';
        $this->comentario = '';
        $this->pontuacao = 0;
    }

    public function adicionarComentario($comentario) {
        $this->comentario = htmlspecialchars($comentario); // Evita XSS
        echo "Comentário adicionado: " . $this->comentario;
    }

    public function adicionarPontuacao($pontuacao) {
        if ($pontuacao >= 1 && $pontuacao <= 5) {
            $this->pontuacao = (int)$pontuacao;
            echo "Pontuação atribuída: " . $this->pontuacao . " estrela(s)";
        } else {
            echo "Pontuação inválida. Por favor, escolha entre 1 e 5 estrelas.";
        }
    }

    //adicionar
    public function adicionarImagemPerfil($imagem) {
        if (move_uploaded_file($imagem['tmp_name'], 'caminho/diretorio/' . $imagem['name'])) {
            $this->imagemPerfil = $imagem['name']; // Armazena o nome da imagem
            echo "Imagem de perfil adicionada: " . $this->imagemPerfil;
        } else {
            echo "Falha ao adicionar a imagem de perfil.";
        }
    }

    // atualizar
    public function atualizarImagemPerfil($imagem) {

        // deleta a imagem primeiro se existir, depois adiciona a nova.
        if ($this->imagemPerfil) {
            unlink('caminho/diretorio/' . $this->imagemPerfil); // Remove a imagem antiga
        }
        $this->adicionarImagemPerfil($imagem);
    }

    // deletar
    public function deletarImagemPerfil() {
        if ($this->imagemPerfil) {
            unlink('caminho/diretorio/' . $this->imagemPerfil); // Remove a imagem
            $this->imagemPerfil = ''; // string vazia para deletar a imagem
            echo "Imagem de perfil deletada.";
        } else {
            echo "Nenhuma imagem de perfil para deletar.";
        }
    }
}

?>