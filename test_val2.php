<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$validator = \Illuminate\Support\Facades\Validator::make(
    ['folio_inicial' => '1000', 'folio_final' => '1005'],
    [
        'folio_inicial' => ['nullable', 'integer', 'min:1000', 'required_with:folio_final'],
        'folio_final'   => ['nullable', 'integer', 'min:1000', 'required_with:folio_inicial', 'gte:folio_inicial'],
    ]
);
echo "Passes strings: " . ($validator->passes() ? 'yes' : 'no') . "\n";
if (!$validator->passes()) print_r($validator->errors()->toArray());
