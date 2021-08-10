<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class Comments extends Component
{
	use WithPagination;
	protected $paginationTheme = 'bootstrap';

	public $newComment;
	public $image;

	public function updated($field)
    {
        $this->validateOnly($field, ['newComment' => 'required|max:255']);
    }

	
	public function  addComment() 
	{
		$this->validate(['newComment' => 'required|max:255']);
		
		$createdComment = Comment::create(['body'=> $this->newComment, 'user_id'=> 1]);
		
		$this->newComment = ""	;
		session()->flash("message", "Comment added successfully");
	}

	public function remove($commentId) {
		$comment = Comment::find($commentId);
		$comment->delete();
		$this->comments = $this->comments->except($commentId);
		session()->flash("message", "Comment deleted successfully");
	}

    public function render()
    {
        return view('livewire.comments', ['comments' => Comment::latest()->paginate(2)]);
    }
}
