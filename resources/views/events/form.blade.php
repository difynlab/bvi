<form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="form" id="form">
    @csrf
    <div class="page-details mb-3 mb-md-4">
        <p class="title">Event Details</p>
        <p class="description">Fill in the details below to create a new event.</p>
    </div>

    <div class="row">
        <div class="col-12 mb-3 mb-lg-4">
            <label for="title" class="form-label label">Title<span class="asterisk">*</span></label>
            <input type="text" class="form-control input-field" id="title" name="title" value="{{ old('title') }}" placeholder="Title" required>
            <x-input-error field="title"></x-input-error>
        </div>

        <div class="col-12 mb-3 mb-lg-4">
            <label for="short_description" class="form-label label">Short Description<span class="asterisk">*</span></label>
            <textarea class="form-control input-field textarea" id="short_description" name="short_description" value="{{ old('short_description') }}" placeholder="Short Description" rows="3" required></textarea>
            <x-input-error field="short_description"></x-input-error>
        </div>

        <div class="col-12 col-lg-6 mb-3 mb-lg-4">
            <label for="category" class="form-label label">Category<span class="asterisk">*</span></label>
            <select name="category" id="category" class="form-control input-field">
                <option value="">Select</option>
                <option value="workshop" {{ old('category') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="conference" {{ old('category') == 'conference' ? 'selected' : '' }}>Conference</option>
                <option value="webinar" {{ old('category') == 'webinar' ? 'selected' : '' }}>Webinar</option>
            </select>
            <x-input-error field="category"></x-input-error>
        </div>

        <div class="col-12 col-lg-6 mb-3 mb-lg-4">
            <label for="date" class="form-label label">Date<span class="asterisk">*</span></label>
            <input type="text" class="form-control input-field date-picker-field" id="date" name="date" placeholder="Date" value="{{ old('date') }}">
            <x-input-error field="date"></x-input-error>
        </div>

        <div class="col-12 col-lg-4 mb-3 mb-lg-4">
            <label for="start_time" class="form-label label">Start Time<span class="asterisk">*</span></label>
            <select name="start_time" id="start_time" class="form-control input-field js-single">
                <x-times :data="old('start_time')"></x-times>
            </select>
            <x-input-error field="start_time"></x-input-error>
        </div>

        <div class="col-12 col-lg-4 mb-3 mb-lg-4">
            <label for="end_time" class="form-label label">End Time<span class="asterisk">*</span></label>
            <select name="end_time" id="end_time" class="form-control input-field js-single">
                <x-times :data="old('end_time')"></x-times>
            </select>
            <x-input-error field="end_time"></x-input-error>
        </div>

        <div class="col-12 col-lg-4 mb-3 mb-lg-4">
            <label for="repeat" class="form-label label">Repeat<span class="asterisk">*</span></label>
            <select name="repeat" id="repeat" class="form-control input-field">
                <option value="na" {{ old('repeat') == 'na' ? 'selected' : '' }}>Does not repeat</option>
                <option value="daily" {{ old('repeat') == 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="weekly" {{ old('repeat') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ old('repeat') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="annually" {{ old('repeat') == 'annually' ? 'selected' : '' }}>Annually</option>
            </select>
            <x-input-error field="repeat"></x-input-error>
        </div>

        <div class="col-12 mb-3 mb-lg-4">
            <label for="content" class="form-label label">Content<span class="asterisk">*</span></label>
            <textarea class="editor" id="content" name="content" value="{{ old('content') }}">{{ old('content') }}</textarea>
            <x-input-error field="content"></x-input-error>
        </div>

        <div class="col-12 mb-3 mb-lg-4">
            <label for="location" class="form-label label">Location<span class="asterisk">*</span></label>
            <input type="text" class="form-control input-field" id="location" name="location" value="{{ old('location') }}" placeholder="Location" required>
            <x-input-error field="location"></x-input-error>
        </div>

        <div class="col-12 mb-3 mb-lg-4">
            <x-upload-image-must old_name="old_thumbnail" old_value="{{ old('thumbnail') }}" new_name="new_thumbnail" path="events" label="thumbnail"></x-upload-image-must>
            <x-input-error field="new_thumbnail"></x-input-error>
        </div>

        <x-status></x-create>
    </div>
</form>