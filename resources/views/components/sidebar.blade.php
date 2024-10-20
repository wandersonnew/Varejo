
<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Menu</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="/" class="nav-link align-middle px-0 text-white">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>
            <li>
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle  text-white">
                    <i class="fs-4 bi bi-person-vcard"></i> <span class="ms-1 d-none d-sm-inline">Clientes</span> </a>
                <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ url('/customers') }}" class="nav-link px-0 text-white">Cadastrar cliente</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle  text-white">
                    <i class="fs-4 bi bi-table"></i> <span class="ms-1 d-none d-sm-inline">Vendas</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ url('/sales') }}" class="nav-link px-0 text-white">Efetuar venda</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ url('products') }}" class="nav-link px-0 text-white">Produtos</a>
                    </li>
                </ul>
            </li>
        </ul>
        
    </div>
</div>