@hasanyrole($item['can'])
<li class="sidebar-menu-item">
    <a class="sidebar-menu-button" href="{{ $item['href'] }}">
        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">{{ $item['icon'] }}</i> {{ $item['name'] }}
    </a>
</li>
@endhasanyrole
