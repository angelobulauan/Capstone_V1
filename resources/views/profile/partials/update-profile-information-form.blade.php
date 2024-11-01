<section>

    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <h3>Profile Form</h3>
        <div class="grid grid-cols-2 gap-6">
            <form method="POST" action="{{ route('profile.profileupdate') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                @csrf
                @method('PUT') <!-- Change to PUT -->


                <!-- ID Number Input -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="text-black dark:text-black" />

                    <div class="input-group mt-1">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i> <!-- Font Awesome user icon -->
                        </span>

                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $user->name) }}" placeholder="Enter your Full Name">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-black dark:text-black" />

                    <div class="input-group mt-1">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i> <!-- Font Awesome envelope icon -->
                        </span>

                        <input type="text" name="email" id="email" class="form-control"
                            value="{{ old('email', $user->email) }}" placeholder="Enter your Email">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="sex" :value="__('Sex')" class="text-black dark:text-black" />

                    <div class="input-group mt-1">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i> <!-- Font Awesome genderless icon -->
                        </span>

                        <select name="sex" id="sex" class="form-control">
                            <option value="" disabled selected>Select your Sex</option>
                            <option value="male" {{ old('sex', $user->sex) == 'male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="female" {{ old('sex', $user->sex) == 'female' ? 'selected' : '' }}>Female
                            </option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="dob" :value="__('Date of Birth')" class="text-black dark:text-black" />

                    <div class="input-group mt-1">
                        <span class="input-group-text">
                            <i class="fa fa-id-card"></i> <!-- Font Awesome ID card icon -->
                        </span>

                        <input type="date" name="dob" id="dob" class="form-control"
                            value="{{ old('dob', $user->dob) }}" placeholder="Enter your Date of Birth"
                            min="{{ date('Y-m-d', strtotime('-100 years')) }}" max="{{ date('Y-m-d') }}">
                    </div>
                    <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="address" :value="__('Address')" class="text-black dark:text-black" />

                    <div class="input-group mt-1">
                        <span class="input-group-text">
                            <i class="fa fa-home"></i> <!-- Font Awesome home icon -->
                        </span>

                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ old('address', $user->address) }}" placeholder="Enter your Address">
                    </div>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div>
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

                <div>
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
                </div>

        </div>
        <x-primary-button class="mt-4 bg-black text-black">
            {{ __('Save') }}
        </x-primary-button>
        <!-- JavaScript for live image preview -->
        <script>
            function previewImage(event) {
                const frame = document.getElementById('frame');
                frame.src = URL.createObjectURL(event.target.files[0]);
                frame.onload = () => URL.revokeObjectURL(frame.src); // Free memory after loading
            }
        </script>
    </div>
    </div>

</section>

