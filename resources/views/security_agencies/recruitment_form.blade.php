<form action="{{ route('agency_recruitment_form.store') }}" method="post">
    @csrf
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="form-group">
        <label for="fname">First name</label>
        <input type="text" class="form-control" id="fname" name="fname"
            value="{{ old('fname', isset($user) ? $user->fname : '') }}" required>
    </div>
    <div class="form-group">
        <label for="sname">Last name</label>
        <input type="text" class="form-control" id="sname" name="sname"
            value="{{ old('sname', isset($sname) ? $user->sname : '') }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email"
            value="{{ old('email', isset($email) ? $user->email : '') }}" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
    </div>

    <!-- Confirm Password Field -->
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    <div class="text-center mt-2">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>
