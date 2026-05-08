<?php

namespace App\Livewire\Pages\Value;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Value;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public ?int $recordId = null;

    public ?int $editingId = null;

    public bool $readonly = false;

    public string $alternative_id = '';

    public string $criteria_id = '';

    public string $value = '';

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
            'alternative_id' => [
                'required',
                'integer',
                'exists:alternatives,id',
                Rule::unique('values')
                    ->ignore($this->editingId)
                    ->where(function ($query) {
                        return $query
                            ->where('alternative_id', (int) $this->alternative_id)
                            ->where('criteria_id', (int) $this->criteria_id);
                    }),
            ],
            'criteria_id' => ['required', 'integer', 'exists:criterias,id'],
            'value' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function save(): void
    {
        if ($this->readonly) {
            return;
        }

        $validated = $this->validate();
        $validated['alternative_id'] = (int) $validated['alternative_id'];
        $validated['criteria_id'] = (int) $validated['criteria_id'];
        $validated['value'] = (float) $validated['value'];

        if ($this->editingId) {
            Value::query()->findOrFail($this->editingId)->update($validated);
        } else {
            Value::query()->create($validated);
        }

        $this->redirectRoute('values.index', navigate: true);
    }

    public function cancel(): void
    {
        $this->redirectRoute('values.index', navigate: true);
    }

    public function render()
    {
        $alternatives = Alternative::query()
            ->orderBy('code')
            ->get(['id', 'code', 'name']);

        $criterias = Criteria::query()
            ->orderBy('code')
            ->get(['id', 'code', 'name']);

        return view('livewire.pages.value.form', compact('alternatives', 'criterias'));
    }

    private function fillFromRecord(int $id): void
    {
        $record = Value::query()->findOrFail($id);

        $this->editingId = $record->id;
        $this->alternative_id = (string) $record->alternative_id;
        $this->criteria_id = (string) $record->criteria_id;
        $this->value = (string) $record->value;
        $this->resetValidation();
    }
}
