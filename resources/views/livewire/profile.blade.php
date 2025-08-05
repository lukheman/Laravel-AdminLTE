<div class="row">

    <!-- left side -->
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ auth()->user()->photo ? asset('storage/' . (auth()->user()->photo ?? '')) : 'assets/img/user2-160x160.jpg' }}" alt="" class="user-image rounded-circle" width="120">

                    <div class="mt-2">
                        <label for="profile-photo" class="btn btn-outline-primary btn-sm" style="cursor: pointer;">
                            <i class="bi bi-camera"></i> Ganti Foto
                        </label>
                        <input wire:model="form.photo" type="file" id="profile-photo" class="d-none" accept="image/*">
                    </div>
                    <h3 class="mt-3">{{ $user->name }}</h3>
                    <!-- <p class="text-small">Akmal</p> -->
                </div>
            </div>
        </div>
    </div>

    <!-- right side -->
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form wire:submit="edit">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model="form.name" type="text" id="name" class="form-control" placeholder="Masukkan nama Anda">
                        @error('form.name')
                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input wire:model="form.email" type="text" id="email" class="form-control">
                        @error('form.email')
                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input wire:model="form.password" type="password" id="password" class="form-control" >
                        @error('form.password')
                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
