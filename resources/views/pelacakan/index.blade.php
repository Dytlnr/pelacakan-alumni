<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pelacakan</title>
    <style>
        :root {
            --bg: #fdf7f8;
            --card: #ffffff;
            --line: #eed9de;
            --text: #252525;
            --muted: #6f6f6f;
            --primary: #89051f;
            --high-bg: #e8f6ee;
            --high-line: #9edcbc;
            --high-text: #008444;
            --mid-bg: #fff7e6;
            --mid-line: #efce85;
            --mid-text: #c95d00;
            --low-bg: #f2f4f7;
            --low-text: #374151;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .page {
            max-width: 1260px;
            margin: 0 auto;
            padding: 24px 22px 34px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 18px;
        }

        .title {
            margin: 0 0 6px;
            color: var(--primary);
            font-size: 38px;
            line-height: 1.1;
            font-weight: 800;
        }

        .subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 16px;
        }

        .status-badge {
            border: 1px solid #ef9eaa;
            background: #fff0f2;
            color: #d31530;
            border-radius: 999px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            margin-top: 8px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 18px;
        }

        .stat {
            border: 1px solid var(--line);
            background: #fff;
            border-radius: 12px;
            padding: 14px 16px;
        }

        .stat-title {
            margin: 0 0 10px;
            font-size: 15px;
            font-weight: 600;
        }

        .stat-value {
            margin: 0;
            font-size: 29px;
            line-height: 1;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-high {
            background: var(--high-bg);
            border-color: var(--high-line);
        }
        .stat-high .stat-title, .stat-high .stat-value { color: var(--high-text); }

        .stat-mid {
            background: var(--mid-bg);
            border-color: var(--mid-line);
        }
        .stat-mid .stat-title, .stat-mid .stat-value { color: var(--mid-text); }

        .stat-low {
            background: var(--low-bg);
        }
        .stat-low .stat-title, .stat-low .stat-value { color: var(--low-text); }

        .content {
            border: 1px solid var(--line);
            background: var(--card);
            border-radius: 12px;
            min-height: 190px;
            padding: 26px 20px;
        }

        .empty {
            min-height: 136px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 14px;
            color: var(--muted);
            font-size: 16px;
            text-align: center;
        }

        .btn-back {
            display: inline-block;
            text-decoration: none;
            background: var(--primary);
            color: #fff;
            border-radius: 12px;
            padding: 10px 22px;
            font-size: 15px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            overflow: hidden;
            border-radius: 10px;
        }

        th, td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #f3e7ea;
            font-size: 12px;
        }

        th {
            color: var(--primary);
            background: #fdf1f3;
            font-weight: 700;
        }

        tr:last-child td { border-bottom: 0; }

        .toolbar {
            margin-bottom: 12px;
        }

        .btn-process {
            border: 0;
            border-radius: 10px;
            padding: 9px 14px;
            background: var(--primary);
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            font-size: 12px;
        }

        .alert {
            font-size: 12px;
            border-radius: 10px;
            padding: 9px 12px;
            margin-bottom: 12px;
        }

        .alert.ok { background: #ecfdf3; color: #0e7a3f; border: 1px solid #b5e4c6; }
        .alert.err { background: #fff0f2; color: #8f1029; border: 1px solid #f0c6cf; }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-mini {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border: 1px solid #d8b1ba;
            color: var(--primary);
            background: #fff6f8;
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: 600;
            line-height: 1;
            cursor: pointer;
        }

        .btn-mini.primary {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        @media (max-width: 980px) {
            .title { font-size: 30px; }
            .subtitle { font-size: 15px; }
            .head { flex-direction: column; }
            .stats { grid-template-columns: 1fr 1fr; }
            .content { overflow-x: auto; }
            table { min-width: 780px; }
        }
    </style>
</head>
<body>
    @php
        $total = $hasil->count();
        $high = $hasil->where('skor', '>=', 80)->count();
        $mid = $hasil->where('skor', '>=', 60)->where('skor', '<', 80)->count();
        $low = $hasil->where('skor', '<', 60)->count();
        $status = $alumni->status ?: 'Belum Ditemukan';
    @endphp

    <div class="page">
        <a class="back-link" href="{{ route('alumni.show', $alumni->id) }}">
            <span aria-hidden="true">&larr;</span>
            <span>Kembali ke Detail Alumni</span>
        </a>

        <div class="head">
            <div>
                <h1 class="title">Hasil Pelacakan: {{ $alumni->nama }}</h1>
                <p class="subtitle">Ditemukan {{ $total }} kandidat dari berbagai sumber</p>
            </div>
            <span class="status-badge">{{ $status }}</span>
        </div>

        @if(session('success'))
            <div class="alert ok">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert err">{{ session('error') }}</div>
        @endif

        <div class="stats">
            <div class="stat">
                <p class="stat-title">↗ Total Kandidat</p>
                <p class="stat-value">{{ $total }}</p>
            </div>
            <div class="stat stat-high">
                <p class="stat-title">◉ Skor Tinggi (≥80)</p>
                <p class="stat-value">{{ $high }}</p>
            </div>
            <div class="stat stat-mid">
                <p class="stat-title">◉ Skor Sedang (60-79)</p>
                <p class="stat-value">{{ $mid }}</p>
            </div>
            <div class="stat stat-low">
                <p class="stat-title">◉ Skor Rendah (&lt;60)</p>
                <p class="stat-value">{{ $low }}</p>
            </div>
        </div>

        <section class="content">
            <div class="toolbar">
                <form action="{{ route('pelacakan.proses', $alumni->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-process">Proses Pelacakan Ulang</button>
                </form>
            </div>

            @if($hasil->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Sumber</th>
                            <th>Nama Kandidat</th>
                            <th>Afiliasi</th>
                            <th>Jabatan</th>
                            <th>Lokasi</th>
                            <th>Topik</th>
                            <th>Skor</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil as $item)
                            <tr>
                                <td>{{ $item->sumber }}</td>
                                <td>{{ $item->nama_kandidat }}</td>
                                <td>{{ $item->afiliasi }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>{{ $item->topik }}</td>
                                <td>{{ $item->skor }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <div class="actions">
                                        <a class="btn-mini" href="{{ $item->link_bukti ?: '#' }}" target="_blank">
                                            Lihat {{ $item->sumber }}
                                        </a>
                                        <form action="{{ route('pelacakan.verifikasi', [$alumni->id, $item->id]) }}" method="POST">
                                            @csrf
                                            <button class="btn-mini" type="submit">Verifikasi Alumni</button>
                                        </form>
                                        <form action="{{ route('pelacakan.simpan', [$alumni->id, $item->id]) }}" method="POST">
                                            @csrf
                                            <button class="btn-mini primary" type="submit">Simpan Hasil</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty">
                    <div>Tidak ada kandidat yang ditemukan dari pelacakan</div>
                    <a class="btn-back" href="{{ route('alumni.show', $alumni->id) }}">Kembali ke Detail</a>
                </div>
            @endif
        </section>
    </div>
</body>
</html>
