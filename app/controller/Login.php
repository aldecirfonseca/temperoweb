<?php

/**
 * Login
 *
 * Entrada e saída da área administrativa.
 * Estende BaseController (e não AdminController): precisa abrir sem login.
 */
class Login extends BaseController
{
    public function index()
    {
        // já entrou? vai direto para o admin
        if (usuarioLogado() !== null) {
            $this->redirect('', '', 'Reserva');
        }

        return $this->view("login");
    }

    /**
     * entrar
     *
     * @return void
     */
    public function entrar()
    {
        $this->exigePost();

        $email = $this->request->post('email');
        $senha = $this->request->post('senha');

        $usuario = $this->model("Usuario")->getAtivoPorEmail($email);

        // Mesma mensagem para e-mail inexistente e senha errada:
        // assim ninguém descobre quais e-mails estão cadastrados.
        if (empty($usuario) || !password_verify($senha, $usuario['senha'])) {
            $this->redirect('msgError', 'E-mail ou senha inválidos.');
        }

        // Novo id de sessão a cada login (evita "fixação de sessão")
        session_regenerate_id(true);

        // Guarda só o necessário: nunca o hash da senha
        $_SESSION['usuario'] = [
            'id'    => (int)$usuario['id'],
            'nome'  => $usuario['nome'],
            'nivel' => (int)$usuario['nivel'],
        ];

        $this->redirect('msgSucesso', 'Olá, ' . $usuario['nome'] . '!', 'Reserva');
    }

    /**
     * sair
     *
     * @return void
     */
    public function sair()
    {
        $_SESSION = [];
        session_destroy();

        $this->redirect('msgSucesso', 'Você saiu da área administrativa.');
    }
}
