<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Log;
use Route;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->macros();
        Passport::routes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    protected function macros()
    {
        Builder::macro("toSqlWithBindings", function(){
            $sql = $this->toSql();
            foreach($this->getBindings() as $binding)
            {
                $value = is_numeric($binding) ? $binding : "'$binding'";
                $sql = preg_replace('/\?/', $value, $sql, 1);
            }
            return $sql;
        });

        Builder::macro("dd", function(){
            if (func_num_args() === 1) {
                $message = func_get_arg(0);
            }
            var_dump((empty($message) ? "" : $message . ": ") . $this->toSqlWithBindings());
            dd($this->get());
        });

        Builder::macro("dump", function(){
            if (func_num_args() === 1) {
                $message = func_get_arg(0);
            }
            var_dump((empty($message) ? "" : $message . ": ") . $this->toSqlWithBindings());
            return $this;
        });

        Builder::macro("log", function(){
            if (func_num_args() === 1) {
                $message = func_get_arg(0);
            }
            Log::debug((empty($message) ? "" : $message . ": ") . $this->toSqlWithBindings());
            return $this;
        });
    }
}
