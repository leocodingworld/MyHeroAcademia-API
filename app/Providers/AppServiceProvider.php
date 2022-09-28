<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this -> app -> bind(
			\Aion\MyHeroAcademia\Contracts\IAuthRepository::class,
			\Aion\MyHeroAcademia\Repositories\AuthRepository::class
		);

		$this -> app -> bind(
			\Aion\MyHeroAcademia\Contracts\IUsuarioRepository::class,
			\Aion\MyHeroAcademia\Repositories\UsuarioRepository::class
		);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
