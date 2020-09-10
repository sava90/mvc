<?php

namespace Base;

trait Template
{
    public $viewData = [];

    public function fetch($viewName, $dataArray = null)
    {
        $dataArray = $dataArray ? $dataArray : $this->viewData;
        extract($dataArray, EXTR_PREFIX_ALL, 'view');
        ob_start();

        if (is_file(__DIR__ . '/../View/' . $viewName . '.php')) {
            require_once(__DIR__ . '/../View/' . $viewName . '.php');
        }

        $viewContent = ob_get_contents();
        ob_end_clean();

        return $viewContent;
    }
}