<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Datatables;
use App\Http\Controllers\Controller;
use App\Awesome\Contracts\Controllers\Admin\SavingContract;

use App\Saving;
use App\Category;
use App\Type;
use App\User;

use App\Http\Requests\Savings\CreateSavingRequest;
use App\Http\Requests\Savings\UpdateSavingRequest;
use App\Http\Requests\Savings\CreateCreditRequest;

class SavingController extends Controller implements SavingContract
{
    /**
     * Display a listing of the saving.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Daftar Seluruh Transaksi";

        return view('dashboard.admin.savings.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new saving.
     *
     * @param  App\Category  $category
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category, Type $type)
    {
        $pageTitle = "Tambah Transaksi";
        $categories = $category->all();
        $types = $type->all();

        return view('dashboard.admin.savings.create', compact('pageTitle', 'categories', 'types'));
    }

    /**
     * Store a newly created saving in storage.
     *
     * @param  App\Http\Requests\Savings\CreateSavingRequest  $request
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSavingRequest $request, Saving $saving)
    {
        $this->processingSavingLifeCycle($request, 'create');
        alert()->success('Transaksi baru berhasil ditambahkan.')->persistent("Close");

        return redirect('/dashboard/protected/transactions');
    }

    /**
     * Display the specified saving.
     *
     * @param  int  $id
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function show($id, Saving $saving)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified saving.
     *
     * @param  int  $id
     * @param  App\Saving  $saving
     * @param  App\Category  $category
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Saving $saving, Category $category, Type $type)
    {
        $pageTitle = "Edit Transaksi";
        $saving = $saving->findOrFail($id);
        $categories = $category->all();
        $types = $type->all();

        if ('out' == $saving->type) {
            return view('dashboard.admin.savings.credits.edit', compact('pageTitle', 'saving'));
        }

        return view('dashboard.admin.savings.edit', compact('pageTitle', 'saving', 'categories', 'types'));
    }

    /**
     * Update the specified saving in storage.
     *
     * @param  App\Http\Requests\Savings\UpdateSavingRequest $request
     * @param  int  $id
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSavingRequest $request, $id, Saving $saving)
    {
        $saving = $saving->findOrFail($id);
        $saving->update($request->all());
        alert()->success('Detail transaksi berhasil diperbaharui.')->persistent("Close");

        return redirect('/dashboard/protected/transactions');
    }

    /**
     * Remove the specified saving from storage.
     *
     * @param  int  $id
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Saving $saving)
    {
        $saving = $saving->findOrFail($id);
        $saving->delete();
        alert()->success('Transaksi berhasil di hapus.')->persistent("Close");

        return redirect('/dashboard/protected/transactions');
    }

    /**
     * Show the form for creating a new credit transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function credit()
    {
        $pageTitle = "Tambah Transaksi Kredit";

        return view('dashboard.admin.savings.credits.create', compact('pageTitle'));
    }

    /**
     * Store a newly created credit transaction in storage.
     *
     * @param  App\Http\Requests\Savings\CreateCreditRequest $request
     * @return \Illuminate\Http\Response
     */
    public function createCredit(CreateCreditRequest $request)
    {
        $process = $this->processingSavingLifeCycle($request, 'createCredit');

        if (false == $process) {
            alert()->error('Transaksi kredit tidak dapat dilakukan, saldo akan negatif.')->persistent("Close");

            return redirect()->back();
        }

        alert()->success('Transaksi kredit baru berhasil ditambahkan.')->persistent("Close");

        return redirect('/dashboard/protected/transactions');
    }

    /**
     * Handle the transaction life cycle process.
     *
     * @param  string  $request
     * @param  string  $action
     * @return \Illuminate\Http\Response
     */
    public function processingSavingLifeCycle($request, $action)
    {
        $balance = User::find($request->user_id)->balance();

        $otherData = [];
        if ('in' == $request->type) {
            $price = Category::find($request->type_id)->first()->price;
            $otherData['debit'] = $price * $request->items_amount;
            $otherData['balance'] = $balance + $otherData['debit'];
        } else if ('out' == $request->type) {
            $otherData['balance'] = $balance - $request->credit;
            if ($otherData['balance'] < 0) {
                return false;
            }
        }
        $data = array_merge($request->all(), $otherData);

        if ('create' == $action || 'createCredit' == $action) {
            Saving::create($data);
            return true;
        }

        Saving::update($data);

        return true;
    }

    /**
     * Get all savings by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSavings()
    {
        return Datatables::of(Saving::where('status', 0)->orderBy('created_at', 'DESC')->with('user')->with('category')->with('type'))
            ->addColumn('action', function ($saving) {
                $action = '<a href="'. url("dashboard/protected/transactions/" . $saving->id . "/edit") .'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $action .= '<a href="'. url("dashboard/protected/transactions/" . $saving->id) .'" class="btn btn-xs btn-primary delete-this"><i class="glyphicon glyphicon-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
