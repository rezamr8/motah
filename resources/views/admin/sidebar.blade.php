<div class="col-md-3">
@if(Auth::check() && Auth::user()->hasRole('admin')) 
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
                    <a class="nav-link" href="/admin">
                    <i class="fa fa-home fa-lg" aria-hidden="true"></i>
                    Dashboard
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/jenis-order">
                    <i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i>
                    Jenis Order
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/admin/barang">
                    <i class="fa fa-dropbox fa-lg text-danger" aria-hidden="true"></i>
                    Barang
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    
                    <a class="nav-link" href="/admin/stok-masuk">
                    <i class="fa fa-cubes fa-lg text-danger" aria-hidden="true"></i>
                    Stok Masuk
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="#">
                    <i class="fa fa-sign-in fa-lg text-info" aria-hidden="true"></i>
                    Order
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <ul>
                        <li>
                            <a class="nav-link" href="/admin/order/selesai">
                            <i class="fa fa-check fa-lg text-success" aria-hidden="true"></i>
                            Order Selesai
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/admin/order">
                            <i class="fa fa-times-circle fa-lg text-warning" aria-hidden="true"></i>
                            Order On Process
                            </a>
                        </li>
                    </ul>
                    
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="#">
                    <i class="fa fa-archive fa-lg text-secondary" aria-hidden="true"></i>
                    Report
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <ul id="report">
                        <li>
                            <a class="nav-link" href="/admin/report-transaksi">
                            <i class="fa fa-bar-chart fa-lg text-success" aria-hidden="true"></i>
                            Report Transaksi
                            </a>
                        </li>
                        <!-- <li>
                            <a class="nav-link" href="/admin/order">
                            Stok Keluar
                            </a>
                        </li> -->
                    </ul>
                    
                </li>
               
               
            </ul>
        </div>
    </div>
</div>
