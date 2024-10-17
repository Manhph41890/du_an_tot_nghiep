@foreach ($donhangs as $item)
    <td>{{ optional($item->user)->user_id ?? 'Null' }}</td>

    <td>{{ optional($item)->san_pham_id ?? 'Null' }}</td>
    <td>{{ optional($item)->phuong_thuc_thanh_toan_id ?? 'Null' }}</td>
    <td>{{ optional($item)->phuong_thuc_van_chuyen_id ?? 'Null' }}</td>
    <td>{{ optional($item)->tong_tien ?? 'Null' }}</td>
    <td>{{ optional($item)->ho_ten ?? 'Null' }}</td>
    <td>{{ optional($item)->email ?? 'Null' }}</td>
    <td>{{ optional($item)->so_dien_thoai ?? 'Null' }}</td>
    <td>{{ optional($item)->dia_chi ?? 'Null' }}</td>
@endforeach
