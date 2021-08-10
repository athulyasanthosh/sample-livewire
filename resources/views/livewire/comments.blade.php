<div class="flex justify-center container">
	
	<div class="row">
		<h1 class="my-10 text-3xl">Comments</h1>
		@error('newComment') <span style="color:red; font-size: 11px;">{{ $message }}</span> @enderror
		<div>
			@if (session()->has('message'))
				<div class="alert alert-success">
					{{ session('message') }}
				</div>
			@endif
		</div>
		<form wire:submit.prevent="addComment">
			<div class="col-md-10">
				{{$image}}
				<input type="file" id="image" wire:change="$emit('fileChoosen')">
				<input type="text" placeholder="What's in your mind ?" wire:model.debounce.500ms="newComment">
			</div>
			<div class="col-md-2">
				<button class="btn-primary rounded" type="submit">Add</button>
			</div>
		</form>
	</div>
	<div class="row">
		@foreach($comments as $comment)
		<div class="col-md-12" style="margin-top: 10px; border: 1px solid gray;">			
			<div>
				<span><b>{{$comment->creator->name}}</b> {{$comment->created_at->diffForHumans()}}</span>
				<i class="far fa-times" style="color: red; cursor: pointer;" wire:click="remove({{$comment->id}})"></i>
			</div>			
			<p>{{$comment->body}}</p>
		</div>	
		@endforeach	
		{{$comments->links()}}
	</div>    
</div>

<script>
window.livewire.on('fileChoosen', postId=> {
	let inputField = document.getElementById('image');
	let file = inputField.files[0];
	let reader = new fileReader();
})
</script>