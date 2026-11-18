<?php

/**
 * Upload
 *
 * Recebe imagens enviadas por formulário (enctype="multipart/form-data")
 * e grava em assets/img/{pasta}/ com um nome aleatório.
 *
 * Regras de segurança:
 * - o tipo é conferido pelo CONTEÚDO do arquivo (finfo), não pela extensão
 *   nem pelo $_FILES['type'], que são informados pelo navegador e podem ser falsos;
 * - a extensão final é escolhida aqui (jpg/png/webp), nunca vem do usuário:
 *   assim ninguém consegue enviar um "foto.php";
 * - o nome é aleatório: não sobrescreve arquivos e não revela o nome original.
 */
class Upload
{
    // tipo MIME aceito => extensão gravada
    private const TIPOS = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
    ];

    // 2 MB (o php.ini do WAMP também limita em upload_max_filesize = 2M)
    private const TAMANHO_MAXIMO = 2 * 1024 * 1024;

    private const PASTA_BASE = 'assets/img/';

    /**
     * salvar
     *
     * @param array $arquivo  item de $_FILES (ex.: $_FILES['imagem'])
     * @param string $pasta   subpasta de assets/img (ex.: 'produto')
     * @return string         nome do arquivo gravado ou "" se nenhum arquivo foi enviado
     * @throws RuntimeException com uma mensagem pronta para o usuário
     */
    public function salvar(array $arquivo, string $pasta): string
    {
        // campo vazio: o usuário não escolheu arquivo (não é erro)
        if (empty($arquivo) || $arquivo['error'] === UPLOAD_ERR_NO_FILE) {
            return "";
        }

        if ($arquivo['error'] === UPLOAD_ERR_INI_SIZE || $arquivo['error'] === UPLOAD_ERR_FORM_SIZE) {
            throw new RuntimeException("A imagem passa do tamanho máximo de 2 MB.");
        }

        if ($arquivo['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($arquivo['tmp_name'])) {
            throw new RuntimeException("Falha no envio da imagem. Tente novamente.");
        }

        if ($arquivo['size'] > self::TAMANHO_MAXIMO) {
            throw new RuntimeException("A imagem passa do tamanho máximo de 2 MB.");
        }

        $tipo = (new finfo(FILEINFO_MIME_TYPE))->file($arquivo['tmp_name']);

        if (!isset(self::TIPOS[$tipo])) {
            throw new RuntimeException("Formato de imagem não aceito. Envie JPG, PNG ou WEBP.");
        }

        $nome    = bin2hex(random_bytes(16)) . '.' . self::TIPOS[$tipo];
        $destino = self::PASTA_BASE . $pasta . '/' . $nome;

        if (!is_dir(self::PASTA_BASE . $pasta)) {
            mkdir(self::PASTA_BASE . $pasta, 0755, true);
        }

        if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
            throw new RuntimeException("Não foi possível gravar a imagem no servidor.");
        }

        return $nome;
    }

    /**
     * remover
     *
     * Apaga uma imagem enviada por upload. Só remove arquivos com o padrão de
     * nome gerado por salvar(): as imagens que vêm no script SQL de exemplo
     * (featured1.png, chef-1.png...) nunca são apagadas.
     *
     * @param string|null $nome
     * @param string $pasta
     * @return void
     */
    public function remover(?string $nome, string $pasta): void
    {
        if ($nome === null || !preg_match('/^[a-f0-9]{32}\.(jpg|png|webp)$/', $nome)) {
            return;
        }

        $caminho = self::PASTA_BASE . $pasta . '/' . $nome;

        if (is_file($caminho)) {
            unlink($caminho);
        }
    }
}
