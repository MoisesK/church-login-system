<?php

namespace App\Routes;

use \Closure;
use \Exception;

class Router
{
    private string $url;
    private mixed $prefix;
    private array $routes = [];
    private Request $request;

    public function __construct(string $url)
    {
        $this->request = new Request($this);
        $this->url = $url;
        $this->setPrefix();
    }


    private function getPrefix(): string
    {
        return $this->prefix;
    }

    private function setPrefix(): void
    {
        $parseUrl = parse_url($this->url);

        $this->prefix = $parseUrl['path'] ?? '';
    }

    public function getUrl()
    {
        return $this->url;
    }

    private function addRoute(string $method, string $route, array $params = []): void
    {
        // Valida Parametros
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                //Método para identificar o parametro passado
                $params['Controllers'] = $value;
                unset($params[$key]);
            }
        }

        // Padrão de validação da URL
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';
        $this->routes[$patternRoute][$method] = $params;
    }

    public function get(string $route, array $params = []): void
    {     // Método responsável por definir uma rota GET
        $this->addRoute('GET', $route, $params);
    }

    public function post(string $route, array $params = []): void
    {    // Método responsável por definir uma rota POST
        $this->addRoute('POST', $route, $params);
    }


    private function getRoute(): array
    {    // Retorna array com dados da rota atual e valida a rota

        $uri = $this->request->getUri();
        $xUri = strlen($this->getPrefix()) ? explode($this->getPrefix(), $uri) : [$uri];

        //URI sem Prefixo
        $uriSemPre = end($xUri);

        $httpMethod = $this->request->getHttpMethod();

        //Valida as rotas
        foreach ($this->routes as $patternroute => $methods) {
            // Verifica se a URI bate com o Padrão
            if (preg_match($patternroute, $uriSemPre)) {

                // Verificão de método
                if ($methods[$httpMethod]) {

                    // Retorno dos Parametros da Rota
                    return $methods[$httpMethod];
                }

                throw new Exception("Método não permitido", 405);
            }
        }

        throw new Exception("URL não encontrada", 404);
    }


    public function run()
    {
        try { // Validação de rotas
            $route = $this->getRoute();

            if (!isset($route['Controllers'])) : throw new Exception("URL não pôde ser processada", 500);
            endif;

            $args = [];
            // Retorna a execução da função
            return call_user_func_array($route['Controllers'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    public function getCurrentUrl()
    {
        return $this->getUrl() . $this->Request->getUri();
    }
}
