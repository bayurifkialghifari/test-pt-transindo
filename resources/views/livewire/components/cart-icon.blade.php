<div>
    <li class="nav-item dropdown">
        <a class="nav-icon" href="{{ route('cart') }}" wire:navigate>
            <div class="position-relative">
                <i class="fa fa-shopping-cart"></i>
                <span class="indicator">
                    {{ $total }}
                </span>
            </div>
        </a>
    </li>
</div>
