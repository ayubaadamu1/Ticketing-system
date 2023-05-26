<x-app-layout>
  

    <div class="py-12 mx-auto" style="width: 50%;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
               	<div class="max-w-xl">
                		<section class="col-md-6">
								<header>
									<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
											{{ __('Create new support ticket') }}
									</h2>

									<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
											{{ __("Please, fill in the details below.") }}
									</p>
								</header>
 
    
								<form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
									@csrf
									<!-- Email Address -->
									<div>
										<x-input-label for="title" class="mt-3" :value="__('Title')" />
										<x-text-input id="title" class="block mt-1 w-full" type="text" name="title" placeholder="Enter Title"/>
										<x-input-error :messages="$errors->get('title')" class="mt-2" />
									</div>
									<!-- Description -->
									<div class="mt-3">
										<x-input-label for="description" :value="__('Description')" />
										<x-textarea class="mt-1" name="description" placeholder="Enter Description" id="description" cols="70" rows="3" value="" required />
										<x-input-error :messages="$errors->get('description')" class="mt-2" />
									</div>
									<!-- Image -->
									<div class="mt-4">
										<x-input-label for="image" :value="__('Image')" />
										<x-text-input id="image" class="block mt-1 w-full" type="file" name="image" required />
										<x-input-error :messages="$errors->get('image')" class="mt-2" />
									</div>

									<div class="flex items-center justify-start mt-4">
										<x-primary-button class="ml-3">
											{{ __('Add') }}
										</x-primary-button>
									</div>

								</form>
							</section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
