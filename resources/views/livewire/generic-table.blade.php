<div class="card">
    <!-- Notifikasi -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


<!-- Modal -->
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" wire:ignore.self>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5">{{ $editingId ? 'Edit Data' : 'Tambah Data' }}</h5>
        <button type="button" class="btn-close" wire:click="cancel"></button>
      </div>

                <form wire:submit.prevent="save">
      <div class="modal-body">
                    @foreach ($formFields as $field)
                        <div class="mb-3">
                            <label for="{{ $field['field'] }}" class="form-label">{{ $field['label'] }}</label>
                            <input wire:model="form.{{ $field['field'] }}" type="text" class="form-control" id="{{ $field['field'] }}" placeholder="{{ $field['label'] }}">
                            @error("form.{$field['field']}")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
      </div>
      <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" wire:click="cancel" class="btn btn-secondary">Batal</button>
      </div>

                </form>
    </div>
  </div>
</div>


    <!-- Tabel -->
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <input wire:model.live="search" type="text" placeholder="Cari..." class="form-control w-50">
            <button wire:click="$dispatch('openModal', {id: 'modal-form'})" class="btn btn-success">Tambah Data</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col" wire:click="sortBy('{{ $column['field'] }}')" class="cursor-pointer">
                            {{ $column['label'] }}
                            @if ($sortBy === $column['field'])
                                {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                            @endif
                        </th>
                    @endforeach
                    <th scope="col" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        @foreach ($columns as $column)
                            <td>{{ $item->{$column['field']} }}</td>
                        @endforeach
                        <td class="text-end">
                            <button wire:click="showEditForm({{ $item->id }})" class="btn btn-primary btn-sm">Edit</button>
                            <button wire:click="delete({{ $item->id }})" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
</div>
