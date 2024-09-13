@include('Admin/includes/head')

<section class="page">
    @include('Admin/includes/navbar')

    <div class="page-wrapper">


        @if (isset($message))
          <div class="alert alert-success alert-dismissible" role="alert">
            <div class="d-flex">
              <div>
                <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
              </div>
              <div>
                Nova Location adicionada com sucesso!
              </div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
          </div>
        @endif

        
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <h1>Locations</h1>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h3>Use este espaço para gerenciar as Locations do site</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 add__location__form">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <h2>Preecha o formulário para adicionar uma nova Location</h2>
                        </div>
                    </div>
                    <form action="{{ route('add-location') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col m-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="loc_name" class="form-control" required>
                            </div>
                            <div class="col m-3">
                                <label class="form-label">Telefone</label>
                                <input type="text" name="loc_phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m-3">
                                <label class="form-label">Endereço</label>
                                <input type="text" name="loc_address" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col m-3">
                                <label class="form-label">Sobre o Local</label>
                                <textarea class="form-control" name="loc_resume" rows="6" placeholder="Escreva aqui sobre o Local:" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col mb-3">
                                <div class="form-label">Adicione fotos do local <span style="font-size: 12px">(max: 6 imagens)</span></div>
                                <input class="file" type="file" name="loc_images[]" multiple required>
                            </div>
                            <div class="col mb-3">
                                <div class="form-label">Escolha um Status</div>
                                <select name="loc_status" class="form-select" style="height: 40px;">
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
        </div>
    </div>

    {{-- Desenvolva a partir daqui --}}
</section>


@include('Admin/includes/footer')
