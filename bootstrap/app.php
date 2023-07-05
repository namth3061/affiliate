
<?php


/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);


/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

//TuanTV load env by domain

if(isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])){
    
    $domain = $_SERVER['HTTP_HOST'];
    $envfile = base_path() . '/.env';
    $dotenv = Dotenv\Dotenv::createImmutable(base_path(), '.env');
    $fullfile = base_path().'/sub_env/.'.$domain.'.env';
    if (isset($domain) & file_exists($fullfile)) {
	      
        $dotenv = Dotenv\Dotenv::createImmutable(base_path().'/sub_env/', '.'.$domain.'.env');
        try 
		{
            $dotenv->load();
	    $envfile = $fullfile;	
        } catch (\Dotenv\Exception\InvalidPathException $e) {
		// No custom .env file found for this domain
        }
    }

    putenv ("env_file_path=".$envfile); 
}

return $app;
