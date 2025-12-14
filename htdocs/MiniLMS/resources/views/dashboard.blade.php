<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Welcome to Mini-LMS, {{ session('username', Auth::user()->name) }}!</h3>
                    <p class="text-gray-600">Manage your courses, faculty members, and students all in one place.</p>
                </div>
            </div>

            <!-- Session Information Display -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-indigo-200">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-indigo-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Session Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Login Counter -->
                        <div class="bg-white rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 font-medium">Login Counter</p>
                            <p class="text-2xl font-bold text-indigo-600">{{ session('login_counter', 0) }}</p>
                            <p class="text-xs text-gray-500 mt-1">Total logins this session</p>
                        </div>

                        <!-- Last Login Time -->
                        <div class="bg-white rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 font-medium">Last Login Time</p>
                            <p class="text-lg font-bold text-green-600">{{ session('last_login_time', 'N/A') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Most recent login</p>
                        </div>

                        <!-- Username -->
                        <div class="bg-white rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 font-medium">Username</p>
                            <p class="text-lg font-bold text-purple-600">{{ session('username', 'Guest') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Logged in user</p>
                        </div>

                        <!-- Role -->
                        <div class="bg-white rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 font-medium">Role</p>
                            <p class="text-lg font-bold text-orange-600">{{ session('role', 'User') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Account type</p>
                        </div>

                        <!-- Email -->
                        <div class="bg-white rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 font-medium">Email</p>
                            <p class="text-sm font-bold text-blue-600">{{ session('user_email', Auth::user()->email) }}</p>
                            <p class="text-xs text-gray-500 mt-1">Contact email</p>
                        </div>

                        <!-- User ID -->
                        <div class="bg-white rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 font-medium">User ID</p>
                            <p class="text-2xl font-bold text-red-600">{{ session('user_id', Auth::id()) }}</p>
                            <p class="text-xs text-gray-500 mt-1">System identifier</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JSON Data Display (Decoded) -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-green-200">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-green-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Academic Data (Decoded from JSON)
                    </h3>

                    @php
                        // Retrieve JSON from session and decode it
                        $jsonData = session('academic_data_json', '{}');
                        $decodedData = json_decode($jsonData, true);
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Course -->
                        <div class="bg-white rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 font-medium">Course</p>
                            <p class="text-lg font-bold text-green-600">{{ $decodedData['course'] ?? 'Not Available' }}</p>
                            <p class="text-xs text-gray-500 mt-1">Current program</p>
                        </div>

                        <!-- Semester -->
                        <div class="bg-white rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 font-medium">Semester</p>
                            <p class="text-lg font-bold text-blue-600">{{ $decodedData['semester'] ?? 'Not Available' }}</p>
                            <p class="text-xs text-gray-500 mt-1">Current semester</p>
                        </div>

                        <!-- Year -->
                        <div class="bg-white rounded-lg p-4 shadow">
                            <p class="text-sm text-gray-600 font-medium">Academic Year</p>
                            <p class="text-lg font-bold text-purple-600">{{ $decodedData['year'] ?? 'Not Available' }}</p>
                            <p class="text-xs text-gray-500 mt-1">Current year</p>
                        </div>
                    </div>

                    <!-- Raw JSON Display -->
                    <div class="mt-4 bg-gray-800 rounded-lg p-4">
                        <p class="text-xs text-white-400 mb-2">Raw JSON Data:</p>
                        <pre class="text-white-400 text-sm overflow-x-auto">{{ $jsonData }}</pre>
                    </div>
                </div>
            </div>

            <!-- Management Modules Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Course Management Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Course Management</h3>
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">Create and manage courses with titles, codes, credits, and descriptions.</p>
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                            Manage Courses
                        </a>
                    </div>
                </div>

                <!-- Faculty Management Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Faculty Management</h3>
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">Add and manage faculty members with their contact details and departments.</p>
                        <a href="{{ route('faculties.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                            Manage Faculty
                        </a>
                    </div>
                </div>

                <!-- Student Management Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Student Management</h3>
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">Manage student records including roll numbers, programs, and contact information.</p>
                        <a href="{{ route('students.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150">
                            Manage Students
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>