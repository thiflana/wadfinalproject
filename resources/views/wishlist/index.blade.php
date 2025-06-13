{{-- resources/views/wishlist/index.blade.php --}}
<x-app-layout>
    <div class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">My Wishlist</h1>
                    <p class="text-gray-600 mt-2">Here are the products you have added to your wishlist.</p>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Wishlist Grid -->
            @if($wishlist->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($wishlist as $item)
                        @php $product = $item->product; @endphp
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <!-- Product Image -->
                            <div class="relative">
                                @if($product->image_path)
                                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="h-48 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center">
                                        <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $product->restaurant_name ?? 'Restaurant' }}</p>
                                <p class="text-gray-500 text-xs mb-3 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                                
                                <!-- Display notes if they exist -->
                                @if($item->notes)
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-2 mb-3">
                                        <p class="text-xs text-yellow-800">
                                            <span class="font-medium">Note:</span> {{ Str::limit($item->notes, 50) }}
                                        </p>
                                    </div>
                                @endif

                                <div class="flex space-x-2">
                                    <a href="{{ route('products.show', $product) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                        View
                                    </a>

                                    <!-- Notes Button -->
                                    <button type="button" 
                                            class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-md text-sm font-medium transition-colors duration-200 notes-btn"
                                            data-wishlist-id="{{ $item->id }}"
                                            data-product-name="{{ $product->name }}"
                                            data-current-notes="{{ $item->notes ?? '' }}">
                                        Notes
                                    </button>

                                    <!-- Remove from Wishlist -->
                                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $wishlist->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No wishlist items</h3>
                    <p class="mt-2 text-gray-500">Browse the menu and add items you like.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 shadow-md">
                            Browse Products
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Notes Modal -->
    <div id="notesModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 id="notesModalTitle" class="text-xl font-bold text-gray-900">Add Notes</h3>
                        <button id="closeNotesModal" class="text-gray-500 hover:text-gray-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form id="notesForm">
                        <div class="space-y-4">
                            <div>
                                <label for="wishlistNotes" class="block text-sm font-medium text-gray-700 mb-2">Your Notes</label>
                                <textarea id="wishlistNotes" 
                                          name="notes" 
                                          rows="4" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500" 
                                          placeholder="Add your personal notes about this product..."></textarea>
                                <p class="text-xs text-gray-500 mt-1">Maximum 255 characters</p>
                            </div>
                            <div class="flex space-x-3">
                                <button type="button" id="cancelNotes" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md transition-colors">
                                    Cancel
                                </button>
                                <button type="submit" id="saveNotes" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-md transition-colors">
                                    Save Notes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const notesModal = document.getElementById('notesModal');
        const notesModalTitle = document.getElementById('notesModalTitle');
        const notesForm = document.getElementById('notesForm');
        const notesTextarea = document.getElementById('wishlistNotes');
        const closeNotesModal = document.getElementById('closeNotesModal');
        const cancelNotes = document.getElementById('cancelNotes');
        const saveNotes = document.getElementById('saveNotes');
        const notesButtons = document.querySelectorAll('.notes-btn');
        
        let currentWishlistId = null;

        // Open notes modal
        notesButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentWishlistId = this.dataset.wishlistId;
                const productName = this.dataset.productName;
                const currentNotes = this.dataset.currentNotes;
                
                notesModalTitle.textContent = `Notes for ${productName}`;
                notesTextarea.value = currentNotes;
                notesModal.classList.remove('hidden');
                notesTextarea.focus();
            });
        });

        // Close modal functions
        function closeModal() {
            notesModal.classList.add('hidden');
            currentWishlistId = null;
            notesTextarea.value = '';
        }

        closeNotesModal.addEventListener('click', closeModal);
        cancelNotes.addEventListener('click', closeModal);

        // Close modal when clicking outside
        notesModal.addEventListener('click', function(e) {
            if (e.target === notesModal) {
                closeModal();
            }
        });

        // Save notes
        notesForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!currentWishlistId) return;
            
            const notes = notesTextarea.value.trim();
            
            // Disable save button during request
            saveNotes.disabled = true;
            saveNotes.textContent = 'Saving...';
            
            try {
                const response = await fetch(`/wishlist/${currentWishlistId}/notes`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ notes: notes })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showToast(data.message);
                    closeModal();
                    
                    // Update the notes button data and display
                    const notesBtn = document.querySelector(`[data-wishlist-id="${currentWishlistId}"]`);
                    if (notesBtn) {
                        notesBtn.dataset.currentNotes = notes;
                        
                        // Update the notes display in the card
                        const card = notesBtn.closest('.bg-white');
                        const existingNotesDiv = card.querySelector('.bg-yellow-50');
                        
                        if (notes) {
                            if (existingNotesDiv) {
                                existingNotesDiv.querySelector('.text-yellow-800').innerHTML = 
                                    `<span class="font-medium">Note:</span> ${notes.length > 50 ? notes.substring(0, 50) + '...' : notes}`;
                            } else {
                                const notesDiv = document.createElement('div');
                                notesDiv.className = 'bg-yellow-50 border-l-4 border-yellow-400 p-2 mb-3';
                                notesDiv.innerHTML = `
                                    <p class="text-xs text-yellow-800">
                                        <span class="font-medium">Note:</span> ${notes.length > 50 ? notes.substring(0, 50) + '...' : notes}
                                    </p>
                                `;
                                const productInfo = card.querySelector('.p-4');
                                const buttonsDiv = productInfo.querySelector('.flex.space-x-2');
                                productInfo.insertBefore(notesDiv, buttonsDiv);
                            }
                        } else if (existingNotesDiv) {
                            existingNotesDiv.remove();
                        }
                    }
                } else {
                    showToast(data.message || 'Failed to save notes');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.');
            } finally {
                saveNotes.disabled = false;
                saveNotes.textContent = 'Save Notes';
            }
        });

        // Character counter for textarea
        notesTextarea.addEventListener('input', function() {
            const maxLength = 255;
            const currentLength = this.value.length;
            const counterText = this.parentNode.querySelector('.text-xs.text-gray-500');
            
            if (currentLength > maxLength) {
                this.value = this.value.substring(0, maxLength);
                counterText.textContent = `Maximum ${maxLength} characters reached`;
                counterText.classList.add('text-red-500');
            } else {
                counterText.textContent = `${currentLength}/${maxLength} characters`;
                counterText.classList.remove('text-red-500');
            }
        });
    });

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-all duration-300';
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('translate-x-0');
        }, 100);
        
        setTimeout(() => {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</x-app-layout>