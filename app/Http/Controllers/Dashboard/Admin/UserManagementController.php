<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Message;
use Datatables;
use UserMan;
use Carbon\Carbon;
use App\DataTables\UsersDataTable;

use App\User;
use App\Role;
use App\Saving;

use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;

use App\Awesome\Contracts\Controllers\Dashboard\Admin\UserManagementContract;

class UserManagementController extends Controller implements UserManagementContract
{
    /**
     * The loader implementation.
     *
     * @var \App\Services\MessagesTranslator
     */
    protected $message;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message->setBase('messages.ctrl.userMan');
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = $this->message->shout('index.title');

        return view('dashboard.admin.users.index', compact('pageTitle'));
    }

    /**
     * Get all users by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers()
    {
        return Datatables::of(User::where('status', 0))
            ->addColumn('action', function ($user) {
                $action = '<a href="'. url("dashboard/protected/users/" . $user->id . "/edit") .'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $action .= '<a href="'. url("dashboard/protected/users/" . $user->id) .'" class="btn btn-xs btn-success show-this"><i class="glyphicon glyphicon-zoom-in"></i> Lihat</a>';
                $action .= '<a href="'. url("dashboard/protected/users/" . $user->id) .'" class="btn btn-xs btn-primary delete-this"><i class="glyphicon glyphicon-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Get users by ajax request based on username and/or name.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function autocomplete(Request $request, User $user)
    {
        $term = $request->term;
        $results = [];

        if (null != $term) {
            $queries = $user->whereNotIn('id', [1, 2])
                ->where(function ($query) use ($term) {
                    $query->where('username', 'LIKE', '%'.$term.'%')
                        ->orWhere('name', 'LIKE', '%'.$term.'%');
                })
                ->take(5)->get();
        } else {
            $queries = $user->whereNotIn('id', [1, 2])->take(5)->get();
        }

        foreach ($queries as $query) {
            $balance = $user->find($query->id)->balance();
            $results[] = [ 'id' => $query->id, 'value' => $query->name, 'balance' => $balance ];
        }

        return response()->json($results);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = $this->message->shout('create.title');
        $setting = false;
        $edit = false;

        return view('dashboard.admin.users.create', compact('pageTitle', 'setting', 'edit'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  App\Http\Requests\Users\CreateUserRequest  $request
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request, User $user, Role $role)
    {
        $userRole = $role->whereName('User')->first()->id;

        $user = $user->newInstance($request->all());
        if ("" == $request->created_at) {
            unset($user['created_at']);
        } else {
            $user->created_at = Carbon::createFromFormat('d-m-Y', $request->created_at)->toDateTimeString();
        }
        $user->role_id = $userRole;
        $user->save();

        alert()->success($this->message->shout('store.success'))->persistent("Close");

        return redirect('dashboard/protected/users');
    }

    /**
     * Display the specified user.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $pageTitle = $user->name;
        $savings = $user->savings()->orderBy('created_at', 'DESC')->take(5)->get();
        $statuses = $user->getStatuses();

        return view('dashboard.admin.users.show', compact('pageTitle', 'user', 'savings', 'statuses'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $setting = false, $pageTitle = "Edit User")
    {
        if (!$setting && $user->id == 1) {
            return abort(404);
        }
        $edit = true;
        $statuses = $user->getStatuses();

        return view('dashboard.admin.users.edit', compact('setting', 'user', 'pageTitle', 'statuses', 'edit'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  App\Http\Requests\Users\UpdateUserRequest  $request
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();

        if ($request->setting != 1) {
            if ($data['created_at'] != $user->created_at) {
                $data['created_at'] = Carbon::createFromFormat('d-m-Y', $data['created_at'])->toDateTimeString();
            } else {
                $data['created_at'] = Carbon::createFromFormat('d F Y H:i:s', $data['created_at'])->toDateTimeString();
            }
        }
        $user->update($data);

        if ($request->setting == 1) {
            alert()->success($this->message->shout('update.success.a'))->persistent("Close");
            return redirect()->back();
        }

        alert()->success($this->message->shout('update.success.b'))->persistent("Close");

        return redirect()->back();
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // SuperAdmin can't destroy themself
        if ($user->id == 1) {
            return abort(404);
        }

        $user->delete();

        alert()->success($this->message->shout('destroy.success'))->persistent("Close");

        return redirect()->back();
    }

    /**
     * Show the form for editing the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        $user = auth()->user();
        $pageTitle = ucfirst($user->username) . " Account";

        return $this->edit($user, true, $pageTitle);
    }

}
