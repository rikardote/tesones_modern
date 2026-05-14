@php
    $avatars = \App\Models\User::avatarIcons();
    $selectedAvatar = $user->avatar ?: 'av-1';
@endphp

<div class="grid grid-cols-4 md:grid-cols-6 gap-4" x-data="{ selected: '{{ $selectedAvatar }}' }">
    <input type="hidden" name="avatar" :value="selected">
    @foreach($avatars as $key => $style)
        <button type="button" 
                @click="selected = '{{ $key }}'"
                title="{{ $style['name'] }}"
                class="relative aspect-square rounded-2xl transition-all duration-200 group overflow-hidden border-4 bg-white"
                :class="selected === '{{ $key }}' ? 'border-indigo-500 scale-105 shadow-lg' : 'border-slate-50 hover:border-slate-200 hover:scale-105'">
            
            <div class="w-full h-full {{ $style['bg'] }} flex items-center justify-center">
                {!! $style['svg'] !!}
            </div>

            <div x-show="selected === '{{ $key }}'" class="absolute top-1 right-1">
                <div class="bg-indigo-500 text-white rounded-full p-0.5 shadow-sm">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
        </button>
    @endforeach
</div>
