<?php

namespace App\Livewire;

use App\Traits\WithModal;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithPagination;

class GenericTable extends Component
{
    use WithPagination;
    use WithNotify;
    use WithModal;

    public $model;
    public $columns;
    public $formFields;
    public $rules;
    public $perPage = 10;
    public $search = '';
    public $sortBy = '';
    public $sortDirection = 'asc';
    public $form = [];
    public $editingId = null;
    public $modalId = 'modal-form';

    public function mount($model, $columns, $formFields = [], $rules = [])
    {
        $this->model = $model;
        $this->columns = $this->normalizeFields($columns); // Normalisasi kolom
        $this->formFields = $formFields ? $this->normalizeFields($formFields) : $this->columns; // Gunakan kolom jika formFields kosong
        $this->rules = $rules ?: $this->generateDefaultRules();
        $this->sortBy = $this->columns[0]['field'];
    }

    protected function normalizeFields($fields)
    {
        return array_map(function ($field) {
            if (is_string($field)) {
                return ['field' => $field, 'label' => ucfirst($field)];
            }
            return [
                'field' => $field['field'],
                'label' => $field['label'] ?? ucfirst($field['field'])
            ];
        }, $fields);
    }

    protected function generateDefaultRules()
    {
        $rules = [];
        foreach ($this->formFields as $field) {
            $rules["form.{$field['field']}"] = 'required|string|max:255';
            if ($field['field'] === 'email') {
                $rules["form.{$field['field']}"] = 'required|email|max:255|unique:users,email' . ($this->editingId ? ',' . $this->editingId : '');
            }
        }
        return $rules;
    }

    public function sortBy($column)
    {
        if (!in_array($column, array_column($this->columns, 'field'))) {
            return;
        }

        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function delete($id)
    {
        $modelClass = $this->model;
        $modelClass::findOrFail($id)->delete();
        $this->dispatch('refreshComponent');
        $this->notifySuccess('Data berhasil dihapus!');
    }

    public function showAddForm()
    {
        $this->form = [];
        $this->editingId = null;
    }

    public function showEditForm($id)
    {
        $modelClass = $this->model;
        $item = $modelClass::findOrFail($id);
        $this->form = [];
        foreach ($this->formFields as $field) {
            $this->form[$field['field']] = $item->{$field['field']};
        }
        $this->editingId = $id;
        $this->openModal($this->modalId);
    }

    public function save()
    {
        $this->validate($this->rules);

        $modelClass = $this->model;
        if ($this->editingId) {
            $item = $modelClass::findOrFail($this->editingId);
            $item->update($this->form);
            $this->notifySuccess('Data berhasil diperbarui!');
        } else {
            $modelClass::create($this->form);
            $this->notifySuccess('Data berhasil ditambahkan!');
        }

        $this->form = [];
        $this->editingId = null;
        $this->dispatch('refreshComponent');
        $this->closeModal($this->modalId);
    }

    public function cancel()
    {
        $this->form = [];
        $this->editingId = null;
        $this->closeModal($this->modalId);

    }

    public function render()
    {
        $modelClass = $this->model;
        $query = $modelClass::query();

        if ($this->search) {
            $query->where(function ($q) {
                foreach ($this->columns as $column) {
                    $q->orWhere($column['field'], 'like', '%' . $this->search . '%');
                }
            });
        }

        if ($this->sortBy) {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        $data = $query->latest()->paginate($this->perPage);

        return view('livewire.generic-table', [
            'data' => $data,
            'columns' => $this->columns,
            'formFields' => $this->formFields,
        ]);
    }
}
