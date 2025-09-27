<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;  // Assuming you have a Product model for MySQL
use App\Models\Review;
use MongoDB\BSON\ObjectId;


class ReviewComponent extends Component
{

    use WithFileUploads;

   public $showEditModal = false;

    public $reviews; // all reviews for this product
    public $rating;
    public $comment;
    public $image;
    public $reviewId; // for editing
    public $editMode = false;

   public function mount()
    {
        $this->loadReviews();
    }

    public function loadReviews()
    {
        // Get ALL reviews, no filtering by product
        $this->reviews = Review::orderBy('created_at', 'desc')->get();
    }

    public function addReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('reviews', 'public');
        }

        Review::create([
            'user_id' => Auth::id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->reset(['rating', 'comment', 'image']);
        $this->loadReviews();

        session()->flash('message', 'Review added successfully!');
    }

    // public function editReview($id)
    // {
    //     $review = Review::find($id);

    //     if ($review && $review->user_id == Auth::id()) {
    //         $this->reviewId = $id;
    //         $this->rating = $review->rating;
    //         $this->comment = $review->comment;
    //         $this->editMode = true;
    //     } else {
    //         session()->flash('error', 'Unauthorized action.');
    //     }
    // }

    public function editReview($id)
{
    $review = Review::where('_id', new ObjectId($id))->first();

    if ($review && $review->user_id == Auth::id()) {
        $this->reviewId = (string) $review->_id;
        $this->rating = $review->rating;
        $this->comment = $review->comment;
        $this->editMode = true;
        $this->showEditModal = true; // Open modal
    } else {
        session()->flash('error', 'Unauthorized action.');
    }
}


    // public function updateReview()
    // {
    //     $this->validate([
    //         'rating' => 'required|integer|min:1|max:5',
    //         'comment' => 'required|string|max:1000',
    //         'image' => 'nullable|image|max:2048',
    //     ]);

    //     $review = Review::find($this->reviewId);

    //     if ($review && $review->user_id == Auth::id()) {
    //         if ($this->image) {
    //             $imagePath = $this->image->store('reviews', 'public');
    //             $review->image = $imagePath;
    //         }

    //         $review->rating = $this->rating;
    //         $review->comment = $this->comment;
    //         $review->updated_at = now();
    //         $review->save();

    //         $this->reset(['rating', 'comment', 'image', 'reviewId']);
    //         $this->editMode = false;
    //         $this->loadReviews();

    //         session()->flash('message', 'Review updated successfully!');
    //     } else {
    //         session()->flash('error', 'Unauthorized action.');
    //     }
    // }

//     public function updateReview()
// {
//     $this->validate([
//         'rating' => 'required|integer|min:1|max:5',
//         'comment' => 'required|string|max:1000',
//         'image' => 'nullable|image|max:2048',
//     ]);

//     $objectId = new ObjectId($this->reviewId);

//     $review = Review::where('_id', $objectId)->first();

//     if ($review && $review->user_id == Auth::id()) {
//         if ($this->image) {
//             $imagePath = $this->image->store('reviews', 'public');
//             $review->image = $imagePath;
//         }

//         $review->rating = $this->rating;
//         $review->comment = $this->comment;
//         $review->updated_at = now();
//         $review->save();

//         $this->reset(['rating', 'comment', 'image', 'reviewId']);
//         $this->editMode = false;
//         $this->loadReviews();

//         session()->flash('message', 'Review updated successfully!');
//     } else {
//         session()->flash('error', 'Unauthorized action or review not found.');
//     }
// }

public function updateReview()
{
    $this->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
        'image' => 'nullable|image|max:2048',
    ]);

    $objectId = new ObjectId($this->reviewId);

    $review = Review::where('_id', $objectId)->first();

    if ($review && $review->user_id == Auth::id()) {
        $updateData = [
            'rating' => $this->rating,
            'comment' => $this->comment,
            'updated_at' => now(),
        ];

        if ($this->image) {
            $imagePath = $this->image->store('reviews', 'public');
            $updateData['image'] = $imagePath;
        }

        Review::where('_id', $objectId)->update($updateData);

        $this->reset(['rating', 'comment', 'image', 'reviewId']);
        $this->editMode = false;
        $this->loadReviews();

        session()->flash('message', 'Review updated successfully!');
        $this->showEditModal = false;

    } else {
        session()->flash('error', 'Unauthorized action or review not found.');
    }
}


    public function deleteReview($id)
    {
        $review = Review::find($id);

        if ($review && $review->user_id == Auth::id()) {
            $review->delete();
            $this->loadReviews();

            session()->flash('message', 'Review deleted successfully!');
        } else {
            session()->flash('error', 'Unauthorized action.');
        }
    }

//     public function render()
//     {
//         return view('livewire.review-component', [
//             'reviews' => $this->reviews,
//         ]);
//     }


public function render()
{
    return view('livewire.review-component', [
        'reviews' => $this->reviews,
    ])->layout('layouts.app');
}

}
