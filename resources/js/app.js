// ✅ Fix — let Livewire start Alpine for you
import Alpine from 'alpinejs';
window.Alpine = Alpine;

import { Livewire, Alpine as LivewireAlpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

Livewire.start(); // Livewire handles Alpine.start() internally