<?php
namespace Fox\Core\Utils\Api;

class Slim extends \Slim\Slim
{

    /**
     * Redefine the run method
     *
     * We no need to use a Slim handler
     */
    public function run()
    {
        $this->middleware[0]->call();

        list($status, $headers, $body) = $this->response->finalize();

        \Slim\Http\Util::serializeCookies($headers, $this->response->cookies, $this->settings);

        if (headers_sent() === false) {
            if (strpos(PHP_SAPI, 'cgi') === 0) {
                header(sprintf('Status: %s', \Slim\Http\Response::getMessageForCode($status)));
            } else {
                header(sprintf('HTTP/%s %s', $this->config('http.version'), \Slim\Http\Response::getMessageForCode($status)));
            }

            foreach ($headers as $name => & $value) {
                $hValues = explode("\n", $value);
                foreach ($hValues as & $hVal) {
                    header("$name: $hVal", false);
                }
            }
        }

        if (!$this->request->isHead()) {
            echo $body;
        }
    }

    public function printError($error, $status)
    {
        echo static::generateTemplateMarkup($status, '<p>'.$error.'</p><a href="' . $this->request->getRootUri() . '/">Visit the Home Page</a>');
    }

}
