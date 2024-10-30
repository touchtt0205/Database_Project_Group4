<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Main Flex Container -->
                        <div class="flex space-x-8">
                            <!-- Image Upload & Preview (Left Column) -->
                            <div class="flex flex-col items-center">
                                <!-- Centered Image Upload with Preview -->
                                <div class="mb-4 flex justify-center items-center border border-dashed border-gray-300 rounded-lg" style="width: 300px; height: 300px;">
                                    <label for="image" class="block text-center w-full h-full flex justify-center items-center cursor-pointer">
                                        <input type="file" name="image" id="image" class="hidden" required onchange="previewImage(event)">
                                        <img id="imagePreview" class="max-w-full max-h-full" style="display: none; object-fit: contain;" />
                                        <span id="chooseText" class="text-gray-500">Choose File</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Form Fields (Right Column) -->
                            <div class="flex-grow">
                                <!-- Title -->
                                <div class="mb-4">
                                    <label for="title" class="block text-gray-100">Title</label>
                                    <input type="text" name="title" id="title" class="mt-1 block w-full sm:rounded-lg input-lightblue" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-100">Description</label>
                                    <textarea name="description" id="description" class="mt-1 block w-full sm:rounded-lg"></textarea>
                                </div>

                                <!-- Free Image Checkbox (Checked by default) -->
                                <div class="mb-4">
                                    <label for="free" class="inline-flex items-center">
                                        <input type="checkbox" name="free" id="free" class="form-checkbox sm:rounded-lg" checked onchange="togglePriceFields(event)">
                                        <span class="ml-2">Free Image</span>
                                    </label>
                                </div>

                                <!-- Price (Hidden initially) -->
                                <div class="mb-4" id="price-section" style="display: none;">
                                    <label for="price" class="block dark:text-gray-100">Price</label>
                                    <input type="number" name="price" id="price" class="mt-1 block w-full sm:rounded-lg input-lightblue">
                                </div>

                                <!-- Max Sales (Hidden initially) -->
                                <div class="mb-4" id="max-sales-section" style="display: none;">
                                    <label for="max_sales" class="block dark:text-gray-100">Max Sales (Leave blank for unlimited)</label>
                                    <input type="number" name="max_sales" id="max_sales" class="mt-1 block w-full sm:rounded-lg input-lightblue" placeholder="Unlimited if blank">
                                </div>


                                <!-- Tag Selection -->
                                <div class="mb-4">
                                    <label class="block dark:text-gray-100">Tags</label>
                                    @foreach($tags as $tag)
                                    <label class="inline-flex items-center mr-4">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->tags_id }}" class="form-checkbox">
                                        <span class="ml-2">{{ $tag->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Upload Button aligned to the right -->
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

    <!-- Script to Preview Image and Hide Choose File Text -->
    <script>
    function previewImage(event) {
        const input = event.target;
        const imagePreview = document.getElementById('imagePreview');
        const chooseText = document.getElementById('chooseText');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show the image
                chooseText.style.display = 'none'; // Hide the "Choose File" text
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>

    <!-- Script to Toggle Price Fields -->
    <script>
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
</x-app-layout>

<style>
    /* Set dark blue color for cursor and typed text */
    .input-lightblue, textarea {
        caret-color: #1E3A8A; /* Dark blue color for the cursor */
        color: #1E3A8A; /* Dark blue color for the text */
    }
</style>
