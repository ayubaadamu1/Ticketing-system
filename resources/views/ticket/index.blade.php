<x-app-layout>
	 
 

	 <div class="py-12 mx-auto" style="width: 50%;">
		  
		  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
				
				<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
					<a class="flex items-between justify-between" href="{{ route('ticket.create') }}"> 
					<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
										{{ __('Support Tickets Information') }}
								  </h2>
								
						<x-primary-button class="ml-2">
							 {{ __('Create') }}
						</x-primary-button>
				  	</a>
				   <div class="max-w-xl">
					 	<section>
						  
								 

							 
						 
							 <div>
								  @foreach($tickets as $ticket)
								  <div class="flex justify-between py-4">
										<a href="{{ route('ticket.show', $ticket->id) }}">{{ $ticket->title }}</a>
										<p>{{ $ticket->created_at->diffForHumans() }}</p>
								  </div>
								  @endforeach
							 </div>
							 @if(count($tickets)==0)
							 <h2>You don't have any support ticket yet!</h2>
							 @endif
						</section>

					 </div>
				</div>

				 
		  </div>
	 </div>
</x-app-layout>
