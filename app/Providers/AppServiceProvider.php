<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

// Model Imports
use App\Models\User;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\ItemPenjualan;
use App\Models\Setting;

// Policy Imports
use App\Policies\DashboardPolicy;
use App\Policies\PenjualanPolicy;
use App\Policies\ProdukPolicy;
use App\Policies\ItemPenjualanPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Pendaftaran Policy Otentikasi
     */
    protected $policies = [
        User::class => DashboardPolicy::class,
        Produk::class => ProdukPolicy::class,
        Penjualan::class => PenjualanPolicy::class,
        ItemPenjualan::class => ItemPenjualanPolicy::class,
    ];

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
        Paginator::useBootstrapFive();
        Carbon::setLocale('id');
        $this->registerPolicies();

        // MENGIRIMKAN DATA $setting KE SEMUA VIEW BLADE SECARA OTOMATIS
        View::composer('*', function ($view) {
            if (Schema::hasTable('settings')) {
                $setting = Setting::first();
                $view->with('setting', $setting);
            }
        });
    }
}