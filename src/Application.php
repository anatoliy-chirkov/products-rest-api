<?php

namespace ProductsApi;

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;
use ProductsApi\Http\Handlers\HttpErrorHandler;
use ProductsApi\Http\Handlers\ShutdownHandler;
use ProductsApi\Http\ResponseEmitter;
use Symfony\Component\Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    private $cliMode;
    private $request;
    private $containerBuilder;
    private $app;
    private $database;

    private function __construct()
    {
        $this->cliMode = $this->isCliMode();
    }

    public static function init()
    {
        $application = new self;

        if ($application->cliMode) {
            return $application;
        }

        $application->containerBuilder = new ContainerBuilder();

        $definitions = require APP_PATH.'repositories.php';
        $definitions($application->containerBuilder);

        AppFactory::setContainer($application->containerBuilder->build());
        $application->app = AppFactory::create();

        return $application;
    }

    public function setupDotEnv()
    {
        $dotenv = new Dotenv();
        $dotenv->load(ROOT_PATH.'.env');

        return $this;
    }

    public function setupDatabase()
    {
        $this->database = new Capsule();
        $this->database->addConnection($this->getDatabaseConfig());
        $this->database->setAsGlobal();
        $this->database->bootEloquent();

        return $this;
    }

    public function getDatabaseObject()
    {
        return $this->database;
    }

    public function setupHttpRequest()
    {
        $this->request = ServerRequestCreatorFactory::create()
            ->createServerRequestFromGlobals()
        ;

        return $this;
    }

    public function setupHttpErrorHandler()
    {
        $errorHandler = $this->createErrorHandler();
        $this->registerShutdownHandler($errorHandler);
        $this->app->addErrorMiddleware($_ENV['DEBUG_MODE'], false, false)
            ->setDefaultErrorHandler($errorHandler)
        ;

        return $this;
    }

    public function setupHttpRoutes()
    {
        $routes = require APP_PATH.'routes.php';
        $routes($this->app);

        $this->app->addRoutingMiddleware();

        return $this;
    }

    public function run()
    {
        if ($this->cliMode) {
            return;
        }

        $response = $this->app->handle($this->request);
        $responseEmitter = new ResponseEmitter();
        $responseEmitter->emit($response);
    }

    private function getDatabaseConfig()
    {
        return [
            'driver'    => 'mysql',
            'host'      => 'mysql',
            'database'  => $_ENV['COMPOSE_PROJECT_NAME'],
            'username'  => 'root',
            'password'  => $_ENV['MYSQL_ROOT_PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict' => false
        ];
    }

    private function registerShutdownHandler($errorHandler)
    {
        $shutdownHandler = new ShutdownHandler(
            $this->request,
            $errorHandler,
            $_ENV['DEBUG_MODE']
        );

        register_shutdown_function($shutdownHandler);
    }

    private function createErrorHandler()
    {
        $responseFactory = $this->app->getResponseFactory();
        $callableResolver = $this->app->getCallableResolver();

        return new HttpErrorHandler($callableResolver, $responseFactory);
    }

    private function isCliMode()
    {
        return in_array(PHP_SAPI, ['cli', 'cli-server']);
    }
}
