
<style>
    body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 20rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: black;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

</style>
<body>


<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image -->
                    <img id="profileImage" class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Image">

                    <!-- Profile picture help block -->
                    <div class="small font-italic text-danger mb-4">JPG or PNG no larger than 5 MB</div>

                    <!-- Hidden inputs for uploading and capturing images -->
                    <input type="file" id="uploadImage" class="form-control" accept="image/*" style="display: none;">
                    <input type="file" id="captureImage" class="form-control" accept="image/*" capture="environment" style="display: none;">

                    <!-- Buttons for uploading or capturing images -->
                    <button class="btn btn-primary" onclick="document.getElementById('uploadImage').click()">Upload Image</button>
                    {{-- <button class="btn btn-secondary" onclick="document.getElementById('captureImage').click()">Take a Photo</button> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Email Address</label>
                            <input class="form-control" id="email" name="email" type="email"  value="{{ old('email', $user->email) }}" placeholder="Enter your Email Address" required >
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Name</label>
                                <input class="form-control" id="name" name="name" type="text"  value="{{ old('name', $user->name) }}" placeholder="Enter your first name"required >
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Location</label>
                                <input class="form-control" id="inputLastName" type="text" placeholder="Enter your Location" required >
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Gender</label>
                                <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your Sex" required  >
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputDOB">Date of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i> <!-- Calendar icon, requires Font Awesome or similar -->
                                    </span>
                                    <input
                                        class="form-control"
                                        id="inputDOB"
                                        type="date"
                                        placeholder="Enter your Date of Birth"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- Form Group (email address)-->

                        <!-- Form Row-->

                        <!-- Save changes button-->
                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-black text-white px-4 py-2 rounded">{{ __('Save') }}</button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-black dark:text-white"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to preview the selected or captured image
    function previewImage(event) {
        const [file] = event.target.files;
        if (file) {
            const url = URL.createObjectURL(file);
            document.getElementById('profileImage').src = url;
        }
    }

    // Event listeners for upload and capture inputs
    document.getElementById('uploadImage').addEventListener('change', previewImage);
    // document.getElementById('captureImage').addEventListener('change', previewImage);

     // This script will automatically insert the chosen date into the input field
     document.getElementById('inputDOB').addEventListener('change', function () {
        // Date is automatically handled by the date input type, no additional code needed.
    });
</script>
</body>
</html>
