<?php

class BaseController
{
    public $request;

    public function __construct()
    {
        $this->request = new Request();

        // carregando helpers
        $this->helper('utilits');
    }

    /**
     * Undocumented function
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public function view(string $view, array $data = [])
    {
        $data['action'] = $this->request->getAction();

        extract($data);
        require_once 'app/view/' . $view . ".php";
    }

    /**
     * Undocumented function
     *
     * @param string|array $nomeHelper
     * @return void
     */
    public function helper(string|array $nomeHelper)
    {
        // Se Helper for string, converte para array
        if (gettype($nomeHelper == 'string')) {
            $nomeHelper = [$nomeHelper];
        }

        foreach ($nomeHelper as $helper) {
            require_once 'app/helper/' . $helper . ".php";
        }
    }

    /**
     * Undocumented function
     *
     * @param string $nomeModel
     * @return object
     */
    public function model(string $nomeModel): object
    {
        $nomeModel = ucfirst($nomeModel) . 'Model';

        if (file_exists('app/model/' . $nomeModel . '.php')) {
            require_once 'app/model/' . $nomeModel . '.php';

            return new $nomeModel();
        } else {
            return (object)null;
        }
    }
}