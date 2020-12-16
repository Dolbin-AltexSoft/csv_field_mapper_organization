<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'errors' => (function () use ($request) {
                return $request->session()->get('errors') ? $request->session()->get('errors')->getBag('default')->getMessages() : (object) [];
            })
        ]);
    }
}
