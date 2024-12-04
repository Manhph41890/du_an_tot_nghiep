<!-- Modal Header -->
<div class="modal-header">
    <h3 class="modal-title">Sửa hoạt động</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal body -->
<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('user.updateIs_active') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active"
                                        id="active{{ $item->id }}" value="1"
                                        {{ $item->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active{{ $item->id }}">
                                        Hoạt động
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active"
                                        id="inactive{{ $item->id }}" value="0"
                                        {{ !$item->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inactive{{ $item->id }}">
                                        Không hoạt động
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
