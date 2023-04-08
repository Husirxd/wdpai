<?php

class AppController {
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        
        $templatePath = 'frontend/templates/'. $template.'.php';
        $output = 'File not found';
                
        if(file_exists($templatePath)){
            $title = 'Kogoot';
            extract($variables);
            ob_start();
            include_once 'frontend/partials/header.php';
            include $templatePath;
            include_once 'frontend/partials/footer.php';
            $output = ob_get_clean();
        }
        print $output;
    }
}