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
			\Aion\MyHeroAcademia\Repositories\Contracts\IAuthRepository::class,
			\Aion\MyHeroAcademia\Repositories\AuthRepository::class
		);

		$this -> app -> bind(
			\Aion\MyHeroAcademia\Repositories\Contracts\IUsuarioRepository::class,
			\Aion\MyHeroAcademia\Repositories\UsuarioRepository::class
		);

		$this -> app -> bind(
			\Aion\MyHeroAcademia\Repositories\Contracts\INotaRepository::class,
			\Aion\MyHeroAcademia\Repositories\NotaRepository::class
		);

		$this -> app -> bind(
			\Aion\MyHeroAcademia\Repositories\Contracts\IModuloRepository::class,
			\Aion\MyHeroAcademia\Repositories\ModuloRepository::class
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
