<div class="card">

    <div class="card-body">

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" wire:click="$dispatch('closeModal', {id: 'exampleModal'})"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

        <button class="btn btn-primary" wire:click="$dispatch('toast', {message: 'hallo', variant: 'primary'})">Show Toast</button>

        <button class="btn btn-primary" wire:click="$dispatch('openModal', {id: 'exampleModal'})">Show Modal</button>

        <button class="btn btn-primary" wire:click="$dispatch('deleteConfirmation', {message: 'hapus data'})">Show Alert</button>

    </div>

</div>
