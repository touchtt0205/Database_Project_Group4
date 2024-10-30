<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Upload Image') }}
        </h2>

        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Title -->
                            <div class="mb-4">
                                <label for="title" class="block text-gray-700">Title</label>
                                <input type="text" name="title" id="title" class="mt-1 block w-full" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="block text-gray-700">Description</label>
                                <textarea name="description" id="description" class="mt-1 block w-full"></textarea>
                            </div>

                            <!-- Free Image Checkbox (Checked by default) -->
                            <div class="mb-4">
                                <label for="free" class="inline-flex items-center">
                                    <input type="checkbox" name="free" id="free" class="form-checkbox" checked
                                        onchange="togglePriceFields(event)">
                                    <span class="ml-2">Free Image</span>
                                </label>
                            </div>

                            <!-- Price (Hidden initially) -->
                            <div class="mb-4" id="price-section" style="display: none;">
                                <label for="price" class="block text-gray-700">Price</label>
                                <input type="number" name="price" id="price" class="mt-1 block w-full">
                            </div>

                            <!-- Max Sales (Hidden initially) -->
                            <div class="mb-4" id="max-sales-section" style="display: none;">
                                <label for="max_sales" class="block text-gray-700">Max Sales (Leave blank for
                                    unlimited)</label>
                                <input type="number" name="max_sales" id="max_sales" class="mt-1 block w-full"
                                    placeholder="Unlimited if blank">
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="block text-gray-700">Image</label>
                                <input type="file" name="image" id="image" class="mt-1 block w-full" required
                                    onchange="previewImage(event)">
                            </div>

                            <!-- Image Preview Section -->
                            <div class="mb-4">
                                <label class="block text-gray-700">Image Preview</label>
                                <img id="imagePreview" class="mt-2" style="max-width: 300px; display: none;" />
                            </div>

                            <!-- Tag Selection -->
                            <div class="mb-4">
                                <label class="block text-gray-700">Tags</label>
                                @foreach($tags as $tag)
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->tags_id }}"
                                        class="form-checkbox">
                                    <span class="ml-2">{{ $tag->name }}</span>
                                </label>
                                @endforeach
                            </div>

                            <div>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Upload Image
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script to Preview Image and Toggle Price Fields -->
        <script>
            function previewImage(event) {
                const input = event.target;
                const reader = new FileReader();

                reader.onload = function() {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = reader.result;
                    imagePreview.style.display = 'block';
                };

                if (input.files && input.files[0]) {
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Toggle price and max sales fields based on free image checkbox
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

            // Initialize fields on page load (hide price and max sales if free is checked)
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