@extends('layouts.admin')

@section('title', 'Contacts')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Contact Messages</h1>
            <p class="text-gray-600 mt-2">View and manage customer inquiries</p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Messages</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalMessages ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-envelope text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Today</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $todayMessages ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-day text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">This Week</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $weekMessages ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Contact Forms</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ \App\Models\Contact::count() ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-reply text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

<!-- Search and Filter -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
    <form method="GET" action="{{ route('contacts.index') }}" class="flex flex-col md:flex-row gap-4 items-end justify-between">
        <div class="flex-1 w-full md:w-auto">
            <label class="block text-sm font-medium text-gray-700 mb-2">Search Messages</label>
            <input type="text" 
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search by name, email..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
        </div>
        <div class="w-full md:w-auto">
            <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
            <select name="date_filter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                <option value="">All Messages</option>
                <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>This Month</option>
            </select>
        </div>
        <div class="flex gap-2 w-full md:w-auto">
            <button type="submit" class="flex-1 md:flex-none inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                <i class="fas fa-search mr-2"></i>Search
            </button>
            <a href="{{ route('contacts.index') }}" class="flex-1 md:flex-none inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors">
                <i class="fas fa-times mr-2"></i>Reset
            </a>
        </div>
    </form>
</div>

<!-- Messages List -->
<div class="space-y-6">
    @forelse($contacts ?? [] as $contact)
    <div class="bg-white rounded-lg shadow-sm p-6 transition-all duration-300 hover:shadow-md border border-gray-200 border-l-4 border-l-blue-600">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Contact Info -->
            <div class="flex-1">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold bg-blue-600">
                        {{ substr($contact->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold mb-1 text-gray-900">
                            {{ $contact->name ?? 'Anonymous' }}
                        </h3>
                        <div class="flex flex-col gap-1">
                            <p class="text-sm flex items-center text-gray-600">
                                <i class="fas fa-envelope mr-2 text-blue-600"></i>
                                {{ $contact->email }}
                            </p>
                            @if($contact->phone)
                            <p class="text-sm flex items-center text-gray-600">
                                <i class="fas fa-phone mr-2 text-green-600"></i>
                                {{ $contact->phone }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Message Content -->
                <div class="p-4 rounded-lg bg-gray-50">
                    <p class="text-sm font-medium mb-2 text-blue-600">Message:</p>
                    <p class="text-gray-700 line-height: 1.6;">{{ $contact->message }}</p>
                </div>
            </div>
            
            <!-- Timestamp and Actions -->
            <div class="md:w-64 flex flex-col gap-4">
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-700">
                        {{ $contact->created_at->format('M j, Y') }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $contact->created_at->format('g:i A') }}
                    </p>
                </div>
                
                <div class="flex flex-col gap-2">
                    <button onclick="openReplyModal({{ $contact->id }}, '{{ $contact->name }}', '{{ $contact->email }}')" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-reply mr-2"></i>Reply
                    </button>
                    <button onclick="archiveMessage({{ $contact->id }})" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors border border-gray-200">
                        <i class="fas fa-archive mr-2"></i>Archive
                    </button>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-lg shadow-sm p-12 text-center border border-gray-200">
        <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6 bg-blue-100">
            <i class="fas fa-inbox text-4xl text-blue-600"></i>
        </div>
        <h3 class="text-xl font-bold mb-2 text-gray-900">No Messages Yet</h3>
        <p class="text-gray-600">When customers contact you through the website, their messages will appear here.</p>
    </div>
    @endforelse
</div>

<!-- Reply Modal -->
<div id="replyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl bg-white rounded-lg shadow-lg">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Reply to Message</h3>
                <button onclick="closeReplyModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="replyForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">To:</label>
                    <div id="recipientInfo" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subject:</label>
                    <input type="text" id="replySubject" name="subject" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message:</label>
                    <textarea id="replyMessage" name="message" rows="6" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your reply here..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>Send Reply
                    </button>
                    <button type="button" onclick="closeReplyModal()" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentContactId = null;

    function archiveMessage(contactId) {
        if (confirm('Are you sure you want to archive this message?')) {
            fetch(`/contacts/${contactId}/archive`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while archiving the message.');
            });
        }
    }

    function openReplyModal(contactId, name, email) {
        currentContactId = contactId;
        document.getElementById('recipientInfo').textContent = `${name} <${email}>`;
        document.getElementById('replySubject').value = 'Re: Your inquiry';
        document.getElementById('replyMessage').value = '';
        document.getElementById('replyModal').classList.remove('hidden');
    }

    function closeReplyModal() {
        document.getElementById('replyModal').classList.add('hidden');
        currentContactId = null;
    }

    document.getElementById('replyForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!currentContactId) return;

        const formData = new FormData(this);
        
        fetch(`/contacts/${currentContactId}/reply`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reply sent successfully!');
                closeReplyModal();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while sending the reply.');
        });
    });
</script>

@endsection
