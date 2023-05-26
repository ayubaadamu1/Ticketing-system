<x-app-layout>

	<div class="py-12 mx-auto" style="width: 50%;">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
				<div class="max-w-xl">
					<section>
	 
 
	
	<div>
	   
	   <div class="flex justify-between py-4">
	  	<div>
			<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Title</h2> <span>{{ $ticket->title }}</span>
  
  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Description</h2><span>{{ $ticket->description }}</span>
  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $ticket->created_at->diffForHumans() }}</h2>

  <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100v mr-5">
					@if ( $ticket->image )
		   
						<a class="text-lg font-medium text-gray-900 dark:text-gray-100" href="{{ '/storage/'.$ticket->image }}" target="_blank">See Image</a> 
						<!-- <img class="rounded" height="50px" width="50px" src="{{ '/storage/'.$ticket->image }}" alt="image"> -->
				
					@endif
				</h2>
  
			</div>
	<div>

	</div>


	   </div>
		 <div class="flex justify-between">
	   <div class="flex  ">

			   <a href="{{ route('ticket.edit', $ticket->id) }}">
					<x-primary-button class="ml-3">
						{{ __('Edit') }}
					</x-primary-button>
			   </a>

		   <form method="POST" action="{{ route('ticket.destroy', $ticket->id) }}">
			   @csrf
			   @method('delete')
		   <x-primary-button class="ml-3">
			   {{ __('Delete') }}
		   </x-primary-button>
			</form>

	   </div>
	   @if( auth()->user()->isAdmin )
		 <div class="flex">
		 <form method="POST" action="{{ route('ticket.update', $ticket->id) }}">
		@csrf
		@method('patch') 
		 <x-primary-button class="ml-3">
			   {{ __('Approve') }}
		   </x-primary-button>
		   <input type="hidden" name="status" value="approved">
		</form>
		<form method="POST" action="{{ route('ticket.update', $ticket->id) }}">
		@csrf
		@method('patch') 
		 <x-primary-button class="ml-3">
			   {{ __('Reject') }}
		   </x-primary-button>
		   <input type="hidden" name="status" value="rejected">
			</form>
		 </div>
		 @else
		 <p class="text-lg font-medium text-gray-900 dark:text-gray-100v mr-5"f>Status: {{$ticket->status}}</p>
		@endif
	</div>
	   
   </div>
	</section>

				</div>
			</div>

			 
		</div>
	</div>
</x-app-layout>
