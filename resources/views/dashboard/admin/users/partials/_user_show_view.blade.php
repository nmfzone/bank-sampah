<div class="detail-user">
    <div class="form-group">
        <label class="col-md-4 control-label">Username</label>

        <div class="col-md-6">
            <input type="text" class="form-control" disabled value="{{ $user->username }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">No Identitas</label>

        <div class="col-md-6">
            <input type="text" class="form-control" disabled value="{{ $user->id_card_number }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Nama</label>

        <div class="col-md-6">
            <input type="text" class="form-control" disabled value="{{ $user->name }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">E-Mail</label>

        <div class="col-md-6">
            <input type="email" class="form-control" disabled value="{{ $user->email }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Alamat</label>

        <div class="col-md-6">
            <textarea class="form-control" disabled rows="3">{{ $user->address }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">No. Telp</label>

        <div class="col-md-6">
            <input type="text" class="form-control" disabled value="{{ $user->phone }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Tanggal Bergabung</label>

        <div class="col-md-6">
            <input type="text" class="form-control" disabled value="{{ $user->created_at }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Status</label>

        <div class="col-md-6">
            <select class="form-control" disabled>
                @foreach($statuses as $k => $status)
                    <option value="{{ $k }}" {{ $k==$user->status ? 'selected':'' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <h3>Riwayat Transaksi</h3>
            @if (!$savings->isEmpty())
                <div class="col-md-6 col-xs-6 pull-left">
                    <h5>5 riwayat transaksi terakhir</h5>
                </div>
                <div class="col-md-6 col-xs-6">
                    <a href="{!! route('dashboard.protected.transactions.index') !!}?name={{ $user->username }}" class="btn btn-primary pull-right">Lihat Selengkapnya</a>
                </div>
                <br /><br />
                <table class="table table-striped the-tables">
                    <tr>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                        <th>Tanggal</th>
                    </tr>
                    @foreach($savings as $saving)
                        <tr>
                            <td>{{ $saving->category()->first() != null ? $saving->category()->first()->name : '-' }}</td>
                            <td>{{ $saving->type()->first() != null ? $saving->type()->first()->name : '-' }}</td>
                            <td>{{ $saving->items_amount != null ? $saving->items_amount : '-' }}</td>
                            <td>Rp {{ $saving->debit }},00</td>
                            <td>Rp {{ $saving->credit }},00</td>
                            <td>Rp {{ $saving->balance }},00</td>
                            <td>{{ $saving->created_at }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                {{ $user->name }} belum mempunyai riwayat transaksi.
            @endif
        </div>
    </div>

    <div class="form-group submit-area">
        <div class="col-md-6 col-md-offset-4">
            <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
            <a href="{{ url('/dashboard/protected/users/' . $user->id . '/edit') }}" class="btn btn-primary"><i class="fa fa-btn fa-user"></i> Edit</a>
        </div>
    </div>
</div>
