<nav>
	<div class="branding">
		<img src="{{ asset('assets/images/default-image.webp') }}" alt="{{ config('app.name') }} Logo" width="40" height="40">
		<a href="{{ route('home-page') }}">{{ config('app.name') }}</a>
	</div>

	<div class="nav_links" id="nav_links">
        @php
            $nav_links = [
                ['route' => 'home-page', 'text' => 'Home'],
                ['route' => 'shop-page', 'text' => 'Shop'],
                ['route' => 'users.blogs', 'text' => 'Blogs'],
                ['route' => 'contact-page', 'text' => 'Contact'],
            ];
        @endphp

        @foreach($nav_links as $nav_link)
            <a href="{{ Route::has($nav_link['route']) ? route($nav_link['route']) : '#' }}" class="{{ Route::currentRouteName() === $nav_link['route'] ? 'active' : '' }}">
                {{ $nav_link['text'] }}
            </a>
        @endforeach
    </div>

	<div class="actions">
		<div class="shopping_cart">
			<a href="{{ Route::has('cart.index') ? route('cart.index') : '#' }}" aria-label="Shopping Cart">
                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                <span>{{ session('cart_count', 0) }}</span>
            </a>
		</div>

		<div class="authentication">
			@auth
				<a href="{{ route('dashboard') }}" aria-label="User Dashboard">
					<i class="fa fa-user" aria-hidden="true"></i>
				</a>
				@livewire('auth.logout-button', ['class' => 'btn_danger'])
			@else
				<a href="{{ route('login') }}" class="btn">Login</a>
			@endauth
		</div>
	</div>

	<button class="burger_menu" id="burger_menu" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="nav_links">
		<span></span>
        <span></span>
        <span></span>
	</button>
</nav>
