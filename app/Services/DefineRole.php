<?php
namespace App\Services;
use Illuminate\Support\Facades\Gate;

class DefineRole
{
    public function setGateAndPolicyAccess()
    {
        $this->defineCategory();
        $this->defineMenu();
        $this->defineSetting();
        $this->defineSlider();
        $this->defineProduct();
        $this->defineUser();
        $this->defineOrder();
    }
    public function defineCategory()
    {
        Gate::define('category-list','App\Policies\CategoryPolicy@view');
        Gate::define('category-add','App\Policies\CategoryPolicy@create');
        Gate::define('category-edit','App\Policies\CategoryPolicy@update');
        Gate::define('category-delete','App\Policies\CategoryPolicy@delete');
    }
    public function defineMenu()
    {
        Gate::define('menu-list','App\Policies\MenuPolicy@view');
        Gate::define('menu-add','App\Policies\MenuPolicy@create');
        Gate::define('menu-edit','App\Policies\MenuPolicy@update');
        Gate::define('menu-delete','App\Policies\MenuPolicy@delete');
    }
    public function defineSetting()
    {
        Gate::define('setting-list','App\Policies\SettingPolicy@view');
        Gate::define('setting-add','App\Policies\SettingPolicy@create');
        Gate::define('setting-edit','App\Policies\SettingPolicy@update');
        Gate::define('setting-delete','App\Policies\SettingPolicy@delete');
    }
    public function defineSlider()
    {
        Gate::define('slider-list','App\Policies\SliderPolicy@view');
        Gate::define('slider-add','App\Policies\SliderPolicy@create');
        Gate::define('slider-edit','App\Policies\SliderPolicy@update');
        Gate::define('slider-delete','App\Policies\SliderPolicy@delete');
    }
    public function defineProduct()
    {
        Gate::define('product-list','App\Policies\ProductPolicy@view');
        Gate::define('product-add','App\Policies\ProductPolicy@create');
        Gate::define('product-edit','App\Policies\ProductPolicy@update');
        Gate::define('product-delete','App\Policies\ProductPolicy@delete');
    }
    public function defineUser()
    {
        Gate::define('user-list','App\Policies\UserPolicy@view');
        Gate::define('user-add','App\Policies\UserPolicy@create');
        Gate::define('user-edit','App\Policies\UserPolicy@update');
        Gate::define('user-delete','App\Policies\UserPolicy@delete');
    }
    public function defineOrder()
    {
        Gate::define('order-list','App\Policies\OrderPolicy@view');
        Gate::define('order-viewDetail','App\Policies\OrderPolicy@viewDetail');
        Gate::define('order-actionOrder','App\Policies\OrderPolicy@update');
        Gate::define('order-delete','App\Policies\OrderPolicy@delete');
    }

}
