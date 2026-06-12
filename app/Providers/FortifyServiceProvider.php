<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // ログインフォームのビュー指定
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ユーザー登録フォームのビュー指定
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログイン時の入力チェックと認証処理
        Fortify::authenticateUsing(function (Request $request) {
            // ログインフォームの入力内容を検証
            $request->validate([
                'email' => 'email',
            ], [
                'email.email' => 'メールアドレスはメール形式で入力してください',
            ]);

            // 入力されたメールアドレスに一致するユーザーを取得
            $user = User::where('email', $request->email)->first();

            // ユーザーが存在し、パスワードが一致した場合は認証成功
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            // メールアドレスまたはパスワードが一致しない場合
            throw ValidationException::withMessages([
                'email' => ['ログイン情報が登録されていません'],
            ]);
        });
    }
}
