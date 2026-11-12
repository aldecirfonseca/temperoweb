<?php

/**
 * Senha
 *
 * "Trocar a senha" do usuário logado (qualquer nível).
 */
class Senha extends AdminController
{
    public function index()
    {
        return $this->view("admin/formSenha");
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $this->exigePost();

        $senhaAtual    = $this->request->post('senhaAtual');
        $novaSenha     = $this->request->post('novaSenha');
        $confirmaSenha = $this->request->post('confirmaSenha');

        $UsuarioModel = $this->model("Usuario");
        $id           = usuarioLogado()['id'];

        if (!password_verify($senhaAtual, $UsuarioModel->getSenhaHash($id))) {
            $this->redirect('msgError', 'A senha atual não confere.');
        }

        if (mb_strlen($novaSenha) < 6) {
            $this->redirect('msgError', 'A nova senha precisa ter pelo menos 6 caracteres.');
        }

        if ($novaSenha !== $confirmaSenha) {
            $this->redirect('msgError', 'A confirmação não é igual à nova senha.');
        }

        $UsuarioModel->atualizaSenha($id, $novaSenha);

        $this->redirect('msgSucesso', 'Senha alterada com sucesso!');
    }
}
