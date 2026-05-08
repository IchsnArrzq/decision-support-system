<?php

namespace App\Livewire\Pages\Value;

use App\Models\Value;
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
        Value::query()->findOrFail($id)->delete();

        $this->resetPage();
    }

    public function render()
    {
        $search = trim($this->search);
        $like = '%'.$search.'%';

        $values = Value::query()
            ->with([
                'alternative:id,code,name',
                'criteria:id,code,name,type',
            ])
            ->when($search !== '', function ($query) use ($like) {
                $query->where(function ($nested) use ($like) {
                    $nested->whereHas('alternative', function ($alternativeQuery) use ($like) {
                        $alternativeQuery->where('code', 'like', $like)
                            ->orWhere('name', 'like', $like);
                    })->orWhereHas('criteria', function ($criteriaQuery) use ($like) {
                        $criteriaQuery->where('code', 'like', $like)
                            ->orWhere('name', 'like', $like);
                    })->orWhere('value', 'like', $like);
                });
            })
            ->orderBy('alternative_id')
            ->orderBy('criteria_id')
            ->paginate(10);

        return view('livewire.pages.value.table', compact('values'));
    }
}
