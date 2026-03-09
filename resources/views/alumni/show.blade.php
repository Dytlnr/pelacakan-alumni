<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Alumni</title>
    <style>
        :root {
            --bg: #fdf7f8;
            --card: #ffffff;
            --line: #eed9de;
            --text: #212121;
            --muted: #6f6f6f;
            --primary: #89051f;
            --primary-dark: #6c0418;
            --chip-bg: #fff0f2;
            --chip-line: #efbcc5;
            --chip-text: #89182a;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .page {
            max-width: 1020px;
            margin: 0 auto;
            padding: 28px 18px 36px;
        }

        .top-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 14px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 20px;
        }

        .name {
            margin: 0 0 4px;
            font-size: 32px;
            color: var(--primary);
            line-height: 1.1;
            font-weight: 800;
        }

        .meta {
            color: var(--muted);
            font-size: 15px;
        }

        .top-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .badge {
            border: 1px solid #ef9eaa;
            color: #d31530;
            background: #fff0f2;
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            text-decoration: none;
            border-radius: 14px;
            padding: 9px 14px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 18px 20px;
            margin-bottom: 16px;
        }

        .card-title {
            margin: 0 0 16px;
            color: var(--primary);
            font-size: 17px;
            font-weight: 800;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px 26px;
        }

        .info-item {
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .info-item svg {
            width: 20px;
            height: 20px;
            stroke: #a3112a;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .label {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 2px;
        }

        .value {
            font-size: 15px;
            font-weight: 500;
        }

        .chips-group {
            margin-bottom: 14px;
        }

        .chips-label {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip {
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid var(--chip-line);
            background: var(--chip-bg);
            color: var(--chip-text);
            font-size: 12px;
            font-weight: 600;
        }

        .cta {
            margin-top: 24px;
            border-radius: 14px;
            padding: 24px;
            background: linear-gradient(150deg, #a50530 0%, #7a0624 100%);
            color: #fff;
        }

        .cta-title {
            margin: 0 0 6px;
            font-size: 27px;
            font-weight: 800;
        }

        .cta-text {
            margin: 0 0 18px;
            opacity: 0.95;
            font-size: 16px;
        }

        .btn-cta {
            background: #fff;
            border: 0;
            color: var(--primary);
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            gap: 10px;
            align-items: center;
        }

        .btn-cta:hover {
            background: #fff5f7;
        }

        @media (max-width: 820px) {
            .header {
                flex-direction: column;
            }

            .name {
                font-size: 25px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .top-actions {
                width: 100%;
            }

            .cta-title {
                font-size: 21px;
            }
        }
    </style>
</head>
<body>
    @php
        $profil = $alumni->profilPencarian;
        $variasiNama = $profil?->variasi_nama ?? [$alumni->nama];
        $keywordAfiliasi = $profil?->keyword_afiliasi ?? array_values(array_filter([$alumni->prodi]));
        $keywordKonteks = $profil?->keyword_konteks ?? array_values(array_filter([$alumni->bidang, $alumni->tahun_lulus ? 'Alumni '.$alumni->tahun_lulus : null]));
        $status = $alumni->status ?? 'Belum Ditemukan';
    @endphp

    <div class="page">
        <a class="top-link" href="{{ route('alumni.index') }}">
            <span aria-hidden="true">&larr;</span>
            <span>Kembali</span>
        </a>

        <div class="header">
            <div>
                <h1 class="name">{{ $alumni->nama }}</h1>
                <div class="meta">🎓 {{ $alumni->prodi }} • {{ $alumni->tahun_lulus }}</div>
            </div>
            <div class="top-actions">
                <span class="badge">{{ $status }}</span>
                <a href="{{ route('alumni.edit', $alumni->id) }}" class="btn-outline">
                    <span>✎</span>
                    <span>Edit</span>
                </a>
            </div>
        </div>

        <section class="card">
            <h2 class="card-title">Informasi Alumni</h2>
            <div class="info-grid">
                <div class="info-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 4h16v16H4z"/><path d="m4 7 8 6 8-6"/></svg>
                    <div>
                        <div class="label">Email</div>
                        <div class="value">-</div>
                    </div>
                </div>
                <div class="info-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.18 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.77.62 2.62a2 2 0 0 1-.45 2.11l-1.27 1.27a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.72.5 2.62.62A2 2 0 0 1 22 16.92Z"/></svg>
                    <div>
                        <div class="label">Telepon</div>
                        <div class="value">-</div>
                    </div>
                </div>
                <div class="info-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="7" width="18" height="14" rx="2"/><path d="M8 7V5a4 4 0 1 1 8 0v2"/></svg>
                    <div>
                        <div class="label">Afiliasi</div>
                        <div class="value">{{ $keywordAfiliasi[0] ?? '-' }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M20 10c0 6-8 11-8 11s-8-5-8-11a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <div>
                        <div class="label">Lokasi</div>
                        <div class="value">{{ $alumni->kota ?: '-' }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                    <div>
                        <div class="label">Bidang Keahlian</div>
                        <div class="value">{{ $alumni->bidang ?: '-' }}</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="card">
            <h2 class="card-title">Profil Pencarian</h2>

            <div class="chips-group">
                <div class="chips-label">Variasi Nama</div>
                <div class="chips">
                    @forelse($variasiNama as $item)
                        <span class="chip">{{ $item }}</span>
                    @empty
                        <span class="chip">-</span>
                    @endforelse
                </div>
            </div>

            <div class="chips-group">
                <div class="chips-label">Kata Kunci Afiliasi</div>
                <div class="chips">
                    @forelse($keywordAfiliasi as $item)
                        <span class="chip">{{ $item }}</span>
                    @empty
                        <span class="chip">-</span>
                    @endforelse
                </div>
            </div>

            <div class="chips-group" style="margin-bottom: 0;">
                <div class="chips-label">Kata Kunci Konteks</div>
                <div class="chips">
                    @forelse($keywordKonteks as $item)
                        <span class="chip">{{ $item }}</span>
                    @empty
                        <span class="chip">-</span>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="cta">
            <h3 class="cta-title">Mulai Pelacakan Alumni</h3>
            <p class="cta-text">Sistem akan melacak alumni ini di berbagai sumber seperti LinkedIn, Google Scholar, dan ResearchGate</p>
            <form action="{{ route('pelacakan.proses', $alumni->id) }}" method="POST">
                @csrf
                <button class="btn-cta" type="submit">
                    <span>⌕</span>
                    <span>Mulai Pelacakan</span>
                </button>
            </form>
        </section>
    </div>
</body>
</html>
