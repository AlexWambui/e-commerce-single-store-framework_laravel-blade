<div class="AdminDashboard">
	<div class="stats">
		<div class="stat">
			<span>{{ $count_users }}</span>
			<span>
				<a href="{{ route('users.index') }}">
					{{ Str::plural('User', $count_users) }}
				</a>
			</span>
		</div>

		<div class="stat">
			<span>xxx</span>
			<span>
				<a href="#">
					xxx
				</a>
			</span>
		</div>

		<div class="stat">
			<span>xxx</span>
			<span>
				<a href="#">
					xxx
				</a>
			</span>
		</div>

		<div class="stat">
			<span>xxx</span>
			<span>
				<a href="#">
					xxx
				</a>
			</span>
		</div>

		<div class="stat">
			<span>xxx</span>
			<span>
				<a href="#">
					xxx
				</a>
			</span>
		</div>
	</div>

	<div class="sales">
		<div class="sale">
			<span>xxx</span>
			<span>
				<a href="#">
					Gross Sales
				</a>
			</span>
		</div>

		<div class="sale">
			<span>xxx</span>
			<span>
				<a href="#">
					Net Sales
				</a>
			</span>
		</div>

		<div class="sale">
			<span>xxx</span>
			<span>
				<a href="#">
					Cost of Sales
				</a>
			</span>
		</div>

		<div class="sale">
			<span>xxx</span>
			<span>
				<a href="#">
					Gross Profit
				</a>
			</span>
		</div>
	</div>

	<div class="charts">
		<div class="chart">
			<p class="title">Sales</p>
			<canvas id="salesChart"></canvas>
		</div>

		<div class="chart">
			<p class="title">Deliveries</p>
			<canvas id="citiesChart"></canvas>
		</div>
	</div>
</div>
