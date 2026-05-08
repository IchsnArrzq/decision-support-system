<?php

namespace App\Livewire\Pages\Alternative;

use App\Models\Alternative;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public ?int $recordId = null;

    public ?int $editingId = null;

    public bool $readonly = false;

    public string $code = '';

    public string $name = '';

    public string $brand = '';

    public string $category = '';

    public string $transmission = '';

    public string $price = '';

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
            'code' => ['required', 'string', 'max:255', Rule::unique('alternatives', 'code')->ignore($this->editingId)],
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'transmission' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function save(): void
    {
        if ($this->readonly) {
            return;
        }

        $validated = $this->validate();
        $validated['price'] = (float) $validated['price'];

        if ($this->editingId) {
            Alternative::query()->findOrFail($this->editingId)->update($validated);
        } else {
            Alternative::query()->create($validated);
        }

        $this->redirectRoute('alternatives.index', navigate: true);
    }

    public function cancel(): void
    {
        $this->redirectRoute('alternatives.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.alternative.form');
    }

    private function fillFromRecord(int $id): void
    {
        $alternative = Alternative::query()->findOrFail($id);

        $this->editingId = $alternative->id;
        $this->code = (string) $alternative->code;
        $this->name = (string) $alternative->name;
        $this->brand = (string) $alternative->brand;
        $this->category = (string) $alternative->category;
        $this->transmission = (string) $alternative->transmission;
        $this->price = (string) $alternative->price;
        $this->resetValidation();
    }
}
