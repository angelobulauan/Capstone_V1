<section>
    @if (auth()->user()->involvement == 'uploader')
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3>Verification Form</h3>
            <div class="max-w-xl">
                <form method="POST" action="{{ route('profile.updateID') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <x-input-label for="id_number" :value="__('ID Number')" class="text-black dark:text-black" />
                        <div class="input-group mt-1">
                            <span class="input-group-text">
                                <i class="fa fa-id-card"></i>
                            </span>
                            <input type="text" name="id_number" id="id_number" class="form-control"
                                value="{{ old('id_number', auth()->user()->id_number) }}"
                                placeholder="Enter your ID Number">
                        </div>
                        <x-input-error :messages="$errors->get('id_number')" class="mt-2" />
                    </div>

                    <div class="col-md-6">
                        <x-input-label for="id_img" :value="__('Add ID Image')" class="text-black dark:text-black" />
                        <div class="input-group mt-1">
                            <span class="input-group-text">
                                <i class="fa fa-image"></i>
                            </span>
                            <input type="file" name="id_img" id="id_img" class="form-control"
                                accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                        </div>
                        @if (auth()->user()->id_img)
                            <img id="frame" src="{{ asset('storage/' . auth()->user()->id_img) }}" class="mt-2"
                                style="max-width: 150px; max-height: 150px;" />
                        @else
                            <img id="frame" src="" class="mt-2" style="max-width: 150px; max-height: 150px;" />
                        @endif
                        <x-input-error :messages="$errors->get('id_img')" class="mt-2" />
                    </div>

                    <div class="col-12">
                        <x-primary-button class="mt-4 bg-black text-black">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    @endif
</section>

