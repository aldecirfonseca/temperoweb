<?php

class Reserva extends AdminController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model("Reserva");
    }

    public function index()
    {
        return $this->view("admin/listaReserva", [
            "rows"      => $this->model->lista(),
            "aSituacao" => ReservaModel::SITUACOES
        ]);
    }

    public function form()
    {
        return $this->view("admin/formReserva", [
            "dados"         => $this->registroDoFormulario($this->model),
            "aHorario"      => ReservaModel::HORARIOS,
            "aSituacao"     => ReservaModel::SITUACOES,
            "maximoPessoas" => ReservaModel::MAXIMO_PESSOAS
        ]);
    }

    public function insert()
    {
        $this->exigePost();

        $id = $this->model->insert($this->dadosDoPost());

        if ($id > 0) {
            $this->redirect('msgSucesso', 'Reserva cadastrada com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível cadastrar a Reserva.');
        }
    }

    public function update()
    {
        $this->exigePost();

        $this->model->update((int)$this->request->post('id'), $this->dadosDoPost());

        $this->redirect('msgSucesso', 'Reserva alterada com sucesso!');
    }

    public function delete()
    {
        $this->exigePost();

        if ($this->model->delete((int)$this->request->post('id')) > 0) {
            $this->redirect('msgSucesso', 'Reserva excluída com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível excluir a Reserva.');
        }
    }

    /**
     * dadosDoPost
     *
     * Mesmas regras do formulário do site (ReservaModel::valida),
     * mas aqui a equipe pode editar reservas com data passada.
     *
     * @return array
     */
    private function dadosDoPost(): array
    {
        $dados = [
            'nome'       => $this->request->post('nome'),
            'email'      => $this->request->post('email'),
            'telefone'   => $this->request->post('telefone'),
            'data'       => $this->request->post('data'),
            'horario'    => $this->request->post('horario'),
            'pessoas'    => (int)$this->request->post('pessoas'),
            'observacao' => $this->request->post('observacao'),
            'situacao'   => (int)$this->request->post('situacao'),
        ];

        $erro = $this->model->valida($dados, true);

        if ($erro != "") {
            $this->redirect('msgError', $erro);
        }

        return $dados;
    }
}
