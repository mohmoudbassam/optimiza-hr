<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'user'=>auth()->user()?[
                'id'=>auth()->user()->id,
                'name'=>auth()->user()->name,
                'email'=>auth()->user()->email,
                'email_verified_at'=>auth()->user()->email_verified_at,
                'created_at'=>auth()->user()->created_at,
                'updated_at'=>auth()->user()->updated_at,
                'is_admin'=>auth()->user()->is_admin,
                'monthly_working_hours'=>auth()->user()->monthly_working_hours,
                'salary'=>auth()->user()->salary,
            ]:null,
            'flash'=>[
                'error_message'=>function () use ($request) {
                    return $request->session()->get('error_message');
                },
                'success_message'=>function () use ($request) {
                    return $request->session()->get('success_message');
                },
            ],
        ]);
    }
}
