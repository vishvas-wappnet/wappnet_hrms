<div class="bg-light p-4 rounded">
    <h1>Update user</h1>
    <div class="lead">
        
    </div>
    
    <div class="container mt-4">
        <form method="post" action="{{ route('users.update', $user->id) }}">
          
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ $user->name }}" 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    placeholder="Name" required>

                @if ($errors->has('name'))
                    <span class="text-success text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ $user->email }}"
                    type="email" 
                    class="form-control" 
                    name="email" 
                    placeholder="Email address" required>
                @if ($errors->has('email'))
                    <span class="text-success text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
           

            <button type="submit" class="btn btn-primary">Update user</button>
            <a href="{{ route('user_list') }}" class="btn btn-default">Cancel</button>
        </form>
    </div>