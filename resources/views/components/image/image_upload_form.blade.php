<div>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Загрузите изображения</h1>
                <div class="container">
                        <form enctype="multipart/form-data" action="{{ route('image.store') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="formFileLg" class="form-label">Вы можете одновременно загрузить 5 изображений</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg" type="file" id="fileInput" name="images[]" multiple accept="image/*,image/jpeg">
                                </div>
                                <div class="col-3">
                                    <input class="btn btn-primary w-100 h-100" type="submit" value="Загрузить">
                                </div>
                            </div>
                        </form>
                    <div id="imagePreview" class="d-flex flex-wrap justify-content-start"></div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    #imagePreview {
        display: flex;
        flex-wrap: wrap;
    }

    #imagePreview img {
        max-width: 150px;
        height: auto;
        margin: 5px;
    }
</style>

<script>
    const fileInput = document.getElementById('fileInput');
    const imagePreview = document.getElementById('imagePreview');

    fileInput.addEventListener('change', function() {
        imagePreview.innerHTML = '';

        Array.from(fileInput.files).forEach(file => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = document.createElement('img');
                image.src = e.target.result;
                imagePreview.appendChild(image);
            }

            reader.readAsDataURL(file);
        });
    });
</script>
