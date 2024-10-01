@include('Admin/includes/head')

<section class="page">
    @include('Admin/includes/navbar')

    <div class="page-wrapper">

        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <h1>Contacts</h1>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h3>Use este espaço para gerenciar os Contatos dos formulários do site</h3>
                </div>
            </div>
            <div class="row w-100">
                <div class="col-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr class="table-bg">
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Formulário</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-lines">
                                        <td>Maryjo Lebarree</td>
                                        <td class="text-secondary"><a href="#"
                                            class="text-reset">mlebarree5@unc.edu</a></td>
                                        <td class="text-secondary">
                                            24981402661
                                        </td>
                                        <td class="text-secondary">
                                            Contato
                                        </td>
                                    </tr>
                                    <tr class="table-lines">
                                        <td>Maryjo Lebarree</td>
                                        <td class="text-secondary"><a href="#"
                                            class="text-reset">mlebarree5@unc.edu</a></td>
                                        <td class="text-secondary">
                                            24981402661
                                        </td>
                                        <td class="text-secondary">
                                            Contato
                                        </td>
                                    </tr>
                                    <tr class="table-lines">
                                        <td>Maryjo Lebarree</td>
                                        <td class="text-secondary"><a href="#"
                                            class="text-reset">mlebarree5@unc.edu</a></td>
                                        <td class="text-secondary">
                                            24981402661
                                        </td>
                                        <td class="text-secondary">
                                            Contato
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Desenvolva a partir daqui --}}
</section>


@include('Admin/includes/footer')
