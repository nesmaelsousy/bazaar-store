@push('css')
<style>
    .page-icon {
        padding: 8px 14px;
        border-radius: 8px;
        background-color: #f3e6dc;
        border: 1px solid #A0522D;
        color: #A0522D;
        font-size: 1.1rem;
    }

    .page-title {
        color: #A0522D;
        font-size: 1.4rem;
        font-weight: 700;
        margin-left: 5px;
    }

    .page-subtitle {
        color: #9e7b6b;
        font-size: 0.88rem;
        margin-top: 2px;
    }

    .form-divider {
        border: none;
        border-top: 1px solid #f0e6de;
        margin: 1.5rem 0;
    }

    .section-title {
        font-size: 0.72rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #c49a80;
        margin-bottom: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #f0e6de;
    }

    .section-block {
        margin-bottom: 2rem;
    }

    .form-label {
        font-size: 1rem;
        font-weight: 600;
        color: #7a5c4e;
        margin-bottom: 5px;
    }


    /* .required-star {
                                color: #d9534f;
                                font-size: 0.7rem;
                            } */
    .show-img {
        height: 200px;
        width: 200px;
        border: 2px dashed #ccc;
        overflow: hidden;

    }

    .form-control {
        padding: 20px;
    }

    .form-control,
    .form-select {
        background-color: #fdf7f4;
        border: 1px solid #e2cdc2;
        border-radius: 8px;
        font-size: 0.87rem;
        color: #4a3328;
        padding: 0.55rem 0.85rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #A0522D;
        box-shadow: 0 0 0 3px rgba(160, 82, 45, 0.12);
        background-color: #fff;
        outline: none;
    }

    .form-control::placeholder {
        color: #b89080;
    }

    .field-hint {
        font-size: 0.72rem;
        color: #b89080;
        margin-top: 4px;
    }

    .id-field {
        background-color: #f9f1ec;
        border: 1px dashed #e2cdc2;
        border-radius: 8px;
        padding: 0.55rem 0.85rem;
        font-size: 0.82rem;
        color: #c4a898;
        font-family: monospace;
    }

    /* Toggle buttons */
    .toggle-group {
        display: flex;
        gap: 8px;
    }

    .toggle-btn {
        flex: 1;
        padding: 0.5rem;
        border-radius: 8px;
        border: 1px solid #e2cdc2;
        background: #fdf7f4;
        color: #9e7b6b;
        font-size: 0.83rem;
        font-weight: 500;
        cursor: pointer;
        text-align: center;
        transition: all 0.15s;
        category-select: none;
    }

    .toggle-btn.active-green {
        background: #eaf7f0;
        border-color: #3ecf8e;
        color: #1f9e65;
    }

    .toggle-btn.active-danger {
        background: #fff8ec;
        border-color: #f00505;
        color: #b91a1a;
    }

    .toggle-btn.active-brown {
        background: #f3e6dc;
        border-color: #A0522D;
        color: #A0522D;
    }

    /* Image upload */
    .img-upload-row {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .img-preview {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #f3e6dc;
        border: 2px dashed #e2cdc2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        overflow: hidden;
        color: #c4a898;
    }

    .img-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    /* Timestamps */
    .ts-chip {
        background: #f9f1ec;
        border: 1px dashed #e2cdc2;
        border-radius: 8px;
        padding: 0.5rem 0.85rem;
        font-size: 0.78rem;
        color: #b89080;
        font-family: monospace;
    }

    .ts-chip .ts-label {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        color: #c4a898;
        display: block;
        margin-bottom: 2px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Actions */
    .btn-save {
        background-color: #A0522D;
        color: #fff;
        border: none;
        padding: 0.55rem 1.75rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: background 0.2s ease, transform 0.15s ease;
        cursor: pointer;
    }

    .btn-save:hover {
        background-color: #8B4513;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background-color: #f3e6dc;
        color: #A0522D;
        border: 1px solid #A0522D;
        padding: 0.55rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: background 0.2s ease;
    }

    .btn-cancel:hover {
        background-color: #e8d5c8;
        color: #8B4513;
    }
</style>
@endpush
{{-- Profile Image --}}
<div class="section-block">
    <div class="section-title">category Image</div>

    <div class="d-flex align-items-start gap-3">

        {{-- الصورة --}}
        <div class="img-wrapper">
            <div class="show-img ">
                <img src="{{optional($category)->image ? Storage::url($category->image) :
                 asset('backend/image/image-placeholder.png') }}" style="width: 100%; height: 100%; object-fit: cover;" alt="">
            </div>

            <input id="image-input" type="file" name="image" class="d-none" accept="image/*">
        </div>

        {{-- الحقول --}}
        <div class="row g-3 flex-1 ml-5">
            <div class="col-md-6">
                <x-form.input label="Category Name" name="name" type="text" placeholder="e.g."
                    :oldVal="old('name', $category->name ?? '')" />
            </div>

            <div class="mb-3 form-group">

                <label for="" class="form-label">Category Parent</label>
                <select name="parent_id" class="form-control  @error('parent_id') is-invalid @enderror">
                    <option value="">Primary Category</option>
                    @foreach($categories as $parent)
                    @if(!isset($category->id) || $parent->id != $category->id)
                    <option value="{{ $parent->id }}"
                        @selected(old('parent_id', $category->parent_id) == $parent->id)>
                        {{ $parent->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
                @error('parent_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <x-form.textarea label="Description" name="description" placeholder=""
                    :oldVal="old('description', $category->description ?? '')" />
            </div>
        </div>

    </div>
</div>

{{-- Status & Role --}}
<div class="section-block">
    <div class="section-title">Status</div>

    <div class="row g-3">

        <div class="col-md-6">
            <label class="form-label">Category Status</label>

            <input type="hidden" name="status" id="statusVal"
                value="{{ old('status', $category->status ?? 'active') }}" />

            <div class="toggle-group">
                <div class="toggle-btn {{ old('status', $category->status ?? 'active') == 'active' ? 'active-green' : '' }}"
                    onclick="pick(this,'status','active')">
                    Active
                </div>

                <div class="toggle-btn {{ old('status', $category->status ?? 'active') == 'archived' ? 'active-green' : '' }}"
                    onclick="pick(this,'status','archived')">
                    archived
                </div>
            </div>

            <div class="field-hint">Default: Active</div>
        </div>
    </div>
</div>

{{-- Actions --}}
<hr class="form-divider">

<div class="d-flex align-items-center gap-2 mt-3">
    <button type="submit" class="btn-save">
        <i class="fas fa-save me-1"></i> Save
    </button>

    <a href="{{ route('admin.category.index') }}" class="btn-cancel ml-3">
        Cancel
    </a>
</div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const imgWrapper = document.querySelector('.show-img');
        const input = document.getElementById('image-input');
        const img = imgWrapper.querySelector('img');

        // فتح اختيار الصورة عند الضغط على الصورة
        imgWrapper.addEventListener('click', function() {
            input.click();
        });

        // تغيير الصورة عند الاختيار
        input.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result; // استبدال الصورة
                };

                reader.readAsDataURL(file);
            }
        });

    });
</script>
@endpush