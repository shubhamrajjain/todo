<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="productTitleInput" class="text-capitalize">Title
            </label>
            <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Name" required>
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="categoryTitleInput" required class="text-capitalize">Description</label>
            <textarea class="form-control" name="description" required placeholder="Description"></textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="productTitleInput" class="text-capitalize">Date of Task
            </label>
            <input type="date" class="form-control" name="task_date" value="{{old('task_date')}}" placeholder="Date"
                required>
            @error('date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="productTitleInput" class="text-capitalize">Priority
            </label>
            <select class="form-control" name="priority" required>
                <option value="">Select</option>
                <option value="1">High</option>
                <option value="2">Medium</option>
                <option value="3">Low</option>
            </select>
            @error('priority')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="productTitleInput">Assign To</label>
            <select name="user_id" required class="form-control">
                <option value="">Select an User</option>
                @foreach($users as $user)
                <option value="{{$user->id}}">
                    {{$user->name}}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="productTitleInput" class="text-capitalize">Duration
            </label>
            <input type="number" max="7" min="1" class="form-control" name="duration" value="{{old('duration')}}"
                placeholder="Duration in Day(s) between 1 to 7" required>
            @error('duration')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>