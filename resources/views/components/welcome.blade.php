<div style="background-color: #E0E0E0; padding: 20px;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link text-tab active border-0 fw-semibold px-lg-5 px-3" id="venta-tab" data-bs-toggle="tab" data-bs-target="#venta" type="button"
                role="tab" aria-controls="venta" aria-selected="true">Venta</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-tab border-0 fw-semibold px-lg-5 px-3" id="arriendo-tab" data-bs-toggle="tab" data-bs-target="#arriendo" type="button"
                role="tab" aria-controls="arriendo" aria-selected="false">Arriendo</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-tab border-0 fw-semibold px-lg-5 px-3" id="espera-tab" data-bs-toggle="tab" data-bs-target="#espera" type="button"
                role="tab" aria-controls="espera" aria-selected="false">Proximos en vencer</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="venta" role="tabpanel" aria-labelledby="venta-tab">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="{{route('inmuebles.show',[App\Models\Inmuebles::TIPO_OFERTA_VENTA,1])}}" class="stat-item"
                            style="text-decoration: none; color: inherit;">
                            <div class="stat-label">Inmuebles en venta publicados</div>
                            <div class="stat-number">{{ $inmueblesVentaActivos->count() }}</div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="{{route('inmuebles.show',[App\Models\Inmuebles::TIPO_OFERTA_VENTA,0])}}" class="stat-item eliminados"
                            style="text-decoration: none; color: inherit;">
                            <div class="stat-label">Inmuebles en venta eliminados</div>
                            <div class="stat-number">{{ $inmueblesVentaInactivos->count() }}</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="arriendo" role="tabpanel" aria-labelledby="arriendo-tab">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="{{route('inmuebles.show',[App\Models\Inmuebles::TIPO_OFERTA_ARRIENDO,1])}}" class="stat-item"
                            style="text-decoration: none; color: inherit;">
                            <div class="stat-label">Inmuebles en arriendo publicados</div>
                            <div class="stat-number">{{ $inmueblesArriendoActivos->count() }}</div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="{{route('inmuebles.show',[App\Models\Inmuebles::TIPO_OFERTA_ARRIENDO,0])}}" class="stat-item eliminados"
                            style="text-decoration: none; color: inherit;">
                            <div class="stat-label">Inmuebles en arriendo eliminados</div>
                            <div class="stat-number">{{ $inmueblesArriendoInactivos->count() }}</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="espera" role="tabpanel" aria-labelledby="espera-tab">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="{{route('inmuebles.vencidos')}}" class="stat-item"
                            style="text-decoration: none; color: inherit;">
                            <div class="stat-label">Inmuebles proximos a vencer</div>
                            <div class="stat-number">{{ $inmueblesAVencer->count() }}</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
