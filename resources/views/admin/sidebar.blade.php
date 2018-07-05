<div class="col-md-3">
@if(Auth::check() && Auth::user()->hasRole('admin')) {
    <div class="card">
        <div class="card-header">
            User Menu
        </div>

        <div class="card-body">
            <ul class="nav flex-column" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/users">
                        Users
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/roles">
                        Roles
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/permissions">
                    Permissions
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
    <br/>
   
@endif

    
    

    <div class="card">
        <div class="card-header">Module</div>
    

        <div class="card-body">
            <ul class="nav flex-column" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/jenis-order">
                    Jenis Order
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/barang">
                    Barang
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/stok-masuk">
                    Stok Masuk
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/order">
                    Order
                    </a>
                </li>
               
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/transaksi">
                    Transaksi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
