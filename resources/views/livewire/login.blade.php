<div class="login-box">
    <div class="login-logo">
        <a href="../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <x-flash-message />

            <form wire:submit="submit">
                <div class="input-group mb-3">
                    <input wire:model="email" type="email" class="form-control" placeholder="Email" />
                    <div class="input-group-text">
                        <span class="bi bi-envelope"></span>
                    </div>
                    @error('email')
<div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input wire:model="password" type="password" class="form-control" placeholder="Password" />
                    <div class="input-group-text">
                        <span class="bi bi-lock-fill"></span>
                    </div>

                    @error('password')
<div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <!--begin::Row-->
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </form>

            <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="register.html" class="text-center"> Register a new membership </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
