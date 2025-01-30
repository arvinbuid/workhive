<x-layout>
    <section class="flex flex-col md:flex-row gap-4">
        {{-- Profile Info Form --}}
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">
                Profile Info
            </h3>

            @if ($user->avatar)
                <div class="flex justify-center mt-4">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                        class="w-28 h-28 object-cover rounded-full">
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-inputs.text id="name" name="name" label="Name" value="{{ $user->name }}" />
                <x-inputs.text id="email" name="email" label="Email address" type="email"
                    value="{{ $user->email }}" />

                <x-inputs.file id="avatar" name="avatar" label="Upload Avatar" />

                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 border rounded focus:outline-none">Save</button>
            </form>
        </div>


        {{-- Job Listings --}}
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">My Job Listings</h3>
            @forelse($jobs as $job)
                <div class="flex justify-between items-center border-gray-200 border-b-2 py-2">
                    <div>
                        <h3 class="text-xl font-semibold mt-4">{{ $job->title }}</h3>
                        <p class="text-gray-700">{{ $job->job_type }}</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href={{ route('jobs.edit', $job->id) }}
                            class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>

                        <!-- Delete Form -->
                        <form method="POST" action="{{ route('jobs.destroy', $job->id) }}?from=dashboard"
                            onsubmit="return confirm('Are you sure you want to delete this job?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                Delete
                            </button>
                        </form>
                        <!-- End Delete Form -->
                    </div>
                </div>

                {{-- Job Applications --}}
                <div class="mt-4">
                    @forelse ($job->applicants as $applicant)
                        <h3 class="text-lg font-semibold mb-3">Applicant </h3>
                        <div class="my-3">
                            <p class="text-gray-800"><strong>Name: </strong> {{ $applicant->full_name }}</p>
                            <p class="text-gray-800"><strong>Contact Number: </strong> {{ $applicant->contact_phone }}
                            </p>
                            <p class="text-gray-800"><strong>Email: </strong> {{ $applicant->contact_email }}</p>
                            <p class="mt-3 mb-6">
                                <a href={{ asset('storage/' . $applicant->resume_path) }}
                                    class="text-blue-600 hover:underline" download><i
                                        class="fas fa-download mr-2"></i>Download
                                    resume</a>
                            </p>
                        </div>

                    @empty
                        <p class="text-xl">There is no job application for this job listing.</p>
                    @endforelse
                </div>



            @empty
                <p class="text-xl">You have no job listings.</p>
            @endforelse
        </div>
    </section>
    <x-bottom-banner />
</x-layout>
