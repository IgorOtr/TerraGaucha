@include('Admin/includes/head')

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
                        {{request('success')}}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif


        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <h1>Promoções e Eventos</h1>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h3>Use este espaço para gerenciar as Promoções e Eventos do site</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 add__location__form">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <h2>Preecha o formulário para adicionar uma nova Promoção ou Evento</h2>
                        </div>
                    </div>
                    <form action="{{ route('add-promotion') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Título da Promoção / Evento <span style="color: red">*</span></label>
                                <input type="text" name="promo_title" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col mb-3">
                                <label class="form-label">Conteúdo da Promoção / Evento <span style="color: red">*</span></label>
                                <textarea class="form-control" name="promo_content" rows="6" placeholder="Escreva aqui sobre a Promoção / Evento:" required></textarea>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Sub-Conteúdo da Promoção / Evento</label>
                                <textarea class="form-control" name="promo_subcontent" rows="6" placeholder="Escreva aqui informações adicionais da Promoção / Evento:"></textarea>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Restrições da Promoção / Evento</label>
                                <textarea class="form-control" name="promo_restriction" rows="6" placeholder="Escreva aqui eestrições da Promoção / Evento:"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col mb-3">
                                <div class="form-label">Adicionar um botão?</div>
                                <select id="select_btn" onchange="unhideBtnRow()" class="form-select" style="height: 40px;">
                                    <option value="" selected>Selecione uma opção</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Nao">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 d-none" id="btn_row">
                            <div class="col mb-3">
                                <label class="form-label">Conteúdo do botão <span style="color: red">*</span></label>
                                <input type="text" name="promo_btn_title" class="form-control" >
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Link do botão <span style="color: red">*</span></label>
                                <input type="text" name="promo_btn_link" class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col mb-3">
                                <div class="form-label">Foto de capa <span style="color: red">*</span></div>
                                <input class="file" type="file" name="promo_capa" accept=".png, .jpg, .jpeg, .webp" required>
                            </div>
                            <div class="col mb-3">
                                <div class="form-label">Escolha um Status</div>
                                <select name="promo_status" class="form-select" style="height: 40px;">
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
                    </form>
                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="accordion" id="accordion-example">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-2">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-2"
                                            aria-expanded="false">
                                            Adicionar nova location
                                        </button>
                                    </h2>
                                    <div id="collapse-2" class="accordion-collapse collapse"
                                        data-bs-parent="#accordion-example">
                                        <div class="accordion-body pt-0">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="row mb-5 mt-5">
                <div class="col-md-12 text-center">
                    <h1>Todas as Promoções e Eventos</h1>
                </div>
            </div>

            <div class="row mb-3">
                @if (count($promotions) < 1)
                    <h3>Nenhuma promoção e/ou evento foi encontrado.</h3>
                @else

                    @foreach ($promotions as $promotion)

                        <div class="modal modal-blur fade" id="modal-large{{ $promotion->id }}" tabindex="-1" style="display: none;"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="color: #000000;" class="modal-title">Tem certeza que deseja apagar a Location de {{ $promotion->promo_title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Se concordar, todos os dados serão apagador permanentamente.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="" class="btn btn-danger">Apagar</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">{{ $location->loc_name }}</h2>
                                    <div class="card-actions">
                                        <a href="/Admin/Locations/edit/{{ $location->slug }}" class="btn btn-warning">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                            Editar
                                        </a>

                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-large{{ $location->id }}">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                    </div>
                                </div>
                                <div class="card-body"
                                    style="
                                        background-image: url({{ asset('assets/img/capas_locations/' . $location->loc_capa) }});
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        padding: 120px; !important">
                                </div>
                            </div>
                        </div> --}}

                    @endforeach
                    
                @endif

            </div>
        </div>
    </div>

    {{-- Desenvolva a partir daqui --}}
</section>

<script>
    var select_btn = document.getElementById('select_btn');
    var btn_row = document.getElementById('btn_row');

    function unhideBtnRow()
    {
        if (select_btn.value == 'Sim') {

            btn_row.classList.remove('d-none');
            btn_row.classList.add('d-flex');

        }else if (select_btn.value == 'Nao' || select_btn.value == ''){

            btn_row.classList.remove('d-flex');
            btn_row.classList.add('d-none');
        }
        
    }
    
</script>


@include('Admin/includes/footer')
