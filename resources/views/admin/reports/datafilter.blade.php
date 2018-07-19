<table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Order Id</th><th>Barang Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>2</td><td>{{ $item->no_order }}</td>
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            