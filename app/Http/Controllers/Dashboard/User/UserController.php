<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Awesome\Contracts\Controllers\Dashboard\User\UserContract;
use Message;

use App\User;
use App\Category;
use App\Type;
use App\Saving;

use App\Http\Requests\Users\UpdateUserRequest;

class UserController extends Controller implements UserContract
{

    /**
     * The loader implementation.
     *
     * @var \App\Services\MessagesTranslator
     */
    protected $message;

    /**
     * The authenticated user.
     */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message->setBase('messages.ctrl.user');
        $this->user = auth()->user();
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $pageTitle = $this->message->shout('index.title');
        $user = $this->user;

        return view(
            'dashboard.user.users.index',
            compact('pageTitle',
                    'user',
                    'category'
            )
        );
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created user in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return abort(404);
    }

    /**
     * Display the specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  string  $user
     * @param  bool  $setting
     * @param  string  $pageTitle
     * @return \Illuminate\Http\Response
     */
    public function edit($user, $setting = false, $pageTitle)
    {
        if ($setting) {
            return view('dashboard.user.users.edit', compact('setting', 'pageTitle', 'user'));
        }

        return abort(404);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @param  App\Http\Requests\Users\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->user->update($request->all());

        alert()->success($this->message->shout('update.success'))->persistent("Close");

        return redirect('dashboard/users/settings');
    }

    /**
     * Remove the specified user from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        return abort(404);
    }

    /**
     * Show the form for editing the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        $pageTitle = ucfirst($this->user->username) . " Account";

        return $this->edit($this->user, true, $pageTitle);
    }

}
