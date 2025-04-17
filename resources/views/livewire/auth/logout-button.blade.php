{{--

Default (Icon + Text)
@livewire('auth.logout-button')

Red Button
@livewire('auth.logout-button', ['class' => 'btn-danger'])

Icon Only
@livewire('auth.logout-button', ['iconOnly' => true, 'class' => 'btn-danger'])

Text Only
@livewire('auth.logout-button', ['textOnly' => true, 'class' => 'btn-outline'])

Custom Text
@livewire('auth.logout-button', ['text' => 'Sign out', 'class' => 'btn-warning'])

Custom Icon + Text
@livewire('auth.logout-button', ['text' => 'Sign out', 'class' => 'btn-warning'])
--}}

<button
    wire:click="logout"
    type="button"
    class="{{ $class }}"
>
    @if (! $textOnly && ! $iconOnly)
        {{-- Icon + Text --}}
        <span>{{ $text }}</span> <i class="fas fa-sign-out-alt icons"></i>
    @elseif ($iconOnly)
        {{-- Icon Only --}}
        <i class="fas fa-sign-out-alt icons"></i>
    @elseif ($textOnly)
        {{-- Text Only --}}
        {{ $text }}
    @endif
</button>

