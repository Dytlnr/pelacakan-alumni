<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Alumni</title>
    <style>
        :root {
            --bg: #fdf7f8;
            --card-bg: #ffffff;
            --text: #1f1f1f;
            --muted: #6f6f6f;
            --primary: #89051f;
            --primary-dark: #6e0419;
            --line: #eed9de;
            --input-bg: #fcf6f7;
            --input-border: #edd6dc;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .page {
            max-width: 920px;
            margin: 0 auto;
            padding: 28px 18px 40px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .title {
            margin: 0 0 4px;
            font-size: 30px;
            line-height: 1.15;
            color: var(--primary);
            font-weight: 800;
        }

        .subtitle {
            margin: 0 0 26px;
            color: var(--muted);
            font-size: 13px;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 26px;
        }

        .section-title {
            margin: 0 0 14px;
            color: var(--primary);
            font-size: 22px;
            line-height: 1.1;
            font-weight: 800;
        }

        .subsection-title {
            margin: 10px 0 14px;
            color: var(--primary);
            font-size: 20px;
            line-height: 1.15;
            font-weight: 800;
        }

        .divider {
            border: 0;
            border-top: 1px solid var(--line);
            margin: 18px 0;
        }

        .field {
            margin-bottom: 14px;
        }

        .label {
            display: block;
            margin-bottom: 8px;
            font-size: 18px;
            line-height: 1.05;
            font-weight: 800;
        }

        .grid-two {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .input {
            width: 100%;
            border: 1px solid var(--input-border);
            background: var(--input-bg);
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 14px;
            color: #2a2a2a;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input:focus {
            border-color: #d99baa;
            box-shadow: 0 0 0 4px rgba(137, 5, 31, 0.08);
        }

        .error-box {
            background: #fff0f2;
            color: #8f1029;
            border: 1px solid #f0c6cf;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .actions {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn {
            text-decoration: none;
            border-radius: 16px;
            padding: 12px 24px;
            font-weight: 700;
            font-size: 18px;
            line-height: 1;
            border: 2px solid var(--primary);
            cursor: pointer;
        }

        .btn-cancel {
            color: var(--primary);
            background: #fff;
        }

        .btn-submit {
            color: #fff;
            background: var(--primary);
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        @media (max-width: 768px) {
            .title { font-size: 24px; }
            .subtitle { font-size: 12px; }
            .section-title, .subsection-title { font-size: 18px; }
            .label { font-size: 16px; }
            .btn { font-size: 16px; }
            .grid-two { grid-template-columns: 1fr; gap: 0; }
        }
    </style>
</head>
<body>
    <div class="page">
        <a href="{{ route('alumni.show', $alumni->id) }}" class="back-link">
            <span aria-hidden="true">&larr;</span>
            <span>Kembali</span>
        </a>

        <h1 class="title">Edit Data Alumni</h1>
        <p class="subtitle">Lengkapi data alumni untuk proses pelacakan yang lebih akurat</p>

        <div class="card">
            @if ($errors->any())
                <div class="error-box">
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('alumni.update', $alumni->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h2 class="section-title">Data Dasar</h2>

                <div class="field">
                    <label for="nama" class="label">Nama Lengkap *</label>
                    <input class="input" type="text" name="nama" id="nama" value="{{ old('nama', $alumni->nama) }}" required>
                </div>

                <div class="grid-two">
                    <div class="field">
                        <label for="prodi" class="label">Program Studi *</label>
                        <input class="input" type="text" name="prodi" id="prodi" value="{{ old('prodi', $alumni->prodi) }}" required>
                    </div>
                    <div class="field">
                        <label for="tahun_lulus" class="label">Tahun Lulus *</label>
                        <input class="input" type="text" name="tahun_lulus" id="tahun_lulus" value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}" maxlength="4" required>
                    </div>
                </div>

                <hr class="divider">
                <h3 class="subsection-title">Informasi Kontak</h3>

                <div class="grid-two">
                    <div class="field">
                        <label for="email" class="label">Email</label>
                        <input class="input" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="email@example.com">
                    </div>
                    <div class="field">
                        <label for="telepon" class="label">Telepon</label>
                        <input class="input" type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" placeholder="+62 xxx xxxx xxxx">
                    </div>
                </div>

                <hr class="divider">
                <h3 class="subsection-title">Informasi untuk Pelacakan</h3>

                <div class="field">
                    <label for="afiliasi_terakhir" class="label">Afiliasi Terakhir</label>
                    <input class="input" type="text" name="afiliasi_terakhir" id="afiliasi_terakhir" value="{{ old('afiliasi_terakhir') }}" placeholder="Contoh: Universitas Muhammadiyah Malang">
                </div>

                <div class="field">
                    <label for="bidang" class="label">Bidang Keahlian</label>
                    <input class="input" type="text" name="bidang" id="bidang" value="{{ old('bidang', $alumni->bidang) }}">
                </div>

                <div class="field">
                    <label for="kota" class="label">Lokasi</label>
                    <input class="input" type="text" name="kota" id="kota" value="{{ old('kota', $alumni->kota) }}">
                </div>

                <hr class="divider">
                <div class="actions">
                    <a href="{{ route('alumni.show', $alumni->id) }}" class="btn btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
