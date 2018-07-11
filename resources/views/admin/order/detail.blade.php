
<!-- Pembelian Barang -->
<div class="card ">
                        
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
                                        <td>{{$data->barang->nama_barang}}</td>
                                        <td>{{$data->jumlah}}</td>
                                        <td id="harga">{{$data->harga}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- end Pembelian Barang -->