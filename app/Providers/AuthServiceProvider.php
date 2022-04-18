<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\SchoolProfile;
use App\Models\Slide;
use App\Policies\ArticlePolicy;
use App\Policies\SchoolProfilePolicy;
use App\Policies\SlidePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Major::class => MajorPolicy::class,
        SchoolProfile::class => SchoolProfilePolicy::class,
        Slide::class => SlidePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
