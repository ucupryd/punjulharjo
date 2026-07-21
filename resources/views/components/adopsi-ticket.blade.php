@props([
    'kode' => 'A',                 // 'A' | 'B'
    'nama' => 'Paket A',
    'judul' => '2 Bibit Cemara',
    'harga' => 150000,
    'deskripsi' => '',
    'fitur' => [],                 // array string
    'action' => '#',               // URL submit / pilih paket
    'method' => 'GET',
    'treeCode' => 'MYC-••••',       // kode dekoratif
    'paketId' => null,
])

@if(strtoupper($method) === 'GET')
  <a href="{{ $action }}" class="ticket-wrapper block text-left no-underline cursor-pointer group">
    <div class="ticket">
      <div class="t-main">
        <div class="t-content">
          <div class="t-header">
            <div class="t-logo">
              <i class="fa-solid fa-tree"></i> MY CEMARA
            </div>
            <div class="t-type">{{ $nama }}</div>
          </div>

          <div class="t-title">{{ $judul }}</div>
          <div class="t-subtitle">{{ $deskripsi }}</div>

          <ul class="t-features">
            @foreach($fitur as $f)
              <li><i class="fa-solid fa-circle-check"></i> {!! $f !!}</li>
            @endforeach
          </ul>
        </div>

        <div class="t-perforation"><div class="t-perf-line"></div></div>
      </div>

      <div class="t-stub">
        <div class="t-barcode-container">
          <div class="t-barcode"></div>
          <div class="t-barcode-id">{{ $treeCode }}</div>
        </div>
        <div class="t-price">
          <div class="t-price-label">Harga</div>
          <div class="t-price-num">Rp {{ number_format($harga, 0, ',', '.') }}</div>
          <div class="text-[10px] text-emerald-300 font-semibold mt-1 flex items-center justify-end gap-1 group-hover:translate-x-0.5 transition duration-300">
            <span>Klik untuk Adopsi</span> <i class="fa-solid fa-arrow-right text-[9px]"></i>
          </div>
        </div>
      </div>
    </div>
  </a>
@else
  <form action="{{ $action }}" method="POST" class="ticket-wrapper block text-left cursor-pointer group">
    @csrf
    @if($paketId) <input type="hidden" name="paket_id" value="{{ $paketId }}"> @endif
    <input type="hidden" name="paket" value="{{ $kode }}">
    <button type="submit" class="w-full text-left bg-transparent border-0 p-0 cursor-pointer appearance-none">
      <div class="ticket">
        <div class="t-main">
          <div class="t-content">
            <div class="t-header">
              <div class="t-logo">
                <i class="fa-solid fa-tree"></i> MY CEMARA
              </div>
              <div class="t-type">{{ $nama }}</div>
            </div>

            <div class="t-title">{{ $judul }}</div>
            <div class="t-subtitle">{{ $deskripsi }}</div>

            <ul class="t-features">
              @foreach($fitur as $f)
                <li><i class="fa-solid fa-circle-check"></i> {!! $f !!}</li>
              @endforeach
            </ul>
          </div>

          <div class="t-perforation"><div class="t-perf-line"></div></div>
        </div>

        <div class="t-stub">
          <div class="t-barcode-container">
            <div class="t-barcode"></div>
            <div class="t-barcode-id">{{ $treeCode }}</div>
          </div>
          <div class="t-price">
            <div class="t-price-label">Harga</div>
            <div class="t-price-num">Rp {{ number_format($harga, 0, ',', '.') }}</div>
            <div class="text-[10px] text-emerald-300 font-semibold mt-1 flex items-center justify-end gap-1 group-hover:translate-x-0.5 transition duration-300">
              <span>Klik untuk Adopsi</span> <i class="fa-solid fa-arrow-right text-[9px]"></i>
            </div>
          </div>
        </div>
      </div>
    </button>
  </form>
@endif
