<li @if(isset($item['id'])) id="{{ $item['id'] }}" @endif class="nav-item">

    <a class="nav-link {{ $item['class'] }} @if(isset($item['shift'])) {{ $item['shift'] }} @endif"
       href="{{ $item['href'] }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif
       {!! $item['data-compiled'] ?? '' !!}>

        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }}"></i>

        <p>
            {{ $item['text'] }}

            @if(isset($item['label']))
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                    {{ $item['label'] }}
                </span>
            @endif
        </p>

    </a>

</li>

<li @if(isset($item['id'])) id="{{ $item['id'] }}" @endif class="nav-item">
    <a class="nav-link" href="{{ url('admin/producto') }}">
        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }}"></i>
        <p>
            Productos
        </p>
    </a>
</li>

<li @if(isset($item['id'])) id="{{ $item['id'] }}" @endif class="nav-item">
    <a class="nav-link" href="{{ url('admin/factura') }}">
        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }}"></i>
        <p>
            Facturas
        </p>
    </a>
</li>

<li @if(isset($item['id'])) id="{{ $item['id'] }}" @endif class="nav-item">
    <a class="nav-link" href="{{ url('admin/createPDF') }}" target="_blank">
        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }}"></i>
        <p>
            PDF
        </p>
    </a>
</li>