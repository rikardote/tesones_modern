<?php

namespace App\Services;

final class FlashService
{
    public function info(string $message): void
    {
        $this->flash($message, 'info');
    }

    public function success(string $message): void
    {
        $this->flash($message, 'success');
    }

    public function error(string $message): void
    {
        $this->flash($message, 'danger');
    }

    public function warning(string $message): void
    {
        $this->flash($message, 'warning');
    }

    private function flash(string $message, string $level): void
    {
        session()->flash('flash_message', $message);
        session()->flash('flash_level', $level);
    }
}
