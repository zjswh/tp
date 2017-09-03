<?php
return [
    'template' =>[
        'layout_on'     =>  false,
    ],
    'exception_handle'  =>  '\app\api\exception\Http',
    
    'log'     =>  [
        'type'                  =>  'socket',
        'host'                  =>  'localhost',
        'show_included_files'   =>  true,
        'force_client_ids'      =>  ['slog_7edc11'],
        'allow_client_ids'      =>  ['slog_7edc11'],
    ],
];
?>
