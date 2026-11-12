<?php

/**
 * Contato
 *
 * Mensagens recebidas pelo "Fale conosco". O admin só lê e exclui:
 * quem cadastra é o visitante do site (Home::enviarContato).
 */
class Contato extends AdminController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model("Contato");
    }

    public function index()
    {
        return $this->view("admin/listaContato", ["rows" => $this->model->lista()]);
    }

    public function form()
    {
        // só visualizar e excluir
        $dados = $this->registroDoFormulario($this->model, ["view", "delete"]);

        // abriu para ler: marca como lida
        if ($this->request->getAction() == "view" && $dados['lido'] == 0) {
            $this->model->marcaComoLida((int)$dados['id']);
        }

        return $this->view("admin/formContato", ["dados" => $dados]);
    }

    public function delete()
    {
        $this->exigePost();

        if ($this->model->delete((int)$this->request->post('id')) > 0) {
            $this->redirect('msgSucesso', 'Mensagem excluída com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível excluir a Mensagem.');
        }
    }
}
