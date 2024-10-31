<x-app-layout>
    <x-slot name="header">
        <h2 class="font-normal tracking-wide text-[26px] text-gray-200 leading-tight text-center mb-5">
            {{ __('Upload Image') }}
        </h2>
        <hr></hr>

        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg min-h-[550px]">
                    <div class="p-6 text-gray-900">
                    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="flex flex-col sm:flex-row">

                            <!-- Left Column: Image Selection and Display -->
                            <div class="w-full sm:w-1/2 p-4 flex flex-col items-center justify-center">
                                <!-- Image Upload Input and Placeholder -->
                                <div class="relative w-64 h-64 flex items-center justify-center border-2 border-dashed rounded-lg overflow-hidden cursor-pointer" onclick="document.getElementById('image').click()">
                                    <input type="file" name="image" id="image" class="absolute inset-0 opacity-0 cursor-pointer" required
                                        onchange="handleImageSelect(event)">
                                    <span id="placeholderText" class="text-gray-400">Choose Image</span>
                                    <img id="selectedImage" class="absolute inset-0 w-full h-full object-cover" style="display: none;" />
                                </div>
                                <!-- Image Source Info -->
                                <div class="mt-2">
                                    <p id="imageSource" class="text-gray-300 text-sm"></p>
                                </div>
                            </div>

                            <!-- Right Column: Form -->
                            <div class="w-full sm:w-1/2 p-4">
                                    <!-- Title -->
                                    <div class="mb-4">
                                        <label for="title" class="block text-gray-100">Title</label>
                                        <input type="text" name="title" id="title" class="mt-1 block w-full sm:rounded-lg text-gray-500 text-normal" placeholder="Enter title..." required>
                                    </div>
                                    <!-- Description -->
                                    <div class="mb-4">
                                        <label for="description" class="block text-gray-100">Description</label>
                                        <textarea name="description" id="description" class="mt-1 block w-full sm:rounded-lg min-h-[40px] text-gray-500 text-normal" placeholder="Enter description..."></textarea>
                                    </div>
                                    <!-- Free Image Checkbox (Checked by default) -->
                                    <div class="mb-4">
                                        <label for="free" class="inline-flex items-center">
                                            <input type="checkbox" name="free" id="free" class="form-checkbox sm:rounded-lg" checked
                                                onchange="togglePriceFields(event)">
                                            <span class="ml-2 text-gray-400">Free Image</span>
                                        </label>
                                    </div>

                                    <!-- Price (Hidden initially) -->
                                <div class="mb-4" id="price-section" style="display: none;">
                                    <label for="price" class="block  text-gray-100">Price</label>
                                    <input type="number" name="price" id="price" class="mt-1 block w-full sm:rounded-lg  text-gray-500 text-normal" placeholder="Enter price...">
                                </div>

                                <!-- Max Sales (Hidden initially) -->
                                <div class="mb-4" id="max-sales-section" style="display: none;">
                                    <label for="max_sales" class="block  text-gray-100">Max Sales (Leave blank for unlimited)</label>
                                    <input type="number" name="max_sales" id="max_sales" class="mt-1 block w-full sm:rounded-lg  text-gray-500 text-normal"
                                        placeholder="Unlimited if blank">
                                </div>

                                <!-- Tag Selection -->
                                <div class="mb-4">
                                    <label class="block text-gray-100">Tags</label>
                                    @foreach($tags as $tag)
                                    <label class="inline-flex items-center mr-4">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->tags_id }}" class="form-checkbox sm:rounded-lg">
                                        <span class="ml-2 text-gray-400">{{ $tag->name }}</span>
                                    </label>
                                    @endforeach
                                </div>

                                <!-- Upload Button at the Bottom Right -->
                                <div class="flex justify-end mt-4">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Upload Image
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script to Handle Image Selection and Toggle Price Fields -->
        <script>
            function handleImageSelect(event) {
                const input = event.target;
                const reader = new FileReader();

                reader.onload = function() {
                    const selectedImage = document.getElementById('selectedImage');
                    const placeholderText = document.getElementById('placeholderText');
                    const imageSource = document.getElementById('imageSource');

                    // Display the image in place of "Choose Image" text
                    selectedImage.src = reader.result;
                    selectedImage.style.display = 'block';
                    placeholderText.style.display = 'none';

                    // Display the file name under the image
                    imageSource.textContent = input.files[0] ? 'Source: ' + input.files[0].name : '';
                };

                if (input.files && input.files[0]) {
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function togglePriceFields(event) {
                const isFree = event.target.checked;
                const priceSection = document.getElementById('price-section');
                const maxSalesSection = document.getElementById('max-sales-section');
                const priceInput = document.getElementById('price');
                const maxSalesInput = document.getElementById('max_sales');

                if (isFree) {
                    priceSection.style.display = 'none';
                    maxSalesSection.style.display = 'none';
                    priceInput.removeAttribute('required');
                    maxSalesInput.removeAttribute('required');
                    priceInput.value = '';
                    maxSalesInput.value = '';
                } else {
                    priceSection.style.display = 'block';
                    maxSalesSection.style.display = 'block';
                    priceInput.setAttribute('required', 'required');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                togglePriceFields({
                    target: {
                        checked: true
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
