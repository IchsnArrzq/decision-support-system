<?php

namespace App\Livewire\Pages\Criteria;

use App\Models\Criteria;
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
        Criteria::query()->findOrFail($id)->delete();

        $this->resetPage();
    }

    public function render()
    {
        $search = trim($this->search);

        $criterias = Criteria::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search) {
                    $like = '%'.$search.'%';

                    $nested->where('code', 'like', $like)
                        ->orWhere('name', 'like', $like)
                        ->orWhere('indicator', 'like', $like)
                        ->orWhere('unit', 'like', $like)
                        ->orWhere('type', 'like', $like);
                });
            })
            ->orderBy('code')
            ->paginate(10);

        return view('livewire.pages.criteria.table', compact('criterias'));
    }
}
