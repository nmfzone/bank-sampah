<div class="form-group">
    <label class="col-md-4 control-label">Username</label>

    <div class="col-md-6">
        <input type="text" class="form-control" disabled value="{{ $user->username }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Nama Team</label>

    <div class="col-md-6">
        <input type="text" class="form-control" disabled value="{{ $user->name }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">E-Mail Address</label>

    <div class="col-md-6">
        <input type="email" class="form-control" disabled value="{{ $user->email }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Nama Perguruan Tinggi</label>

    <div class="col-md-6">
        <input type="text" class="form-control" disabled value="{{ $user->institution_name }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Alamat Perguruan Tinggi</label>

    <div class="col-md-6">
        <input type="text" class="form-control" disabled value="{{ $user->institution_address }}">
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="{{ url('/dashboard/users/settings') }}" class="btn btn-primary"><i class="fa fa-btn fa-user"></i> Edit</a>
    </div>
</div>

<div class="container-fluid">
<div class="row">
<h3>List Anggota</h3>
@if (!$members->isEmpty())
<table class="table table-striped the-tables">
    <tr>
        <th>Nim</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Angkatan</th>
        <th>No. Telp</th>
        <th>Posisi</th>
        <th colspan="2" class="text-center">Action</th>
    </tr>
    @foreach($members as $member)
        <tr>
            <td>{{ $member->nim }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->generation }}</td>
            <td>{{ $member->phone }}</td>
            @if ($member->position == "None")
            <td>-</td>
            @else
            <td>{{ $member->position }}</td>
            @endif
            <td class="text-center"><a href="{{ url('/dashboard/members/' . $member->id . '/edit') }}" class="btn btn-warning">Edit</a></td>
            <td class="text-center"><a href="{{ url('/dashboard/members/' . $member->id) }}" class="btn btn-danger delete-this">Delete</a></td>
        </tr>
    @endforeach
</table>
@else
    Belum ada anggota yang ditambahkan
@endif
</div>
</div>

<div class="container-fluid">
<div class="row">
<h3>List Bukti Pembayaran</h3>
@if (!$bukti_pembayaran->isEmpty())
{{--*/ $i = 0 /*--}}
{{--*/ $show_dv = false /*--}}
@foreach($bukti_pembayaran as $bukti)
    @if ($i == 0)
        {{--*/ $show_dv = true /*--}}
        <div class="col-md-12 col-sm-12 col-xs-12">
    @endif
        <div class="col-md-3 col-sm-3 col-xs-3 col-centered list-images">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <a href="#" class="showImage"><img data-note="{{ $bukti->note }}" data-created="{{ $bukti->created_at }}" data-width="{{ $bukti->wMoreH }}" id="imageresource" src="{{ asset($bukti->url) }}" width="100%" /></a>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center the-tables">
                <a href="{{ url('/dashboard/images/' . $bukti->id) }}" class="btn btn-danger delete-this">Hapus</a>
            </div>
        </div>
    @if ($i == 3)
        {{--*/ $show_dv = false /*--}}
        </div>
    @endif

    {{--*/ $i++ /*--}}

    @if ($i == 4)
        {{--*/ $i = 0 /*--}}
    @endif
@endforeach
@if ($show_dv)
</div>
@endif
@else
    Belum ada bukti pembayaran yang ditambahkan
@endif
</div>
</div>

<div class="container-fluid">
<div class="row">
<h3>List Surat Pernyataan</h3>
@if (!$surat_pernyataan->isEmpty())
{{--*/ $i = 0 /*--}}
{{--*/ $show_dv = false /*--}}
@foreach($surat_pernyataan as $surat)
    @if ($i == 0)
        {{--*/ $show_dv = true /*--}}
        <div class="col-md-12 col-sm-12 col-xs-12">
    @endif
        <div class="col-md-3 col-sm-3 col-xs-3 col-centered list-images">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <a href="#" class="showImage"><img data-note="{{ $surat->note }}" data-created="{{ $surat->created_at }}" data-width="{{ $surat->wMoreH }}" id="imageresource" src="{{ asset($surat->url) }}" width="100%" /></a>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center the-tables">
                <a href="{{ url('/dashboard/images/' . $surat->id) }}" class="btn btn-danger delete-this">Hapus</a>
            </div>
        </div>
    @if ($i == 3)
        {{--*/ $show_dv = false /*--}}
        </div>
    @endif

    {{--*/ $i++ /*--}}

    @if ($i == 4)
        {{--*/ $i = 0 /*--}}
    @endif
@endforeach
@if ($show_dv)
</div>
@endif
@else
    Belum ada surat pernyataan yang ditambahkan
@endif
</div>
</div>

@if (UserMan::onlyGrantedCompetitions())
<div class="container-fluid">
<div class="row">
<h3>List Karya</h3>
@if (!$products->isEmpty())
<table class="table table-striped the-tables">
    <tr>
        <th>Kompetisi</th>
        <th>File</th>
        <th class="text-center">Action</th>
    </tr>
    @foreach($products as $product)
        <tr>
            <td>{{ $category->find($product->id)->first()->name }}</td>
            <td><i class="fa fa-download"></i> <a href="{{ url('files/download/karya/' . $product->name) }}" target="_blank">Download</a></td>
            <td class="text-center"><a href="{{ url('/dashboard/competitions/product/' . $product->id) }}" class="btn btn-danger delete-this">Delete</a></td>
        </tr>
    @endforeach
</table>
@else
    Belum ada karya yang ditambahkan
    @endif
</div>
</div>
@endif

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="imagesModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="imagesModal">Image Preview</h4>
      </div>
      <div class="modal-body text-center">
        <img src="" id="imagepreview" width="" data-width=""><br>
        <small id="imagenote"></small><br>
        <small id="imagecreated"></small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
