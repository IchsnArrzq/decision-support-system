<?php

namespace App\Livewire\Pages\Criteria;

use App\Models\Criteria;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public ?int $recordId = null;

    public ?int $editingId = null;

    public bool $readonly = false;

    public string $code = '';

    public string $name = '';

    public string $indicator = '';

    public string $unit = '';

    public string $weight = '';

    public string $type = 'benefit';

    public function mount(?int $recordId = null, bool $readonly = false): void
    {
        $this->recordId = $recordId;
        $this->readonly = $readonly;

        if ($this->recordId) {
            $this->fillFromRecord($this->recordId);
        }
    }

    protected function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', Rule::unique('criterias', 'code')->ignore($this->editingId)],
            'name' => ['required', 'string', 'max:255'],
            'indicator' => ['nullable', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:255'],
            'weight' => ['required', 'numeric', 'min:0', 'max:1'],
            'type' => ['required', Rule::in(['benefit', 'cost'])],
        ];
    }

    public function save(): void
    {
        if ($this->readonly) {
            return;
        }

        $validated = $this->validate();
        $validated['weight'] = (float) $validated['weight'];

        if ($this->editingId) {
            Criteria::query()->findOrFail($this->editingId)->update($validated);
        } else {
            Criteria::query()->create($validated);
        }

        $this->redirectRoute('criteria.index', navigate: true);
    }

    public function cancel(): void
    {
        $this->redirectRoute('criteria.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.criteria.form');
    }

    private function fillFromRecord(int $id): void
    {
        $criteria = Criteria::query()->findOrFail($id);

        $this->editingId = $criteria->id;
        $this->code = (string) $criteria->code;
        $this->name = (string) $criteria->name;
        $this->indicator = (string) ($criteria->indicator ?? '');
        $this->unit = (string) ($criteria->unit ?? '');
        $this->weight = (string) $criteria->weight;
        $this->type = (string) $criteria->type;
        $this->resetValidation();
    }
}
