<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">All Product Reviews</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $editMode ? 'updateReview' : 'addReview' }}" class="space-y-4 mb-8">
        <div>
            <label class="block text-gray-700 font-medium mb-1">Rating (1-5):</label>
            <input type="number" wire:model="rating" min="1" max="5" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Comment:</label>
            <textarea wire:model="comment" required rows="3"
                      class="w-full border border-gray-300 rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
            @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Upload Image (optional):</label>
            <input type="file" wire:model="image" 
                   class="block w-full text-gray-600" />
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                {{ $editMode ? 'Update Review' : 'Add Review' }}
            </button>

            @if($editMode)
                <button type="button" wire:click="$set('editMode', false)"
                        class="bg-gray-400 text-white px-5 py-2 rounded hover:bg-gray-500 transition">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <hr class="my-6 border-gray-300" />

    <h3 class="text-xl font-semibold mb-4 text-gray-800">All Reviews</h3>

    @foreach ($reviews as $review)
        <div class="border border-gray-200 rounded-lg p-4 mb-4 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between items-center mb-2">
                <div class="text-sm text-gray-500">
                    <span><strong>User ID:</strong> {{ $review->user_id }}</span>
                </div>
                <div class="text-yellow-500 font-bold text-lg">
                    ★ {{ $review->rating }}
                </div>
            </div>
            
            <p class="text-gray-700 mb-3 whitespace-pre-line">{{ $review->comment }}</p>

            @if ($review->image)
                <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image" class="w-32 h-32 object-cover rounded mb-3 shadow" />
            @endif

            @if ($review->user_id == auth()->id())
                <div class="space-x-3">
                    <button wire:click="editReview('{{ $review->_id }}')"
                            class="text-blue-600 hover:underline font-semibold">
                        Edit
                    </button>
                    <button wire:click="deleteReview('{{ $review->_id }}')" 
                            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline font-semibold">
                        Delete
                    </button>
                </div>
            @endif
        </div>
    @endforeach
</div>
