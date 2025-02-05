<x-layout>
    <!-- Job Details Column -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <section class="md:col-span-3">
            <div class="rounded-lg shadow-md bg-white p-3">
                <div class="flex justify-between items-center">
                    <a class="block p-4 text-blue-700" href={{ route('jobs.index') }}>
                        <i class="fa fa-arrow-alt-circle-left"></i>
                        Back To Listings
                    </a>
                    @can('update', $job)
                        <div class="flex space-x-3 ml-4">
                            <a href={{ route('jobs.edit', $job->id) }}
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">Edit</a>
                            <!-- Delete Form -->
                            <form method="POST" action="{{ route('jobs.destroy', $job->id) }}"
                                onsubmit="return confirm('Are you sure you want to delete this job?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                    Delete
                                </button>
                            </form>
                            <!-- End Delete Form -->
                        </div>
                    @endcan
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-semibold">
                        {{ $job->title }}
                    </h2>
                    <p class="text-gray-700 text-lg mt-2">
                        {{ $job->description }}
                    </p>
                    <ul class="my-4 bg-gray-100 p-4">
                        <li class="mb-2">
                            <strong>Job Type:</strong> {{ $job->job_type }}
                        </li>
                        <li class="mb-2">
                            <strong>Remote:</strong> {{ $job->remote ? 'Yes' : 'No' }}
                        </li>
                        <li class="mb-2">
                            <strong>Salary:</strong> ${{ number_format($job->salary) }}
                        </li>
                        <li class="mb-2">
                            <strong>Site Location:</strong> {{ $job->city }}, {{ $job->state }}
                        </li>
                        @if ($job->tags)
                            <li class="mb-2">
                                <strong>Tags:</strong>
                                <span>{{ ucwords(str_replace(',', ', ', $job->tags)) }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="container mx-auto p-4">
                <h2 class="text-xl font-semibold mb-4">Job Details</h2>
                @if ($job->benefits || $job->requirements)
                    <div class="rounded-lg shadow-md bg-white p-4">
                        <h3 class="text-lg font-semibold mb-2 text-blue-500">
                            Job Requirements
                        </h3>
                        <p>
                            {{ $job->requirements }}
                        </p>
                        <h3 class="text-lg font-semibold mt-4 mb-2 text-blue-500">
                            Benefits
                        </h3>
                        <p>
                            {{ $job->benefits }}
                        </p>
                    </div>
                @endif

                @auth
                    <p class="my-5">
                        Put "Job Application" as the subject of your email
                        and attach your resume.
                    </p>

                    <!-- Modal -->
                    <div x-data="{ open: false }" id="applicant-form">
                        <button @click="open = true"
                            class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                            Apply Now
                        </button>

                        <div x-cloak x-show="open"
                            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                            <div @click.outside="open = false" class="bg-white rounded-lg w-full max-w-md p-6 shadow-md">
                                <h3 class="text-lg font-semibold text-center mb-4">Apply for {{ $job->title }}</h3>

                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('applicant.store', $job->id) }}">
                                    @csrf
                                    <x-inputs.text id="full_name" name="full_name" label="Full Name" placeholder="Full Name"
                                        :required="true" />
                                    <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone"
                                        placeholder="Contact Phone" />
                                    <x-inputs.text id="contact_email" name="contact_email" label="Contact Email"
                                        placeholder="Contact Email" :required="true" />
                                    <x-inputs.text-area id="message" name="message" label="Message" placeholder="Message"
                                        rows="3" cols="12" />
                                    <x-inputs.text id="location" name="location" label="Location" placeholder="Location" />
                                    <x-inputs.file id="resume" name="resume" label="Resume" :required="true" />

                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white rounded-md px-4 py-2">Apply
                                        Now</button>
                                    <button type="submit" @click="open = false"
                                        class="bg-gray-500 hover:bg-gray-600 text-white rounded-md px-4 py-2">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="my-5 bg-gray-200 rounded-xl px-5 py-3">
                        <i class="fas fa-info-circle mr-3"></i> You must be logged in to apply for this job.
                    </p>
                @endauth
                <!-- End Modal -->
            </div>

            {{-- Map --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div id="map"></div>
            </div>
        </section>


        <!-- Sidebar -->
        <aside class="bg-white rounded-lg shadow-md p-3">
            <h3 class="text-xl text-center mb-4 font-bold">
                Company Info
            </h3>
            @if ($job->company_logo)
                <img src="/storage/{{ $job->company_logo }}" alt="Ad" class="w-full rounded-lg mb-4 m-auto" />
            @endif
            <h4 class="text-lg font-bold">{{ $job->company_name }}</h4>
            @if ($job->company_description)
                <p class="text-gray-700 text-lg my-3">
                    {{ $job->company_description }}
                </p>
            @endif
            @if ($job->company_website)
                <a href={{ $job->company_website }} target="_blank" class="text-blue-500">Visit Website</a>
            @endif

            <!-- Bookmark Job Button -->
            @guest
                <p class="mt-8 bg-gray-200 text-gray-700 w-full font-bold text-center py-2 px-4 rounded-full">
                    <i class="fas fa-info-circle mr-3"></i>You must be logged in to bookmark a job.
                </p>
            @else
                <form method="POST"
                    action={{ auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists() ? route('bookmarks.destroy', $job->id) : route('bookmarks.store', $job->id) }}>
                    @csrf
                    @if (auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists())
                        @method('DELETE')
                        <button
                            class="w-full mt-4 py-2 bg-red-600 hover:bg-red-700 text-white px-4 rounded-full flex justify-center items-center">
                            <i class="fas fa-bookmark mr-3"></i>Delete Bookmark
                        </button>
                    @else
                        <button
                            class="w-full mt-4 py-2 bg-blue-600 hover:bg-blue-700 text-white px-4 rounded-full flex justify-center items-center">
                            <i class="fas fa-bookmark mr-3"></i>Bookmark Job
                        </button>
                    @endif
                </form>
            @endguest
        </aside>
    </div>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const map = L.map('map').setView([40, -74.5], 9);

        // Initialize the Leaflet map
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            zoom: 13,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Get address from Laravel view
        const city = '{{ $job->city }}';
        const state = '{{ $job->state }}';
        const address = city + ', ' + state;

        // Geocode the address
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    const latitude = parseFloat(data[0].lat);
                    const longitude = parseFloat(data[0].lon);

                    // Center the map and add a marker
                    map.setView([latitude, longitude], 14);

                    L.marker([latitude, longitude])
                        .addTo(map)
                        .bindPopup(`${city}, ${state}`)
                        .openPopup();
                } else {
                    console.error('No results found for the address.');
                }
            })
            .catch((error) => console.error('Error geocoding address:', error));
    });
</script>
