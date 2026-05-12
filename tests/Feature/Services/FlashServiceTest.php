<?php

use App\Services\FlashService;

beforeEach(function () {
    session()->forget(['flash_message', 'flash_level']);
});

describe('FlashService', function () {
    it('info guarda mensaje y nivel', function () {
        $flash = app(FlashService::class);
        $flash->info('Info message');
        
        expect(session('flash_message'))->toBe('Info message');
        expect(session('flash_level'))->toBe('info');
    });

    it('success guarda mensaje y nivel', function () {
        app(FlashService::class)->success('Success!');
        
        expect(session('flash_message'))->toBe('Success!');
        expect(session('flash_level'))->toBe('success');
    });

    it('error guarda mensaje y nivel danger', function () {
        app(FlashService::class)->error('Error!');
        
        expect(session('flash_message'))->toBe('Error!');
        expect(session('flash_level'))->toBe('danger');
    });

    it('warning guarda mensaje y nivel', function () {
        app(FlashService::class)->warning('Warning!');
        
        expect(session('flash_message'))->toBe('Warning!');
        expect(session('flash_level'))->toBe('warning');
    });
});
