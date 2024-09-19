@include('Admin/includes/headTerraNews')

<section class="page">

    @include('Admin/includes/navbar')

    <div class="page-wrapper">

        @if (request('success'))
            <div class="alert alert-success alert-dismissible mb-5" role="alert">
                <div class="d-flex">
                    <div>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon alert-icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>
                        {{ request('success') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <h1>Terra News</h1>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h3>Use este espaço para alterar os dados da Notícia: "{{ $news[0]->news_title }}"</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 add__location__form">
                    <form action="{{ route('update-news') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $news[0]->id }}">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" name="news_title" class="form-control" value="{{ $news[0]->news_title }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-3 mb-3">
                                <div class="form-label">Foto utilizada atualmente</div>
                                <img width="600" id="imagePreview" src="{{ asset('assets/img/capas_news/'.$news[0]->news_capa) }}" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <div class="form-label">Foto de capa</div>
                                <input id="imageUpload" onchange="previewImage()" class="file" type="file"
                                    name="news_capa" accept=".png, .jpg, .jpeg, .webp">
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Data de criação</label>
                                <input style="height: 40px; color: #b4b4b4;" type="text" class="form-control"
                                    name="news_date" value="{{ $news[0]->news_date }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col mb-3">
                                <label class="form-label">Conteúdo da notícia</label>
                                <div class="card" style="border: none !important;">
                                    <textarea name="news_content" id="summernote">{{ $news[0]->news_content }}</textarea>
                                </div>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <div class="col mb-3">
                                <div class="form-label">Escolha um Status</div>
                                <select name="news_status" class="form-select" style="height: 40px;">
                                    <option value="{{ $news[0]->news_status }}" selected>{{ $news[0]->news_status }}</option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <button type="submit" class="btn btn-primary w-100">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

</section>

@include('Admin/includes/footerTerraNews')
