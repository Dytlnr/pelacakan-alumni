<!DOCTYPE html>
<html>
<head>
    <title>Profil Pencarian Alumni</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f5f5f5; }
        .box { background: white; padding: 20px; border-radius: 8px; }
        .btn { display:inline-block; padding:10px 14px; background:#2563eb; color:white; text-decoration:none; border:none; border-radius:6px; cursor:pointer; margin-top:10px; }
        ul { margin-top: 5px; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Profil Pencarian Alumni</h1>
        <p><b>Nama:</b> {{ $alumni->nama }}</p>
        <p><b>Prodi:</b> {{ $alumni->prodi }}</p>

        @if(session('success'))
            <p style="color:green">{{ session('success') }}</p>
        @endif

        <form action="{{ route('profil.generate', $alumni->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn">Generate Profil Pencarian</button>
        </form>

        @if($profil)
            <hr>
            <h3>Variasi Nama</h3>
            <ul>
                @foreach($profil->variasi_nama as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>

            <h3>Keyword Afiliasi</h3>
            <ul>
                @foreach($profil->keyword_afiliasi as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>

            <h3>Keyword Konteks</h3>
            <ul>
                @foreach($profil->keyword_konteks as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>

            <a href="{{ route('pelacakan.index', $alumni->id) }}" class="btn">Lanjut ke Pelacakan</a>
        @endif
    </div>
</body>
</html>
