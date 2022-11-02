<?php

namespace App\Routes;

class Response
{
    private int $httpCode = 200;
    private array $headers;
    private string $contentType = 'text/html';
    private string $content;

    public function __construct(string $httpCode, mixed $content, mixed $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    public function setContentType($contentType): void
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    public function addHeader(string $chave, string $valor): void
    {
        $this->headers[$chave] = $valor;
    }

    public function sendHeaders(): void
    {

        http_response_code($this->httpCode);

        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    public function sendResponse(): void
    { //Método repsonsável por enviar a resposta para o usuário "imprime o conteúdo"

        $this->sendHeaders();

        //imprime o conteúdo
        switch ($this->contentType) {
            case ($this->contentType = 'text/html'):
                echo $this->content;
                exit;
        }
    }
}
