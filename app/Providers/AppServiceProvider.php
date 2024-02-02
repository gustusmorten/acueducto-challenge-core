<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('api', function ($data = null, $error = null, $status = 200) {
            $status = (int) $status;
            $errorFriendlyMessage = "An error occurred";
            $response = [
                'status' => $status,
                'apiVersion' => 'v1',
            ];

            if ($status >= 400) {
                $response['error'] = $error;
                $response['message'] = $errorFriendlyMessage;
            } else {
                $response['data'] = $data;
            }
            return response()->json($response);
        });
    }
}
