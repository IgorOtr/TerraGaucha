@include('Admin/includes/headTerraNews')

<section class="page">

    @include('Admin/includes/navbar')

    <div class="page-wrapper">

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h1>Terra News</h1>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h3>Use este espaço para gerenciar as notícias do Blog</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 add__location__form">
                <div class="row mb-3">
                    <div class="col-md-12 text-center">
                        <h2>Preecha o formulário para adicionar uma nova notícia</h2>
                    </div>
                </div>

                <form action="{{ route('add-location') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="news_title" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-3 mb-3">

                            <img width="600" id="imagePreview" src="" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <div class="form-label">Foto de capa</div>
                            <input id="imageUpload" onchange="previewImage()" class="file" type="file" name="news_capa" accept=".png, .jpg, .jpeg, .webp"
                                multiple required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Data de criação</label>
                            <input style="height: 40px; color: #b4b4b4;" type="text" class="form-control" name="news_date" value="{{ date('d/m/Y') }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col mb-3">
                            <label class="form-label">Conteúdo da notícia</label>
                            <div class="card" style="border: none !important;">
                                <textarea name="news_content" id="summernote"></textarea>
                            </div>
                        </div>
                    </div>

                    

                    <div class="row mb-3">
                        <div class="col mb-3">
                            <div class="form-label">Escolha um Status</div>
                            <select name="news_status" class="form-select" style="height: 40px;">
                                <option value="" selected>Selecione uma opção</option>
                                <option value="Coming soon">Coming soon</option>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <button type="submit" class="btn btn-primary w-100">Adicionar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   

    </div>

</section>
    
@include('Admin/includes/footerTerraNews')