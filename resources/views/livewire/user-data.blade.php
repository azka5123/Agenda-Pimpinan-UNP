<div class="row justify-content-center">
    <div class="col col-6">
        <input class="form-control my-3 rounded-pill" type="text" wire:model="search" placeholder="Search"
            aria-label="search">
    </div>
    <div class="col col-6 pt-4">
        @foreach ($users as $item)
            <a href="{{ route('front_show2', [$item->id, $item->nama]) }}" class="text-decoration-none text-light">
                @if ($search == '')
                @else
                    <i class="fas fa-fw fa-user-alt">
                    </i><span>
                        {{ $item->nama}}  - {{ $item->jabatan }}
                    </span>
                @endif
            </a>
        @endforeach
    </div>

    {{-- <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Nama
    </div> --}}

</div>
