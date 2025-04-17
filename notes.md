# Features
- Authentication (Fortify)
- Dashboard Analytics
- Products
- Product Reviews
- Inventory
- Sales
- Deliveries
- Payments
- Blogs
- User Messages



## Installation
1. Clone the Repository
    ```bash
    git clone git@github.com:AlexWambui/basic-website-template_laravel-blade.git
    ```
2. Install the dependencies
    ```bash
    composer install && npm install
    ```
3. Set up the Environment file
    ```bash
    cp .env.example .env
    ```
4. Generate the application key variable for the .env file
    ```bash
    php artisan key:generate
    ```
5. Run the migrations
    ```bash
    php artisan migrate
    ```
6. Make sure GD driver is installed to be able to use image intervention library.
	- To install GD driver
    ```bash
    sudo apt-get install php-gd
    ```
    - To check if it's installed
    [/config/check-gd-driver-for-image-intervention](/config/check-gd-driver-for-image-intervention)


## Usage
1. Start the local development server
    ```bash
    php artisan serve
    ```
2. Open your browser and navigate to the following address: [http://localhost:8000](http://localhost:8000)



# DB Design
```
users {
	id();
	string('first_name');
	string('last_name');
	string('email')->unique();
	string('phone_number')->nullable();
	string('secondary_phone_number')->nullable();
	string('image')->nullable();
	string('password');
	unsignedTinyInteger('user_level')->default(3);
	unsignedTinyInteger('user_status')->default(1);
	timestamp('email_verified_at')->nullable();
	rememberToken();
	timestamps();
}


user_messages {
	id();
	string('name');
	string('email');
	string('phone_number');
	string('message', 2000);
	boolean('viewed')->default(false);
	timestamps();
}

product_categories {
	id();
	string('name')->unique();
	string('slug')->index();
}

products {
	id();
	string('name')->unique();
	string('slug')->index();
	string('product_code')->nullable();
	boolean('featured')->default(0);
	boolean('is_visible')->default(1);
	decimal('buying_price',10,2)->default(0.00);
	decimal('selling_price',10,2)->default(0.00);
	decimal('discount_price',10,2)->default(0.00)->nullable();
	decimal('discount_percentage',10,2)->default(0.00)->nullable();
	unsignedSmallInteger('product_measurement')->nullable();
	unsignedSmallInteger('stock_count')->default(1);
	unsignedSmallInteger('safety_stock')->default(1);
	text('description')->nullable();
	unsignedSmallInteger('product_sorting')->default(100);

	foreignId('category_id')->nullable()->constrained('product_categories')->nullOnDelete();
	timestamps();
}

product_images {
	id();
	string('image');
	smallInteger('image_sorting')->default(5);

	foreignId('product_id')->constrained('products')->cascadeOnDelete();
	timestamps();
}

product_reviews {
	id();
	unsignedTinyInteger('rating');
	string('review', 1500);
	string('image')->nullable();
	boolean('is_visible')->default(true);
	unsignedMediumInteger('sorting')->default(100);

	foreignId('product_id')->constrained('products')->cascadeOnDelete();
	foreignId('user_id')->constrained('users')->cascadeOnDelete();
	timestamps();
}

stock_movements {
	id();
	string('reference_number')->nullable();
	string('movement_type');
	unsignedSmallInteger('quantity');

	foreignId('product_id')->constrained('products')->cascadeOnDelete();
	foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
	foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
	timestamps();
}

delivery_locations {
	id();
	string('name')->unique();
	timestamps();
}

delivery_areas {
	id();
	string('name')->unique();
	decimal('price',10,2)->default(0.00);

	foreignId('delivery_location_id')->constrained('delivery_locations')->cascadeOnDelete();
	timestamps();
}

sales {
	id();
    string('reference_number');
    unsignedTinyInteger('sale_type')->default(0);
    unsignedTinyInteger('sale_status')->default(0);
    string('discount_code')->nullable();
    decimal('discount_amount',10,2)->default(0.00);
    decimal('selling_price',10,2)->default(0.00);
    decimal('amount_paid',10,2)->default(0.00);
    string('payment_method')->nullable();

    foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
    $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
    timestamps();
}

sales_items {
	id();
    string('name');
    unsignedSmallInteger('quantity')->default(1);
    decimal('buying_price',10,2)->default(0.00);
    decimal('selling_price',10,2)->default(0.00);

    foreignId('sale_id')->constrained('sales')->cascadeOnDelete();
    foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
    timestamps();
}

deliveries {
	$table->id();
    $table->string('full_name');
    $table->string('email');
    $table->string('phone_number');
    $table->string('address');
    $table->string('location');
    $table->string('area');
    $table->decimal('shipping_cost');
    $table->string('delivery_status')->default('pending');

	$table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->foreignId('sale_id')->constrained('sales')->cascadeOnDelete();
    $table->timestamps();
}

sale_payments {
	id();
	decimal('amount_paid', 10, 2);
	string('payment_method');
	string('transaction_reference')->nullable();
	timestamp('payment_date')->default(now());

	foreignId('sale_id')->constrained('sales')->cascadeOnDelete();
	timestamps();
}

payments {
	id();
	string('status');
	decimal('amount_paid', 10, 2);
	string('payment_gateway');
	string('merchant_request_id');
	string('checkout_request_id');
	string('transaction_reference');
	string('response_code');
	string('response_description');
	text('customer_message');

	$table->foreignId('sale_id')->constrained('sales')->cascadeOnDelete();
    $table->foreignId('customer_id')->nullable()->constrained('users')->nullOnDelete();
	timestamps();
}

blog_categories {
	id();
	string('name')->unique();
	string('slug')->index();
	timestamps();
}

blogs {
	id();
	string('title')->unique();
	string('slug')->index();
	string('image')->nullable();
	text('content');

	foreignId('blog_category_id')->nullable()->constrained('blog_categories')->nullOnDelete();
	timestamps();
}

settings {
	id();
    string('company_name');
    string('location');
    string('phone_number');
    string('secondary_phone_number')->nullable();
    string('email');
    string('currency')->default('KES');
    string('logo')->nullable();
    timestamps();
}
```



# Constants
```
USERLEVELS = [
    0 => 'super_admin',
    1 => 'admin',
    2 => 'cashier',
    3 => 'customer'
];

SHIFTSTATUS = [
    'active',
    'closed',
];

SALESTYPE = [
    0 => 'walk-in',
    1 => 'online'
];

SALESSTATUSTYPE = [
    0 => 'pending',
    1 => 'completed',
    2 => 'canceled',
    3 => 'refund'
];

PAYMENTMETHODS = [
    'cash',
    'mpesa',
    'card',
    'bank_transfer'
];

PAYMENTSTATUSTYPE = [
    'pending',
    'confirmed',
    'failed',
    'reversed'
];

STOCKMOVEMENTYPE = [
    'purchase', 
    'sale', 
    'restock', 
    'adjustment'
];
```
