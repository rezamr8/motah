
<!-- Pembelian Barang -->
<div class="card mb-2">
                        
                        <div class="table-responsive">
                        <div class="card-header">
                            <h4 class="text-center">PEMBELIAN BARANG</h4>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>no order </th>
                                        <td>{{$order->no_order}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Order </th>
                                        <td>{{$order->jenisorder->jenis}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Tgl Beres</th>
                                        <td>{{ $order->tgl_beres }}</td>
                                    </tr>
                                    <tr>
                                        <th>Modal</th>
                                        <td id="modal">{{ $order->modal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sisa</th>
                                        <td id="sisa">{{ $order->sisa }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>harga</th>
                                    </tr>
                                    @foreach($order->stokmasuk as $data)
                                    <tr>
                                        <td>{{$data->barang()->withTrashed()->get()->first()->nama_barang}}</td>
                                        <td>{{$data->jumlah}}</td>
                                        <td class="harga" data-a-sign="Rp ">Rp {{ number_format($data->harga) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- end Pembelian Barang -->

                    <!-- Bahan Yang Di pakai -->
                    <div class="card">
                    <div class="card-header">BaHan Yang Terpakai</div>
                    
                    <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        
                                    </tr>
                                    @foreach($order->transaksi as $data)
                                    <tr>
                                        <td>{{$data->barang()->withTrashed()->get()->first()->nama_barang}}</td>
                                        <td>{{$data->jumlah}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- End Bahan Yang Di pakai -->