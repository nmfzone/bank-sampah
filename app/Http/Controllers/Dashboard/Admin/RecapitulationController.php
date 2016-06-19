<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Message;
use Datatables;
use Carbon\Carbon;

use App\User;
use App\Saving;

class RecapitulationController extends Controller
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
        $this->message = $message->setBase('messages.ctrl.recapitulation');
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = $this->message->shout('index.title');

        return view('dashboard.admin.recapitulation.index', compact('pageTitle'));
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
     * Get recapitulation by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRecapitulation()
    {
        return Datatables::of(User::whereNotIn('id', [1,2])->orderBy('name'))
            ->addColumn('balance_total', function ($user) {
                return $user->balance() == null ? 0 : $user->balance();
            })
            ->addColumn('items_amount_total', function ($user) {
                return $user->itemsAmountTotal();
            })
            ->make(true);
    }

}
