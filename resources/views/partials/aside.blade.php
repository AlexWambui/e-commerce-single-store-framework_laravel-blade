<aside>
	<div class="branding">
		<a href="{{ route('home-page') }}">{{ config('app.name') }}</a>
	</div>

	<div class="nav_links">
		@php
            $navLinks = [
                ['route' => 'dashboard', 'icon' => 'fas fa-home', 'text' => 'Dashboard'],
                ['route' => 'orders.index', 'icon' => 'fas fa-truck-loading', 'text' => 'Orders'],
                ['route' => 'product-reviews.index', 'icon' => 'fas fa-star', 'text' => 'Reviews'],
                ['route' => 'messages.index', 'icon' => 'fas fa-comment', 'text' => 'Messages'],
                ['route' => 'blogs.index', 'icon' => 'fas fa-blog', 'text' => 'Blogs'],
                ['route' => 'users.index', 'icon' => 'fas fa-users-cog', 'text' => 'Users'],
                ['route' => 'products.index', 'icon' => 'fas fa-barcode', 'text' => 'Products'],
                ['route' => 'locations.index', 'icon' => 'fas fa-map-marker-alt', 'text' => 'Locations'],
            ];
        @endphp

        <ul>
        	@foreach($navLinks as $link)
                <li class="nav-link {{ Route::currentRouteName() === $link['route'] ? 'active' : '' }}">
                    <a href="{{ Route::has($link['route']) ? route($link['route']) : '#' }}">
                        <i class="{{ $link['icon'] }}"></i>
                        <span class="text">{{ $link['text'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
	</div>

	<div class="actions">
		<div class="profile">
			<a href="{{ route('profile.edit') }}">
                <img src="{{ Auth::user()->profile_image }}" alt="Logo" width="40" height="40">
                <span>{{ Auth::user()->first_name }}</span>
            </a>
		</div>

		<div class="logout">
			@livewire('auth.logout-button', ['class' => 'btn_danger'])
		</div>
	</div>
</aside>
