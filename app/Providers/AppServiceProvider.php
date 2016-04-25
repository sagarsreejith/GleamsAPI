<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Please note the different namespace 
        // and please add a \ in front of your classes in the global namespace
        \Event::listen('cron.collectJobs', function() {

            \Cron::add('cronjob1', '* * * * *', function() {
                // Do some crazy things unsuccessfully every minute         

            	$count = 1;
            	//$current_time = Carbon::now();

            	DB::table('meetings')->where('id', '1')->update(['status' => '1']);            	

                return 'No';
            });

   			// \Cron::setEnableJob('cronjob1');
			// // One job will be called
			// $report = \Cron::run();

        });        

	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
