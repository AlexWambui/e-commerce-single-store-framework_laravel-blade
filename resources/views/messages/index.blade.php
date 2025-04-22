<x-authenticated-layout class="UserMessages">
    <x-slot name="head">
        <title>User Messages</title>
    </x-slot>

    <section class="messages">
        <div class="app_header">
            <div class="details">
                <p class="title">Messages</p>
                <p class="stats">
                    <span>{{ $count_all_messages }} {{ Str::plural('Message', $count_all_messages) }}</span>
                    <span>{{ $count_unread_messages }} Unread</span>
                </p>
            </div>
        </div>

        <div class="app_body">
            @if ($messages->isNotEmpty())
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Time</th>
                                <th class="actions center">Actions</th>
                            </tr>
                        </thead>
            
                        <tbody>
                            @foreach ($messages as $message)
                                <tr class="{{ $message->viewed == 0 ? 'bold' : '' }}">
                                    <td class="center">{{ $loop->iteration }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td class="stacked">
                                        <span>{{ $message->email }}</span>
                                        <span>{{ $message->phone_number }}</span>
                                    </td>
                                    <td>{{ $message->created_at->diffForHumans() }}</td>
                                    <td class="actions center">
                                        <div class="action">
                                            <a href="{{ route('messages.show', $message->id) }}">
                                                <span class="fas fa-eye"></span> 
                                            </a> 
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No messages yet.</p>
            @endif
        </div>
    </section>
</x-authenticated-layout>
