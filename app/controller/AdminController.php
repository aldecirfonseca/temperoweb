<?php

require_once 'app/library/Upload.php';

/**
 * AdminController
 *
 * Classe mãe dos controllers da área administrativa.
 * Herança em dois níveis: Produto -> AdminController -> BaseController.
 *
 * Tudo o que for comum ao admin fica aqui, num lugar só:
 * - exigir login (no construtor: vale para TODOS os métodos do controller filho);
 * - tratar o upload de imagens.
 */
abstract class AdminController extends BaseController
{
    protected Upload $upload;

    public function __construct()
    {
        parent::__construct();

        if (usuarioLogado() === null) {
            $this->redirect('msgError', 'Faça login para acessar a área administrativa.', 'Login');
        }

        $this->upload = new Upload();
    }

    /**
     * exigeAdministrador
     *
     * Para controllers que só o nível 1 (Administrador) pode usar.
     *
     * @return void
     */
    protected function exigeAdministrador(): void
    {
        if (usuarioLogado()['nivel'] != 1) {
            $this->redirect('msgError', 'Acesso permitido somente para administradores.', 'Reserva');
        }
    }

    /**
     * registroDoFormulario
     *
     * Dados do registro indicado na URL (/Programa/form/{action}/{id}).
     * Volta para a lista se a action não existir ou se o id não for
     * encontrado (ex.: /Produto/form/update/999).
     *
     * @param BaseModel $model
     * @param array $actions  actions aceitas por este formulário
     * @return array          registro ou [] no insert
     */
    protected function registroDoFormulario(BaseModel $model, array $actions = ["insert", "update", "view", "delete"]): array
    {
        $action = $this->request->getAction();

        if (!in_array($action, $actions)) {
            $this->redirect('msgError', 'Operação inválida.');
        }

        $dados = $model->getById($this->request->getId());

        if ($action != "insert" && empty($dados)) {
            $this->redirect('msgError', 'Registro não encontrado.');
        }

        return $dados;
    }

    /**
     * trataImagem
     *
     * Decide qual imagem o registro terá depois de gravar o formulário:
     * - enviou arquivo novo: grava o novo e apaga o antigo;
     * - marcou "remover imagem": apaga o antigo e fica sem imagem (null);
     * - não fez nada: mantém a imagem atual.
     *
     * @param string $pasta              subpasta de assets/img
     * @param string|null $imagemAtual   imagem gravada no banco (null no insert)
     * @return string|null
     * @throws RuntimeException          arquivo inválido (mensagem pronta para o usuário)
     */
    protected function trataImagem(string $pasta, ?string $imagemAtual = null): ?string
    {
        $nova = $this->upload->salvar($this->request->arquivo('imagem'), $pasta);

        if ($nova != "") {
            $this->upload->remover($imagemAtual, $pasta);
            return $nova;
        }

        if ($this->request->post('removerImagem') == '1') {
            $this->upload->remover($imagemAtual, $pasta);
            return null;
        }

        return $imagemAtual;
    }

    /**
     * ehErroDeChaveEstrangeira
     *
     * O MySQL recusa (SQLSTATE 23000) apagar um registro que outra tabela
     * ainda usa, por exemplo uma categoria que tem produtos.
     *
     * @param PDOException $ex
     * @return bool
     */
    protected function ehErroDeChaveEstrangeira(PDOException $ex): bool
    {
        return $ex->getCode() == '23000';
    }
}
