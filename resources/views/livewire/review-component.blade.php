
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Product Reviews</h2>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Side: Create Review Form -->
        <div class="w-full lg:w-1/2">
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

            {{-- Create Review Form --}}
            <form wire:submit.prevent="addReview" class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Rating (1-5):</label>
                    <input type="number" wire:model.defer="rating" min="1" max="5" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Comment:</label>
                    <textarea wire:model.defer="comment" required rows="3"
                        class="w-full border border-gray-300 rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                    @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Upload Image (optional):</label>
                    <input type="file" wire:model="image"
                        class="block w-full text-gray-600" />
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                        Create Review
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Side: Display Reviews -->
        <div class="w-full lg:w-1/2">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">All Reviews</h3>

            @forelse ($reviews as $review)
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
                        <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image"
                            class="w-32 h-32 object-cover rounded mb-3 shadow border border-gray-300" />
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
            @empty
                <p class="text-gray-500">No reviews yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Edit Modal --}}
    @if ($showEditModal)
        <div
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            wire:key="edit-modal">
            <div
                class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
                <h3 class="text-xl font-semibold mb-4">Edit Review</h3>

                <form wire:submit.prevent="updateReview" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Rating (1-5):</label>
                        <input type="number" wire:model.defer="rating" min="1" max="5" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                        @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Comment:</label>
                        <textarea wire:model.defer="comment" required rows="3"
                            class="w-full border border-gray-300 rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                        @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Upload Image (optional):</label>
                        <input type="file" wire:model="image"
                            class="block w-full text-gray-600" />
                        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" alt="New Image Preview"
                                class="w-32 h-32 object-cover rounded mt-3" />
                        @elseif($reviewId && $reviews->firstWhere('_id', $reviewId)?->image)
                            <img src="{{ asset('storage/' . $reviews->firstWhere('_id', $reviewId)->image) }}" alt="Current Image"
                                class="w-32 h-32 object-cover rounded mt-3" />
                        @endif
                    </div>

                    <div class="flex justify-end space-x-4 mt-6">
                        <button type="button" wire:click="$set('showEditModal', false)"
                            class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>


