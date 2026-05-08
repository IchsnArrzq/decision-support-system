<?php

namespace App\Livewire\Pages\Alternative;

use App\Models\Alternative;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        Alternative::query()->findOrFail($id)->delete();

        $this->resetPage();
    }

    public function render()
    {
        $search = trim($this->search);

        $alternatives = Alternative::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search) {
                    $like = '%'.$search.'%';

                    $nested->where('code', 'like', $like)
                        ->orWhere('name', 'like', $like)
                        ->orWhere('brand', 'like', $like)
                        ->orWhere('category', 'like', $like)
                        ->orWhere('transmission', 'like', $like);
                });
            })
            ->orderBy('code')
            ->paginate(10);

        return view('livewire.pages.alternative.table', compact('alternatives'));
    }
}
