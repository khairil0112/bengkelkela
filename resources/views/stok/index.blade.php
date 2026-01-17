@extends('layouts.app')

@section('content')

<h3 class="mb-4"><b>Kartu Stok</b></h3>

<div class="card">
    <div class="card-body">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Part</th>
                    <th>Nama Part</th>
                    <th>Sisa Stok</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($stok as $i => $s)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $s->kode }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->sisa_stok ?? 0 }}</td>
                    <td>
                        <form action="{{ route('stok.kartu') }}" method="POST">
                            @csrf
                            <input type="hidden" name="partdanjasa_id" value="{{ $s->id }}">
                            <button class="btn btn-primary btn-sm">
                                👁 Detail
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
