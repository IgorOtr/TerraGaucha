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

                    <form action="{{ route('add-news') }}" method="POST" enctype="multipart/form-data">
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
                                <input id="imageUpload" onchange="previewImage()" class="file" type="file"
                                    name="news_capa" accept=".png, .jpg, .jpeg, .webp" multiple required>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Data de criação</label>
                                <input style="height: 40px; color: #b4b4b4;" type="text" class="form-control"
                                    name="news_date" value="{{ date('d/m/Y') }}" readonly>
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

                        <div class="row mb-5 mt-5">
                            <div class="col-md-12 text-center">
                                <h1>Todas as Notícias</h1>
                            </div>
                        </div>

                        <div class="row mb-3">
                            @if (count($news) < 1)
                                <h3>Nenhuma notícia foi encontrada.</h3>
                            @else
                                @foreach ($news as $new)
                                    <div class="modal modal-blur fade" id="modal-large{{ $new->id }}"
                                        tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="color: #000000;" class="modal-title">Tem certeza que
                                                        deseja apagar esta notícia: {{ $new->news_title }}?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Se concordar, todos os dados serão apagador permanentamente.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn me-auto"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="/Admin/TerraNews/delete/{{ $new->news_slug }}"
                                                        class="btn btn-danger">Apagar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-status-start"></div>
                                            <div class="card-body">
                                                <h3 class="card-title" style="color: #272727;">{{ $new->news_title }}
                                                </h3>
                                                <p class="text-secondary">
                                                    {{ substr(strip_tags($new->news_content), 0, 180) }}...</p>
                                            </div>
                                            <div class="card-footer">
                                                <a href="/Admin/TerraNews/edit/{{ $new->news_slug }}"
                                                    class="btn btn-warning">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                    Editar
                                                </a>

                                                <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modal-large{{ $new->id }}">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                    Deletar
                                                </a>
                                                <a href="#" class="btn btn-secondary">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                    Visualizar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

</section>

@include('Admin/includes/footerTerraNews')
