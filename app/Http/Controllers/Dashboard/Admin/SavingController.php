<?php

namespace App\Http\Controllers\Dashboard\Admin;

use DB;
use Datatables;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Awesome\Contracts\Controllers\Dashboard\Admin\SavingContract;

use App\Saving;
use App\SavingTemp;
use App\Category;
use App\Type;
use App\User;

use App\Http\Requests\Savings\CreateSavingTempRequest;
use App\Http\Requests\Savings\UpdateSavingTempRequest;
use App\Http\Requests\Savings\CreateCreditRequest;
use App\Http\Requests\Savings\SynchronizeSpecificUserRequest;
use App\Http\Requests\Savings\SynchronizeAllUserRequest;
use App\Http\Requests\Savings\UnsynchronizeSpecificUserRequest;
use App\Http\Requests\Savings\UnsynchronizeAllUserRequest;

class SavingController extends Controller implements SavingContract
{
    /**
     * Display a listing of the saving_temp.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Daftar Seluruh Transaksi Sementara";

        return view('dashboard.admin.savings.index', compact('pageTitle'));
    }

    /**
     * Display a listing of the savings.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSavings(Request $request, User $user)
    {
        $usr = null;
        if ($request->name != null) {
            $usr = $user->where('username', $request->name)->first();
            if ($usr == null) {
                return abort(404);
            }
        }

        $pageTitle = "Daftar Seluruh Transaksi";
        if ($usr != null) {
            $pageTitle = "Daftar Transaksi oleh '{$usr->username}'";
        }

        return view('dashboard.admin.savings.indexSaving', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new saving_temp.
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
     * Store a newly created saving_temp in storage.
     *
     * @param  App\Http\Requests\Savings\CreateSavingTempRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSavingTempRequest $request)
    {
        $this->processingSavingLifeCycle($request, 'create');
        alert()->success('Transaksi baru berhasil ditambahkan.')->persistent("Close");

        return redirect('/dashboard/protected/transactions/temporaries');
    }

    /**
     * Display the specified saving_temp.
     *
     * @param  int  $id
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function show($id, SavingTemp $savingTemp)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified saving_temp.
     *
     * @param  int  $id
     * @param  App\SavingTemp  $savingTemp
     * @param  App\Category  $category
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id, SavingTemp $savingTemp, Category $category, Type $type)
    {
        $pageTitle = "Edit Transaksi";
        $savingTemp = $savingTemp->findOrFail($id);
        $categories = $category->all();
        $types = $type->all();

        if ('out' == $savingTemp->type) {
            return view('dashboard.admin.savings.credits.edit', compact('pageTitle', 'savingTemp'));
        }

        return view('dashboard.admin.savings.edit', compact('pageTitle', 'savingTemp', 'categories', 'types'));
    }

    /**
     * Update the specified saving_temp in storage.
     *
     * @param  App\Http\Requests\Savings\UpdateSavingTempRequest $request
     * @param  int  $id
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSavingTempRequest $request, $id, SavingTemp $savingTemp)
    {
        $savingTemp = $savingTemp->findOrFail($id);

        $this->processingSavingLifeCycle($request, "update", $savingTemp);

        alert()->success('Detail transaksi berhasil diperbaharui.')->persistent("Close");

        return redirect('/dashboard/protected/transactions/temporaries');
    }

    /**
     * Remove the specified saving from storage.
     *
     * @param  int  $id
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, SavingTemp $savingTemp)
    {
        $savingTemp = $savingTemp->findOrFail($id);
        $savingTemp->delete();
        alert()->success('Transaksi berhasil di hapus.')->persistent("Close");

        return redirect('/dashboard/protected/transactions/temporaries');
    }

    /**
     * Remove the specified saving from storage.
     *
     * @param  int  $id
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroySavings($id, Saving $saving)
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
     * @param  App\SavingTemp  $savingTemp
     * @param  App\Saving  $saving
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function createCredit(CreateCreditRequest $request, SavingTemp $savingTemp,
        Saving $saving, User $user)
    {
        $savingTemp = $savingTemp->where('user_id', $request->user_id)
            ->first();
        $saving = $saving->where('user_id', $request->user_id)->where('type', 'in')
            ->first();
        $balance = $user->find($request->user_id)->balance($request->created_at);
        $date = (new Carbon($request->created_at))->format("d F Y H:i:s");

        if ($savingTemp !== null) {
            alert()->error('Transaksi kredit tidak dapat dilakukan sebelum keseluruhan ' .
                'transaksi nasabah ini tersinkronisasi.')
                ->persistent("Close");

            return redirect()->back();
        }

        if ($saving === null) {
            alert()->error('Transaksi kredit tidak dapat dilakukan, nasabah belum mempunyai riwayat tabungan')
                ->persistent("Close");

            return redirect()->back();
        }

        if ($balance === null) {
            alert()->error('Transaksi kredit tidak dapat dilakukan, nasabah tidak mempunyai riwayat tabungan ' .
                'sebelum tanggal ' . $date)
                ->persistent("Close");

            return redirect()->back();
        }

        $process = $this->processingSavingLifeCycle($request, 'createCredit');

        if (!$process) {
            alert()->error('Kredit yang dimasukkan terlalu besar, saldo akan negatif.')->persistent("Close");

            return redirect()->back();
        }

        alert()->success('Transaksi kredit baru berhasil ditambahkan.')->persistent("Close");

        return redirect('/dashboard/protected/transactions/temporaries');
    }

    /**
     * Synchronize transaction for specific user.
     *
     * @param  App\Http\Requests\Savings\SynchronizeSpecificUserRequest $request
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function synchronizeSpecificUser(SynchronizeSpecificUserRequest $request,
        SavingTemp $savingTemp)
    {
        $savingsTemp = $savingTemp->where('user_id', $request->user_id)->orderBy('created_at')->get();

        if ($savingsTemp->isEmpty()) {
            alert()->error('Tidak ada transaksi nasabah ini yang belum disinkronisasi.')->persistent("Close");

            return redirect()->back();
        }

        foreach ($savingsTemp as $trans) {
            $id = $trans->id;
            unset($trans['id']);
            if ($this->processingSavingLifeCycle($trans, 'sync')) {
                $savingTemp->find($id)->delete();
            } else {
                alert()->error('Sinkronisasi gagal, transaksi dengan id=' . $id .  ' akan menyebabkan saldo negatif.')->persistent("Close");
                return redirect()->back();
            }
        }

        if ($savingTemp->first() === null) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('savings_temp')->truncate();
        }

        alert()->success('Transaksi nasabah berhasil di sinkronisasi.')->persistent("Close");

        return redirect()->back();
    }

    /**
     * Synchronize transaction for all user.
     *
     * @param  App\Http\Requests\Savings\SynchronizeAllUserRequest $request
     * @param  App\User  $user
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function synchronizeAllUser(SynchronizeAllUserRequest $request, User $user, SavingTemp $savingTemp)
    {
        $savingsTemp = $savingTemp->all()->sortBy('created_at');

        if ($savingsTemp->isEmpty()) {
            alert()->error('Tidak ada transaksi yang belum disinkronisasi.')->persistent("Close");

            return redirect()->back();
        }

        foreach ($savingsTemp as $trans) {
            $id = $trans->id;
            unset($trans['id']);
            if ($this->processingSavingLifeCycle($trans, 'sync')) {
                $savingTemp->find($id)->delete();
            } else {
                alert()->error('Sinkronisasi gagal, transaksi dengan id=' . $id .  ' akan menyebabkan saldo negatif.')->persistent("Close");
                return redirect()->back();
            }
        }

        if ($savingTemp->first() === null) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('savings_temp')->truncate();
        }

        alert()->success('Transaksi seluruh nasabah berhasil di sinkronisasi.')->persistent("Close");

        return redirect()->back();
    }

    /**
     * Unsynchronize transaction for specific user.
     *
     * @param  App\Http\Requests\Savings\UnsynchronizeSpecificUserRequest $request
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function unsynchronizeSpecificUser(UnsynchronizeSpecificUserRequest $request,
        Saving $saving)
    {
        $savings = $saving->where('user_id', $request->user_id)->get();

        if ($savings->isEmpty()) {
            alert()->error('Tidak ada transaksi nasabah ini yang belum diunsinkronisasi.')->persistent("Close");

            return redirect()->back();
        }

        foreach ($savings as $trans) {
            $id = $trans->id;
            unset($trans['id'], $trans['balance']);
            if ($this->processingSavingLifeCycle($trans, 'unsync')) {
                $saving->find($id)->delete();
            }
        }

        if ($saving->first() === null) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('savings')->truncate();
        }

        alert()->success('Transaksi nasabah berhasil di unsinkronisasi.')->persistent("Close");

        return redirect()->back();
    }

    /**
     * Unsynchronize transaction for all user.
     *
     * @param  App\Http\Requests\Savings\UnsynchronizeAllUserRequest $request
     * @param  App\User  $user
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function unsynchronizeAllUser(UnsynchronizeAllUserRequest $request, User $user, Saving $saving)
    {
        $savings = $saving->all();

        if ($savings->isEmpty()) {
            alert()->error('Tidak ada transaksi yang belum di unsinkronisasi.')->persistent("Close");

            return redirect()->back();
        }

        foreach ($savings as $trans) {
            $id = $trans->id;
            unset($trans['id'], $trans['balance']);
            if ($this->processingSavingLifeCycle($trans, 'unsync')) {
                $saving->find($id)->delete();
            }
        }

        if ($saving->first() === null) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('savings')->truncate();
        }

        alert()->success('Transaksi seluruh nasabah berhasil di unsinkronisasi.')->persistent("Close");

        return redirect()->back();
    }

    /**
     * Handle the transaction life cycle process.
     *
     * @param  mixed  $data
     * @param  string  $action
     * @param  mixed  $model
     * @return \Illuminate\Http\Response
     */
    public function processingSavingLifeCycle($data, $action, $model = null)
    {
        if ("unsync" !== $action) {
            $dataDpl = $data;
            $balance = 0;
            if ('sync' === $action) {
                $dataDpl = $this->toObject($data->toArray());
            }

            $balance = User::find($dataDpl->user_id)->balance($data['created_at']);

            $otherData = [];
            if ('in' === $dataDpl->type) {
                $price = Category::find($dataDpl->category_id)->price;

                $otherData['debit'] = $price * $dataDpl->items_amount;
                if ('sync' === $action) {
                    $otherData['balance'] = $balance + $otherData['debit'];
                }
            } else if ('out' === $dataDpl->type && "update" != $action) {
                $otherData['balance'] = $balance - $dataDpl->credit;
                if ($otherData['balance'] < 0) {
                    return false;
                }
            }

            if ('sync' !== $action) {
                $data = array_merge($data->all(), $otherData);

                if ("update" === $action) {
                    if ($data['created_at'] != $model->created_at) {
                        $data['created_at'] = Carbon::createFromFormat('d-m-Y', $data['created_at'])->toDateTimeString();
                    } else {
                        $data['created_at'] = Carbon::createFromFormat('d F Y H:i:s', $data['created_at'])->toDateTimeString();
                    }

                    $model->update($data);
                } else {
                    if ("" === $data['created_at']) {
                        unset($data['created_at']);
                    } else {
                        $data['created_at'] = Carbon::createFromFormat('d-m-Y', $data['created_at'])->toDateTimeString();
                    }

                    SavingTemp::create($data);
                }

                return true;
            }

            $data = array_merge($data->toArray(), $otherData);
            $data['created_at'] = Carbon::createFromFormat('d F Y H:i:s', $data['created_at'])->toDateTimeString();
            $data['updated_at'] = Carbon::createFromFormat('d F Y H:i:s', $data['updated_at'])->toDateTimeString();

            Saving::insert($data);
        } else if ("unsync" === $action) {
            $data = $data->toArray();
            $data['created_at'] = Carbon::createFromFormat('d F Y H:i:s', $data['created_at'])->toDateTimeString();
            $data['updated_at'] = Carbon::createFromFormat('d F Y H:i:s', $data['updated_at'])->toDateTimeString();

            SavingTemp::insert($data);
        }

        return true;
    }

    /**
     * Get all savings by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSavings(Request $request, User $user)
    {
        if ($request->name != null) {
            $user = $user->where('username', $request->name)->first();
            $id = ($user === null) ? -1 : $user->id;
            return Datatables::of(Saving::where('user_id', $id)->orderBy('created_at', 'DESC')
                ->with('user')
                ->with('category')
                ->with('type'))
                ->make(true);
        }

        return Datatables::of(Saving::orderBy('created_at', 'DESC')->with('user')->with('category')->with('type'))
            ->make(true);
    }

    /**
     * Get all savings_temp by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSavingsTemp()
    {
        return Datatables::of(SavingTemp::orderBy('created_at', 'DESC')->with('user')->with('category')->with('type'))
            ->addColumn('action', function ($savingTemp) {
                $action = '<a href="'. url("dashboard/protected/transactions/temporaries/" . $savingTemp->id . "/edit") .'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $action .= '<a href="'. url("dashboard/protected/transactions/temporaries/" . $savingTemp->id) .'" class="btn btn-xs btn-primary delete-this"><i class="glyphicon glyphicon-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
