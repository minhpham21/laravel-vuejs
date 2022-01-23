<?php

return [
    'title' => [
        'id' => 'ID',
        'title' => 'Tiêu đề',
        'active' => 'Kịch hoạt',
        'description' => 'Mô tả',
        'filter' => 'Bộ lọc',
        'action' => 'Hành động',
        'total' => '{0}Chưa có mục nào|[1,*]Tổng: :count mục',
    ],
    'button' => [
        'create' => 'Tạo mới',
        'edit' => 'Chỉnh sửa',
        'delete' => 'Xoá',
        'cancel' => 'Hủy bỏ',
    ],
    'switch' => [
        config('constants.status.public') => 'Bật',
        config('constants.status.private') => 'Tắt',
    ],

];