<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelacakan Alumni</title>
    <style>
        :root {
            --bg: #fdf7f8;
            --card: #ffffff;
            --line: #eed9de;
            --text: #262626;
            --muted: #6f6f6f;
            --primary: #89051f;
            --ok-bg: #e8f6ee;
            --ok-text: #008444;
            --warn-bg: #fff7e6;
            --warn-text: #c95d00;
            --neutral-bg: #f2f4f7;
            --neutral-text: #374151;
            --danger-bg: #fff0f2;
            --danger-text: #d0112b;
            --danger-line: #f7a8b2;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .page {
            max-width: 1380px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .title {
            margin: 0;
            color: var(--primary);
            font-size: 28px;
            font-weight: 800;
        }

        .subtitle {
            margin: 8px 0 28px;
            color: var(--muted);
            font-size: 15px;
        }

        .toolbar {
            display: flex;
            gap: 14px;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .search-wrap {
            max-width: 540px;
            width: 100%;
            position: relative;
        }

        .search {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 12px 16px 12px 44px;
            background: #fff;
            font-size: 14px;
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 11px;
            color: #8a8a8a;
            font-size: 16px;
        }

        .btn-create {
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            border-radius: 14px;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: 700;
            line-height: 1;
            white-space: nowrap;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 26px;
        }

        .stat {
            border-radius: 14px;
            border: 1px solid var(--line);
            padding: 16px 18px;
            background: #fff;
        }

        .stat-title {
            margin: 0 0 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .stat-value {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            line-height: 1;
        }

        .stat-total { color: #842024; }
        .stat-ok { background: var(--ok-bg); border-color: #a9e6c1; color: var(--ok-text); }
        .stat-warn { background: var(--warn-bg); border-color: #f0cc7f; color: var(--warn-text); }
        .stat-neutral { background: var(--neutral-bg); color: var(--neutral-text); }

        .alert {
            border: 1px solid #b5e4c6;
            background: #ecfdf3;
            color: #0e7a3f;
            border-radius: 12px;
            padding: 11px 14px;
            margin-bottom: 14px;
            font-size: 13px;
        }

        .table-wrap {
            border: 1px solid var(--line);
            border-radius: 14px;
            overflow: hidden;
            background: var(--card);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: #fdf1f3;
            color: var(--primary);
            text-align: left;
            padding: 16px 20px;
            font-size: 14px;
            font-weight: 800;
            border-bottom: 1px solid var(--line);
        }

        tbody td {
            padding: 18px 20px;
            border-bottom: 1px solid #f3e7ea;
            vertical-align: middle;
            font-size: 13px;
        }

        tbody tr:last-child td { border-bottom: 0; }

        .name {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .sub {
            color: var(--muted);
            font-size: 13px;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid var(--danger-line);
            background: var(--danger-bg);
            color: var(--danger-text);
            font-weight: 600;
            font-size: 12px;
        }

        .badge.ok {
            border-color: #9addb8;
            background: #e8f8ef;
            color: #0c8c44;
        }

        .badge.warn {
            border-color: #f0cc7f;
            background: #fff7e6;
            color: #bf5b04;
        }

        .actions {
            display: flex;
            gap: 12px;
        }

        .icon-btn {
            background: transparent;
            border: 0;
            color: #c0172f;
            text-decoration: none;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .icon-btn svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
        }

        .pagination {
            padding-top: 12px;
        }

        @media (max-width: 960px) {
            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-wrap {
                max-width: 100%;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
            }

            .btn-create {
                text-align: center;
                font-size: 14px;
            }

            .table-wrap {
                overflow-x: auto;
            }

            table {
                min-width: 760px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <h1 class="title">Sistem Pelacakan Alumni</h1>
        <p class="subtitle">Kelola dan lacak alumni dengan sistem tracking multi-sumber</p>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="toolbar">
            <form action="{{ route('alumni.index') }}" method="GET" class="search-wrap">
                <span class="search-icon">⌕</span>
                <input
                    type="text"
                    name="q"
                    class="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Cari alumni berdasarkan nama, program studi, atau tahun lulus">
            </form>
            <a href="{{ route('alumni.create') }}" class="btn-create">＋ Tambah Alumni</a>
        </div>

        <div class="stats">
            <div class="stat">
                <p class="stat-title">Total Alumni</p>
                <p class="stat-value stat-total">{{ $stats['total'] ?? 0 }}</p>
            </div>
            <div class="stat stat-ok">
                <p class="stat-title">Teridentifikasi</p>
                <p class="stat-value">{{ $stats['teridentifikasi'] ?? 0 }}</p>
            </div>
            <div class="stat stat-warn">
                <p class="stat-title">Perlu Verifikasi</p>
                <p class="stat-value">{{ $stats['perlu_verifikasi'] ?? 0 }}</p>
            </div>
            <div class="stat stat-neutral">
                <p class="stat-title">Belum Dilacak</p>
                <p class="stat-value">{{ $stats['belum_dilacak'] ?? 0 }}</p>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Tahun Lulus</th>
                        <th>Status</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alumni as $item)
                        @php
                            $status = $item->status ?? 'Belum Ditemukan';
                            $statusClass = 'badge';
                            if (in_array($status, ['Ditemukan', 'Terverifikasi', 'Terdeteksi'])) {
                                $statusClass = 'badge ok';
                            } elseif ($status === 'Perlu Verifikasi') {
                                $statusClass = 'badge warn';
                            }
                        @endphp
                        <tr>
                            <td>
                                <div class="name">{{ $item->nama }}</div>
                                <div class="sub">{{ $item->kota ?: '-' }}</div>
                            </td>
                            <td>{{ $item->prodi }}</td>
                            <td>{{ $item->tahun_lulus }}</td>
                            <td><span class="{{ $statusClass }}">{{ $status }}</span></td>
                            <td>
                                <div class="actions" style="justify-content: flex-end;">
                                    <a class="icon-btn" href="{{ route('alumni.show', $item->id) }}" title="Detail">
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </a>
                                    <a class="icon-btn" href="{{ route('alumni.edit', $item->id) }}" title="Edit">
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 1 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                    </a>
                                    <form action="{{ route('alumni.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data alumni ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn" title="Hapus">
                                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--muted);">Belum ada data alumni.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $alumni->links() }}
        </div>
    </div>
</body>
</html>
