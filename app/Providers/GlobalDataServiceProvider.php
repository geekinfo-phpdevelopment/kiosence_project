<?php

namespace App\Providers;

use App\Http\Middleware\UserAuth;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use View;
use Illuminate\Support\Facades\Auth;
class GlobalDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view::share('globalData', $this->getGlobalData());
    }
    protected function getGlobalData()
    {
        // dd(auth()->user());
        // if(auth()->check()) {
            
        // }else{
        //     dd('checked : false');
        // }
        // $user_id =Auth::user();
        
        $user=User::find(1);
        $modules = Permission::select('modules.*')
            ->join('modules', 'modules.id', "=", "permissions.module_id")
            ->where('permissions.role_id', "=", $user->role_id)
            ->where('permissions.read', "=", 1)
            ->get();
            // dd($modules);
        return [
            'modules' => $modules,
            // Add more global data as needed
        ];
    }
}
