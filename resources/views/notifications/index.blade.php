@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Kirim Notifikasi</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('notifications.send') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pesan</label>
                    <textarea name="body" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Device Token</label>
                    <input type="password" name="device_token" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Kirim</button>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <h4>Riwayat Notifikasi</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pesan</th>
                    {{-- <th>Token</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($notifications as $notification)
                    <tr>
                        <td>{{ $notification->title }}</td>
                        <td>{{ $notification->body }}</td>
                        {{-- <td>{{ $notification->device_token }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
