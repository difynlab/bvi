@extends('layouts.layout')

@section('title', 'Events')

@section('content')
    <div class="page">
        <div class="row align-items-center mb-3 mb-md-4">
            <div class="col-12 mb-3 mb-md-0 col-md-8">
                <p class="title">Events</p>
                <p class="description">Manage events here.</p>
            </div>
            <div class="col-12 col-md-4 text-end">
                <a class="add-button">
                    <i class="bi bi-plus-lg"></i>
                    Add New
                </a>
            </div>
        </div>

        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <x-pagination pagination="{{ $pagination }}"></x-pagination>
            </div>
        </div>

        <div class="row data-container">
            @if($items->isNotEmpty())
                @foreach($items as $item)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="single">
                            <img src="{{ asset('storage/events/thumbnails/' . $item->thumbnail) }}" data-src="{{ asset('storage/events/' . $item->thumbnail) }}" alt="Thumbnail" class="image lazyload">

                            <div class="details">
                                <div class="row align-items-center mb-2 mb-md-3">
                                    <div class="col-5">
                                        <p class="event-category {{ $item->category }}">{{ ucfirst($item->category) }}</p>
                                    </div>
                                    <div class="col-7 text-end">
                                        <p class="event-date">{{ Carbon\Carbon::parse($item->date)->format('F j, Y') }}</p>
                                    </div>
                                </div>

                                <p class="event-title line-clamp-1">{{ $item->title }}</p>

                                <div class="event-description line-clamp-2">{!! $item->short_description !!}</div>

                                <p class="event-details">
                                    <i class="bi bi-clock"></i> {{ Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ Carbon\Carbon::parse($item->end_time)->format('H:i') }}
                                </p>

                                <p class="event-details">
                                    <i class="bi bi-geo-alt"></i> {{ $item->location }}
                                </p>

                                <div class="bottom-box">
                                    <div class="row">
                                        <div class="col-8">
                                            <a class="edit" id="{{ $item->id }}">Edit Details</a>
                                        </div>
                                        <div class="col-4 text-end">
                                            <a class="delete delete-button" id="{{ $item->id }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div id="pagination">
                    {{ $items->appends(request()->except('page'))->links("pagination::bootstrap-5") }}
                </div>
            @else
                <div class="col-12 text-center">
                    <p class="no-data">No data found!</p>
                </div>
            @endif
        </div>

        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        @include('events.form')
                    </div>
                </div>
            </div>
        </div>

        <x-delete-data data="event"></x-delete>
    </div>
@endsection

@push('after-scripts')
    <script>
        window.moduleRoutes = {
            destroyRoute: "{{ route('admin.events.destroy', [':id']) }}",
            pageUrl: "{!! $items->url(1) !!}"
        };
    </script>

    <script src="{{ asset('js/index.js') }}"></script>

    <script defer>
        $('.edit').on('click', function() {
            let eventId = $(this).attr('id');
            let storeURL = "{{ route('admin.events.edit', ':eventId') }}".replace(':eventId', eventId);
            let updateURL = "{{ route('admin.events.update', ':eventId') }}".replace(':eventId', eventId);

            $.ajax({
                url: storeURL,
                method: 'GET',
                success: function(data) {
                    $('#form').attr('action', updateURL);
                    $('#title').val(data.title);
                    $('#short_description').val(data.title);
                    $('#category').val(data.category);

                    const date = document.getElementById('date');
                    const dateParts = data.date.split('-');
                    if(dateParts.length === 3) {
                        const year = parseInt(dateParts[0], 10);
                        const month = parseInt(dateParts[1], 10) - 1;
                        const day = parseInt(dateParts[2], 10);
                        const dateObj = new Date(year, month, day);

                        date.DatePickerX.setValue(dateObj);
                    }
                    $('#date').val(data.date);
                    $('#start_time').val(data.start_time).trigger('change');
                    $('#end_time').val(data.end_time).trigger('change');
                    $('#repeat').val(data.repeat);
                    $('#location').val(data.location);
                    $('input[name="status"][value="' + data.status + '"]').prop('checked', true);

                    // Initialize editors
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        let editors = initializeEditors(data, csrfToken);
                    // Initialize editors

                    // Handle image preview
                        handleImagePreview(data.thumbnail);
                    // Handle image preview

                    // Modal open and destroy
                        modalOpenDestroy();
                    // Modal open and destroy
                },
                error: function(xhr, status, error) {
                    alert('Error fetching event data: ' + error);
                }
            });
        });
    </script>
@endpush