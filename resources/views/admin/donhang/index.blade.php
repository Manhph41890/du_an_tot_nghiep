@foreach ($donhangs as $item)
    {{ optional($item->user)->user_id ?? 'Null' }}

    <td>{{ $item->san_pham_id }}</td>
    <td>{{ $item->phuong_thuc_thanh_toan_id }}</td>
    <td>{{ $item->phuong_thuc_van_chuyen_id }}</td>
    <td>{{ $item->tong_tien }}</td>
    <td>{{ $item->ho_ten }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->so_dien_thoai }}</td>
    <td>{{ $item->dia_chi }}</td>
@endforeach
