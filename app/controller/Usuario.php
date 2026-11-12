<?php

/**
 * Usuario
 *
 * Cadastro de quem acessa o admin. Só para Administradores (nível 1).
 */
class Usuario extends AdminController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->exigeAdministrador();

        $this->model = $this->model("Usuario");
    }

    public function index()
    {
        return $this->view("admin/listaUsuario", [
            "rows"    => $this->model->lista(),
            "aNivel"  => UsuarioModel::NIVEIS
        ]);
    }

    public function form()
    {
        return $this->view("admin/formUsuario", [
            "dados"  => $this->registroDoFormulario($this->model),
            "aNivel" => UsuarioModel::NIVEIS
        ]);
    }

    public function insert()
    {
        $this->exigePost();

        $dados = $this->dadosDoPost(true);

        try {
            $id = $this->model->insert($dados);
        } catch (PDOException $ex) {
            $this->trataEmailDuplicado($ex);
        }

        if ($id > 0) {
            $this->redirect('msgSucesso', 'Usuário cadastrado com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível cadastrar o Usuário.');
        }
    }

    public function update()
    {
        $this->exigePost();

        $id    = (int)$this->request->post('id');
        $dados = $this->dadosDoPost(false);

        // Evita que o administrador tranque a si mesmo do lado de fora
        if ($id == usuarioLogado()['id'] && ($dados['statusRegistro'] != 1 || $dados['nivel'] != 1)) {
            $this->redirect('msgError', 'Você não pode inativar nem rebaixar o seu próprio usuário.');
        }

        try {
            $this->model->update($id, $dados);
        } catch (PDOException $ex) {
            $this->trataEmailDuplicado($ex);
        }

        $this->redirect('msgSucesso', 'Usuário alterado com sucesso!');
    }

    public function delete()
    {
        $this->exigePost();

        $id = (int)$this->request->post('id');

        if ($id == usuarioLogado()['id']) {
            $this->redirect('msgError', 'Você não pode excluir o seu próprio usuário.');
        }

        if ($this->model->delete($id) > 0) {
            $this->redirect('msgSucesso', 'Usuário excluído com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível excluir o Usuário.');
        }
    }

    /**
     * dadosDoPost
     *
     * @param bool $senhaObrigatoria  true no insert; no update, senha em branco mantém a atual
     * @return array
     */
    private function dadosDoPost(bool $senhaObrigatoria): array
    {
        $dados = [
            'nome'           => $this->request->post('nome'),
            'email'          => $this->request->post('email'),
            'senha'          => $this->request->post('senha'),
            'nivel'          => ($this->request->post('nivel') == '1' ? 1 : 2),
            'statusRegistro' => ($this->request->post('statusRegistro') == '2' ? 2 : 1),
        ];

        if ($dados['nome'] == "") {
            $this->redirect('msgError', 'Informe o nome do usuário.');
        }

        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $this->redirect('msgError', 'Informe um e-mail válido.');
        }

        if (($senhaObrigatoria || $dados['senha'] != "") && mb_strlen($dados['senha']) < 6) {
            $this->redirect('msgError', 'A senha precisa ter pelo menos 6 caracteres.');
        }

        return $dados;
    }

    /**
     * trataEmailDuplicado
     *
     * O índice UNIQUE da coluna email recusa e-mail repetido (SQLSTATE 23000).
     *
     * @param PDOException $ex
     * @return never
     */
    private function trataEmailDuplicado(PDOException $ex): never
    {
        if ($ex->getCode() == '23000') {
            $this->redirect('msgError', 'Já existe um usuário com este e-mail.');
        }

        throw $ex;
    }
}
