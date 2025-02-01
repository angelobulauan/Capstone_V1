<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}">
</head>
<style>
    .announcement-card {
        transition: transform 0.3s;
    }
    .announcement-card:hover {
        transform: scale(1.05);
    }
    h2{
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}
</style>
<body>
@extends('layouts.LOAdmin.app')

@section('content')
@csrf
<div class="container mt-4">
    <h2 class="text-center">Announcements</h2>
    <button class="btn btn-primary mb-3" onclick="toggleForm()">Add Announcement</button>

    <div id="announcement-form" class="mb-4" style="display: none;">
        <form action="{{ route('admin.announcements.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="activity_name" class="form-label">Activity Name</label>
                <input type="text" name="activity_name" id="activity_name" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" ></textarea>
            </div>


            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" name="event_date" id="event_date" class="form-control" >
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <div class="row">
        @if($announcements->isEmpty())
            <div class="col-12 text-center">
                <p class="text-muted font-weight-bold" style="font-size: 18px;">No Announcements Available</p>
            </div>
        @else
            @foreach($announcements as $announcement)
                <div class="col-md-4">
                    <div class="card announcement-card p-3 mb-3">
                        <h5>{{ $announcement->activity_name }}</h5>
                        <p><strong>Description:</strong> {{ $announcement->description }}</p>
                        <p><strong>Date:</strong> {{ date('F d, Y', strtotime($announcement->event_date)) }}</p>
                        <!-- Edit and Delete buttons -->
                        <button class="btn btn-warning btn-sm mb-2" onclick="openEditModal({{ $announcement->id }}, '{{ $announcement->activity_name }}', '{{ $announcement->event_date }}', '{{ $announcement->description }}')">Edit</button>

                        <button class="btn btn-danger btn-sm" onclick="openDeleteModal({{ $announcement->id }})">Delete</button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_activity_name" class="form-label">Activity Name</label>
                        <input type="text" name="activity_name" id="edit_activity_name" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="edit_event_date" class="form-label">Event Date</label>
                        <input type="date" name="event_date" id="edit_event_date" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this announcement?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-2">Delete</button>
                    <br>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleForm() {
        $('#announcement-form').toggle();
    }

    function openEditModal(id, activity_name, event_date, description) {
    $('#editForm').attr('action', '/admin/announcements/' + id);
    $('#edit_activity_name').val(activity_name);
    $('#edit_event_date').val(event_date);
    $('#edit_description').val(description); // Set the description value
    $('#editModal').modal('show');
}

    function openDeleteModal(id) {
        $('#deleteForm').attr('action', '/admin/announcements/' + id);
        $('#deleteModal').modal('show');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
</body>
</html>
