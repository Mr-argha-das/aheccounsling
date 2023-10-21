<?php

namespace App\Providers;

use Google_Client;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Storage;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('google', function($app, $config) {

            
            // $service = new \Google_Service_Drive($client);
            // $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, '1Fi7abiEB7y1DFE3UJ8eu6J5lEToritNS');
            // $filesystem = new \League\Flysystem\Filesystem($adapter);
            // dd($filesystem);


             $client = new \Google_Client();
             $client->setClientId('275479242005-8rnkrpvmbcqv1jekbtd0444294f8kea3.apps.googleusercontent.com');
            $client->setClientSecret('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');
            $client->refreshToken('1//04a71X1VEC1H-CgYIARAAGAQSNwF-L9IrnPznV5QWZtHQqgKrNsD5aWIBXz5lTw6pA_5_NrQiRc_jr2bxxTHe-amwAFmbX0fYnIk');

            $service = new \Google_Service_Drive($client);

            $options = [];
            if(isset($config['teamDriveId'])) {
                $options['teamDriveId'] = $config['teamDriveId'];
            }
           $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, 'root');
             // $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, '1Fi7abiEB7y1DFE3UJ8eu6J5lEToritNS');
            $filesystem = new \League\Flysystem\Filesystem($adapter);
            

            return $filesystem;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}