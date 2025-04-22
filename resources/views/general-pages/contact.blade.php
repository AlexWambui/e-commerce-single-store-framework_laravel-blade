<x-guest-layout class="ContactPage">
    <x-slot name="head">
        <meta name="description" content="Contact {{ config('app.name') }} for inquiries, support, and business collaborations. Reach us via phone, email, or visit our office.">
        <meta name="keywords" content="contact {{ config('app.name') }}, customer support, business inquiries, reach us">
        @vite(['resources/css/compiled/contact-page.css'])
        <title>Contact {{ config('app.name') }} - Get in Touch</title>
        
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ContactPage",
            "name": "Contact {{ config('app.name') }}",
            "url": "{{ url('/contact') }}",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "{{ config('app.phone_number') }}",
                "email": "{{ config('app.email') }}",
                "contactType": "customer service"
            },
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ config('app.address') }}",
                "postalCode": "{{ config('app.pobox') }}"
            }
        }
        </script>
    </x-slot>

    <section class="contactpage">
        <div class="container">
            <div class="contact_details">
                <div class="header">
                    <h1>Contact Us</h1>
                    <p>Use the details below or fill out the form to get in touch with us.</p>
                </div>

                <div class="contact">
                    <div class="details">
                        <div class="detail">
                            <img src="{{ asset('assets/images/email.webp') }}" alt="Email" width="30" height="30" />
                            <p>{{ config('app.email') }}</p>
                        </div>

                        <div class="detail">
                            <img src="{{ asset('assets/images/telephone.webp') }}" alt="Telephone" width="30" height="30" />
                            <p>
                                <span>{{ config('app.phone_number') }}</span>
                                @if(config('app.secondary_phone_number'))
                                    <span>{{ config('app.secondary_phone_number') }}</span>
                                @endif
                            </p>
                        </div>

                        <div class="detail">
                            <img src="{{ asset('assets/images/location.webp') }}" alt="Location" width="30" height="30" />
                            <p>
                                <span>{{ config('app.address') }}</span>
                            </p>
                        </div>

                        <div class="detail">
                            <img src="{{ asset('assets/images/clock.webp') }}" alt="Opening and Closing Time" width="30" height="30">
                            <p>
                                <span>Mon to Fri</span>
                                <span>08:00 A.M - 05:00 P.M</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact_form custom_form">
                <form action="{{ route('messages.store') }}" method="post">
                    @csrf

                    <div class="custom_inputs">
                        <input type="text" name="name" id="name" placeholder="" value="{{ old('name') }}">
                        <label for="name">Full Name</label>
                        <x-input-error field="name" />
                    </div>

                    <div class="custom_inputs">
                        <input type="email" name="email" id="email" placeholder="" value="{{ old('email') }}">
                        <label for="email">Email Address</label>
                        <x-input-error field="email" />
                    </div>

                    <div class="custom_inputs">
                        <input type="text" name="phone_number" id="phone_number" placeholder="" value="{{ old('phone_number') }}">
                        <label for="phone_number">Phone Number</label>
                        <x-input-error field="phone_number" />
                    </div>

                    <div class="custom_inputs">
                        <textarea name="message" id="message" rows="7" cols="30" placeholder="">{{ old('message') }}</textarea>
                        <label for="message">Your message</label>
                        <x-input-error field="message" />
                    </div>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>
