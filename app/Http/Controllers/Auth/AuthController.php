<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use Message;
use App\User;
use App\Category;
use Validator;
use App\Jobs\SendVerificationEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\Auth\UserRegistrationRequest;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
     */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Use username field instead of email
     */
    protected $username = 'username';

    /**
     * The loader implementation.
     *
     * @var \App\Services\MessagesTranslator
     */
    protected $message;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->message = $message->setBase('messages.ctrl.auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'name' => 'required|max:255',
            'email' => 'email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Change laravel default login form location.
     */
    public function getLogin()
    {
        $options = [
            'title' => "Login Area"
        ];

        return view('auth.login')->with($options);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        $user = User::where('username', $credentials['username'])
            ->first();

        /*
         * if ($user != null) {
         *     if (password_verify($credentials['password'], $user->password) && $user->status == 0) {
         *         return redirect($this->loginPath())
         *             ->withInput($request->only($this->loginUsername(), 'remember'))
         *             ->withErrors([
         *                 $this->loginUsername() => "Email anda belum di konfirmasi. Silahkan klik tautan yang dikirimkan ke email anda.",
         *             ]);
         *     }
         * }
         */

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    public function getRegistration()
    {
        return redirect()->back(); // Registration Deactivated
        //$pageTitle = "Registration Area";

        //return view('auth.register', compact('pageTitle'));
    }

    public function postRegistration(UserRegistrationRequest $request, User $user)
    {
        $code = str_random(30);

        $newUser = $user->newInstance($request->except(['g-recaptcha-response', 'accept_terms']));
        $newUser->role_id = 2;
        $newUser->activation_key = $code;
        $newUser->save();

        /*
         * $link = url("/auth/emails/verify/" . $code);
         * $this->dispatch(new SendVerificationEmail($newUser, $link));
         */

        $credentials = [
            'username'  => $request->get('username'),
            'password'  => $request->get('password')
        ];

        alert()->success($this->message->shout('registration.success'))->persistent("Close");

        if (Auth::attempt($credentials)) {
            return redirect($this->redirectPath());
        }

        return redirect('auth/login');
    }

    public function verifyEmailActivationCode(User $user, $activation_key)
    {
        $the_user = $user->whereActivationKey($activation_key)->first();

        if (! $the_user)
        {
            alert()->error($this->message->shout('email_verify.error'))->persistent("Close");
        } else {
            $the_user->status = 1;
            $the_user->activation_key = null;
            $the_user->save();

            alert()->success($this->message->shout('email_verify.success'))->persistent("Close");
        }

        return redirect()->route('auth.login');
    }

    public function redirectPath()
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return 'dashboard/protected';
        } else if ($user->hasRole('user')) {
            return 'dashboard';
        }

        return $this->redirectTo;
    }

}
