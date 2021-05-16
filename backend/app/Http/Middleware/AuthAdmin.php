<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     * 管理画面ログイン時、Roleが管理者でない場合はリダイレクトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #ユーザーがログインしていない場合は、ログイン画面へリダイレクト
        if (!\Auth::check()) {
            return redirect()->route('admin_login');
        }

        //ユーザーの権限チェック
        if (\Auth::user()->role->role_name === '管理者') {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
