<section id="basic-horizontal-layouts">
    <div class="row match-height">
        @livewire('logs.form')
        <div class="col-md-9 col-12">
            <div class="card" style="height: 500px">
                <div class="card-header">
                    <h4 class="card-title">Лог</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        @livewire('logs.table')
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic Horizontal form layout section end -->
