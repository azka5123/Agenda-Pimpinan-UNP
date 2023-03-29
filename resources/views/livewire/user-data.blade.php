<div class="row my-3">
    <div class="col-12">
        <ul class="list-group">
            <li class="list-group-item"><input class="form-control" type="text" wire:model="search" placeholder="Search"
                    aria-label="search"></li>
            @foreach ($users as $item)
                @if ($search == '')
                @else
                    <li class="list-group-item">
                        <a href="{{ route('front_show2', $item->nama) }}" class="text-decoration-none text-dark px-1">
                            <i class="fas fa-fw fa-user-alt">
                            </i><span>
                                {{ $item->nama }} - {{ $item->jabatan }}
                            </span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
