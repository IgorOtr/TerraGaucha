@include('Admin/includes/head')

<section class="page">
    @include('Admin/includes/navbar')

    <div class="page-wrapper">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <h1>Promoções e Eventos</h1>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h3>Use este espaço para alterar as Promoções e Eventos do site</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 add__location__form">
                    <form action="{{ route('update-promotion') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $promotions[0]->id }}">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Título da Promoção / Evento <span style="color: red">*</span></label>
                                <input type="text" name="promo_title" class="form-control" value="{{ $promotions[0]->promo_title }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col mb-3">
                                <label class="form-label">Conteúdo da Promoção / Evento <span style="color: red">*</span></label>
                                <textarea class="form-control" name="promo_content" rows="6" placeholder="Escreva aqui sobre a Promoção / Evento:" required>{{ $promotions[0]->promo_content }}</textarea>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Sub-Conteúdo da Promoção / Evento</label>
                                <textarea class="form-control" name="promo_subcontent" rows="6" placeholder="Escreva aqui informações adicionais da Promoção / Evento:">{{ $promotions[0]->promo_subcontent }}</textarea>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Restrições da Promoção / Evento</label>
                                <textarea class="form-control" name="promo_restriction" rows="6" placeholder="Escreva aqui eestrições da Promoção / Evento:">{{ $promotions[0]->promo_restriction }}</textarea>
                            </div>
                        </div>

                        @if (!empty($promotions[0]->promo_btn_title))

                            <div class="row mb-3">
                                <div class="col mb-3">
                                    <label class="form-label">Conteúdo do botão <span style="color: red">*</span></label>
                                    <input type="text" name="promo_btn_title" class="form-control" value="{{ $promotions[0]->promo_btn_title }}">
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Link do botão <span style="color: red">*</span></label>
                                    <input type="text" name="promo_btn_link" class="form-control" value="{{ $promotions[0]->promo_btn_link }}">
                                </div>
                            </div>

                        @else

                            <div class="edit_btn">
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
                            </div>
                            
                        @endif

                        <div class="row">
                            <div class="col mt-3 mb-3">
                                <div class="form-label">Foto utilizada atualmente</div>
                                <img width="150" id="imagePreview" src="{{ asset('assets/img/capas_promo/'.$promotions[0]->promo_capa) }}" alt="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col mb-3">
                                <div class="form-label">Atualizar foto de capa <span style="color: red">*</span></div>
                                <input class="file" type="file" name="promo_capa" id="imageUpload" onchange="previewImage()"  accept=".png, .jpg, .jpeg, .webp">
                            </div>
                            <div class="col mb-3">
                                <div class="form-label">Escolha um Status</div>
                                <select name="promo_status" class="form-select" style="height: 40px;">
                                    <option value="{{ $promotions[0]->promo_status }}" selected>{{ $promotions[0]->promo_status }}</option>
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

    function previewImage() 
    {
        const input = document.getElementById('imageUpload');
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = (e) => {
            preview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    
</script>


@include('Admin/includes/footer')
