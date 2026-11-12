<?php

/**
 * AdminController
 *
 * Classe mãe dos controllers da área administrativa.
 * Herança em dois níveis: Categoria -> AdminController -> BaseController.
 *
 * Tudo o que for comum ao admin fica aqui, num lugar só:
 * - exigir login (no construtor: vale para TODOS os métodos do controller filho).
 *
 * (Na Aula 3 esta classe ganha o tratamento de upload de imagens.)
 */
abstract class AdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        if (usuarioLogado() === null) {
            $this->redirect('msgError', 'Faça login para acessar a área administrativa.', 'Login');
        }
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
     * encontrado (ex.: /Categoria/form/update/999).
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
