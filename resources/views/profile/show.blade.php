<x-app-layout>
    <x-slot name="header">
        <div class="text-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Profile of {{ $user->name }}
            </h2>
            @if($user->profile_photo)
            <!-- แสดงรูปโปรไฟล์ -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo"
                    class="w-32 h-32 object-cover rounded-full border-2 border-gray-300 shadow-lg">
            </div>
            @else
            <div class="flex justify-center mb-4">
                <div class="w-32 h-32 bg-gray-300 rounded-full"></div> <!-- Placeholder ถ้าไม่มีรูป -->
            </div>
            @endif

            <!-- ปุ่ม Edit Profile -->
            <div class="flex justify-center space-x-4">
                <a href="{{ route('profile.edit') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                    Edit Profile
                </a>
                <a href="{{ route('purchased-images') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                    View purchased photos
                </a>
            </div>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Uploaded Images</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- ปุ่ม + สำหรับการเพิ่มรูป -->
                        <div
                            class="flex justify-center items-center bg-white rounded-lg shadow-lg overflow-hidden relative group transition-transform transform hover:scale-105">
                            <a href="{{ route('images.create') }}"
                                class="flex items-center justify-center w-full h-48 bg-gray-100 text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </a>
                        </div>

                        @forelse($images as $image)
                        <div id="image-card-{{ $image->id }}"
                            class="bg-white rounded-lg shadow-lg overflow-hidden relative group transition-transform transform hover:scale-105">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}"
                                class="w-full h-48 object-cover mb-2"> <!-- ปรับให้เต็ม card -->

                            <div class="p-4">
                                <h4 class="font-semibold text-md mb-2">{{ $image->title }}</h4>
                            </div>

                            <!-- ไอคอน View และ Delete -->
                            <div
                                class="absolute inset-0 flex flex-col justify-center items-center opacity-0 group-hover:opacity-100 bg-gray-900 bg-opacity-50 transition-opacity">
                                <!-- ปุ่ม View Details -->
                                <a href="{{ route('images.show', $image->id) }}"
                                    class="inline-flex items-center justify-center w-10 h-10 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300 mb-2 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.5C6.75 4.5 3 12 3 12s3.75 7.5 9 7.5 9-7.5 9-7.5-3.75-7.5-9-7.5zM12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" />
                                    </svg>
                                </a>
                                @if (Auth::id() === $image->user_id)
                                <!-- ปุ่ม + -->
                                <a href="#"
                                    class="inline-flex items-center justify-center w-10 h-10 bg-green-500 text-white rounded-full shadow-lg hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-300 mb-2 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </a>
                                @endif

                                @if (Auth::id() === $image->user_id)
                                <!-- ปุ่ม Delete -->
                                <form action="{{ route('images.destroy', $image->id) }}" method="POST"
                                    class="inline-block delete-image-form" data-image-id="{{ $image->id }}"
                                    onsubmit="return confirm('Are you sure you want to delete this image?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-10 h-10 bg-red-500 text-white rounded-full shadow-lg hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500">{{ __('No images uploaded.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // เลือกฟอร์มทั้งหมดที่ใช้สำหรับการลบ
            const deleteForms = document.querySelectorAll('.delete-image-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // ป้องกันการ submit แบบปกติ

                    const imageId = this.getAttribute('data-image-id'); // ดึง ID ของภาพที่ต้องการลบ
                    const url = this.action; // URL สำหรับการส่งคำขอลบ
                    const formData = new FormData(this); // เตรียมข้อมูลจากฟอร์ม

                    // ส่งคำขอ AJAX
                    fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // ลบ card ของรูปภาพออกจากหน้า
                                document.getElementById('image-card-' + imageId).remove();
                            } else {
                                alert(data.error || 'Error deleting image');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</x-app-layout>