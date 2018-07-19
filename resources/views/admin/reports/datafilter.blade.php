<table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>No Order</th><th>Jenis</th><th>Jumlah</th><th>Tgl Beres</th><th>Modal</th><th>Sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->no_order }}</td>
                                        <td>{{ $item->jenisorder->jenis }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->tgl_beres }}</td>
                                        <td>Rp {{ number_format($item->modal) }}</td>
                                        <td>Rp {{ number_format($item->sisa) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            