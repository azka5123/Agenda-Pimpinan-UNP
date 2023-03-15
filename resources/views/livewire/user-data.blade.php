<div>
    <input class="form-control mb-3" type="text" wire:model="search" placeholder="Search" aria-label="search">
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Nama
    </div>
    @foreach ($users as $item)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('front_show2', $item->id) }}">
                <i class="fas fa-fw fa-tachometer-alt">
                </i><span>{{ $item->nama }}</span>
            </a>
        </li>
    @endforeach
</div>