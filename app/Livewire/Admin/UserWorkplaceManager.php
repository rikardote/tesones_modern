<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Workplace;
use Livewire\Component;

class UserWorkplaceManager extends Component
{
    public User $user;
    public $selectedWorkplaces = [];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->selectedWorkplaces = $user->workplaces->pluck('id')->toArray();
    }

    public function toggleWorkplace($workplaceId)
    {
        if (in_array($workplaceId, $this->selectedWorkplaces)) {
            $this->user->workplaces()->detach($workplaceId);
            $this->selectedWorkplaces = array_diff($this->selectedWorkplaces, [$workplaceId]);
        } else {
            $this->user->workplaces()->attach($workplaceId);
            $this->selectedWorkplaces[] = $workplaceId;
        }
        
        $this->dispatch('toast', message: 'Asignación actualizada correctamente.', type: 'success');
    }

    public function render()
    {
        return view('livewire.admin.user-workplace-manager', [
            'allWorkplaces' => Workplace::orderBy('adscripcion')->get()
        ]);
    }
}
