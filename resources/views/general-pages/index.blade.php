<x-guest-layout class="HomePage">
	<x-slot name="head">
		@vite(['resources/css/compiled/home-page.css'])
		<title>{{ config('app.name') }} - Home page</title>
	</x-slot>

	<section class="Hero">
		<div class="container">
			<h1>Homepage</h1>
		</div>
	</section>	
</x-guest-layout>
